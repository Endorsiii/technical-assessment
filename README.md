# Technical Assessment - Fullstack v2.1

## Project Overview
This project is a fullstack application developed for the Software Development Engineer technical assessment. It features a Laravel backend and a Quasar frontend, designed to manage product data with CRUD operations and hierarchical product relationships.
Technologies Used

## Technologies Used
* Backend: Laravel (PHP), MySQL
* Frontend: Quasar (Vue 3, TypeScript, Composition API), Pinia (state management), Axios (API calls)


## Setup Instructions
## Prerequisites

* PHP (>=8.1)
* Composer
* MySQL (configured on port 3307)
* Node.js (>=16)
* npm

## Backend Setup (Laravel)

1. Clone the Repository
- git clone (https://github.com/Endorsiii/technical-assessment)
- cd technical-assessment/backend


2. Install Dependencies
- composer install


3. Configure Environment

Copy the example environment file:cp .env.example .env


* Update the .env file with your database settings:DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=product_db
DB_USERNAME=root
DB_PASSWORD=your_mysql_password


4. Generate Application Key
php artisan key:generate


5. Run Migrations
php artisan migrate


6. Start the Server
php artisan serve


## Frontend Setup (Quasar)

1. Navigate to the Frontend Directory
cd ../frontend

2. Install Dependencies
npm install

3. Start the Development Server
quasar dev


4. Access the Application

* Open your browser and go to http://localhost:9000


## API Endpoints
The backend provides the following RESTful API endpoints:

* GET /api/products - Retrieve all products (supports filtering by product_name or product_type)
* POST /api/products - Create a new product
* GET /api/products/{id} - Retrieve a specific product
* PUT /api/products/{id} - Update a product
* DELETE /api/products/{id} - Delete a product


## Issues
## Database Connection Issue

* Problem: The backend cannot connect to the MySQL database, resulting in a SQLSTATE[HY000] [2002] error.
* Troubleshooting Attempted:
- Confirmed MySQL is running on port 3307.
- Checked .env settings.
- Cleared configuration cache (php artisan config:clear).
- Verified database product_db exists and user permissions are correct.
* Status: Unresolved due to time constraints; likely a configuration or network issue.


