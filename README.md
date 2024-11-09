
## Installation 
1. Clone the repository.
2. Install dependencies with composer install.
3. Import the product.sql file into local database using MySQL or a GUI tool.
4. Update their .env file with the correct database settings.
5. Copy .env.example to .env.
6. Run php artisan key:generate.
7. Configure the database in .env.
8. Run php artisan migrate to set up the database.
9. Run php artisan storage:link if using file uploads.
10. Start the server with php artisan serve.

