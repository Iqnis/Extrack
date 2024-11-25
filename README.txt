ExTrack Expense Tracker
ExTrack is a simple PHP-based expense tracking application. It allows users to log expenses, categorize transactions, and manage their budget effectively.

Prerequisites
XAMPP (Download and install from https://www.apachefriends.org).
Basic knowledge of PHP and MySQL for customization (optional).
Setup Instructions
1. Clone or Download the Project
Clone the repository using Git or download it as a ZIP file and extract it.
Place the project folder inside the htdocs directory of your XAMPP installation.
Example: C:\xampp\htdocs\ExTrack.
2. Configure the Database
Open phpMyAdmin by navigating to http://localhost/phpmyadmin in your browser.
Create a new database named expenseman.
Import the provided SQL file:
Locate the SQL file (DATABASE) in the project folder.
Go to the Import tab in phpMyAdmin.
Upload and execute the SQL file to set up the required tables and data.
3. Update Database Credentials
Open the file init.php in the project folder.
Update the database configuration with your local XAMPP MySQL credentials:
php
Copy code
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Default user for XAMPP
define('DB_PASS', '');     // No password by default
define('DB_NAME', 'extrack');
4. Start XAMPP Services
Launch the XAMPP Control Panel.
Start the Apache and MySQL services.
5. Access the Application
Open a browser and navigate to http://localhost/ExTrack.
6. Default Login (if applicable)

Use the following credentials to log in (if preconfigured in the database):
Username: Imperial
Password: 1234567890
*Register at new user if username is incorrect

Features
Log and categorize expenses.
Inline editing of expense records (In progress).
Alerts for deleted or updated records via SweetAlert.

Common Issues
"404 Not Found" error: Ensure the project folder is in htdocs and the URL is correct.
Database connection errors: Double-check the database credentials in init.php.
CSS/JS not loading: Ensure the paths to static assets are correct and mod_rewrite is enabled in Apache.


