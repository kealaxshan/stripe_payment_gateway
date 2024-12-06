<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // # product page 
    public function index()
    {
        $products = Product::all();
        return view('Product.index', compact('products'));
    }

    // # product show
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    // # checkout function
    public function checkout(Request $request, $id)
    {
       
        $product = Product::findOrFail($id);
        // #validate price
        if ($product->price <= 0) {
            return redirect()->route('getProducts')->with('error', 'Invalid product details.');
        }

        Stripe::setApiKey(env('PAY_STRIPE_SECRET'));

        try {
            $amountInPaise = $product->price * 100;

            //# create session for payment getway with params
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'INR',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => $amountInPaise,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',

                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);
            // # get session for our reference 
            session()->put('stripe_session_id', $session->id);

            // # store order details in the database
            OrderList::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'stripe_session_id' => $session->id,
                'amount' => $product->price,
                'status' => 'Pending',
            ]);

            // # redriect to stripe checkout
            return redirect()->away($session->url);
        } catch (\Exception $e) {
            return redirect()->route('singleProduct', $product->id)->with('error', 'Payment creation failed: ' . $e->getMessage());
        }
    }


    // # function for success
    public function success(Request $request)
    {
        $sessionId = session()->get('stripe_session_id');
        session()->forget('stripe_session_id');
        Stripe::setApiKey(env('PAY_STRIPE_SECRET'));

        try {
            $session = Session::retrieve($sessionId);
            $payment = OrderList::where('stripe_session_id', $session->id)->first();
            if ($payment) {
                $payment->update([
                    'status' => 'Success',
                    'amount' => $session->amount_total / 100,
                ]);
            }

            return view('checkout.success', compact('payment'));
        } catch (\Exception $e) {
            return redirect()->route('getProducts')->with('error', 'Payment confirmation failed: ' . $e->getMessage());
        }
    }


    // # if cancel 
    public function cancel()
    {
        return view('checkout.cancel');
    }

    public function downloadInvoice($orderList_id)
    {
        try {
      

            $order = OrderList::join('users', 'order_lists.user_id', '=', 'users.id')
                  ->join('products', 'order_lists.product_id', '=', 'products.id')
                  ->where('order_lists.id', $orderList_id) // Filter by order_list_id
                  ->select('order_lists.*', 'users.name as user_name', 'products.name as product_name')
                  ->firstOrFail();
            $pdf = Pdf::loadView('invoices.invoice', ['order' => $order]);

  
            $tempFilePath = storage_path('app/invoice_' . $order->id . '.pdf');
            $pdf->save($tempFilePath);

            return response()->download($tempFilePath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            
            Log::error('Invoice generation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate invoice: ' . $e->getMessage());
        }
    }
}
