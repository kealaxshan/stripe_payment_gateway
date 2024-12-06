# Basic Payment Gateway Using Stripe
A simple Laravel application demonstrating Stripe payment gateway integration.

## 🛠 Installation Steps
#### 1. Download and Extract the Project
Download the ZIP file and extract it to your desired location.

#### 2. Navigate to the Project Folder
Open a terminal and navigate to the project folder.

#### 3. Install Dependencies
Run the following commands to install PHP and JavaScript dependencies:

```bash
$ composer update
$ npm install
```

#### 4. Frontend Development Setup
For development mode (hot-reloading):

```bash
$ npm run dev
```
**Note**📚: Keep this terminal open. Open another terminal for backend commands.
Alternatively, to build assets for production:

```bash

$ npm run build
```
#### 5. Environment Configuration
Open the **.env** file and configure your database connection.
Add your Stripe API keys:
```bash
PAY_STRIPE_KEY=<your_stripe_key>
PAY_STRIPE_SECRET=<your_stripe_secret>
```
#### 6. Database Setup
Run the following commands to set up the database:

```bash
php artisan migrate
php artisan db:seed
```

#### 7. Start the Laravel Server
Launch the development server with:

```bash
php artisan serve
```
#### 🌐 Access the Application
Open your browser and go to http://localhost:8000 or use the URL provided in the terminal.
Register a new user or log in with your credentials.

🚀 Features
User registration and authentication.
Stripe payment gateway integration.
Development and production-ready frontend builds.
<<<<<<< HEAD
Enjoy learning and using this project! 🎉
=======
Enjoy learning and using this project! 🎉
>>>>>>> 8953f91f2a49cf6fef1159593cd7e8b16def41f4
