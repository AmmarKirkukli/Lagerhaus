# Lagerhaus - Warehouse Management System

A comprehensive warehouse management system built with PHP, following the MVC (Model-View-Controller) architecture pattern.

## Features

- **User Management**: Create, edit, and manage user accounts
- **Product Management**: Full CRUD operations for product inventory
- **Order Management**: Track and manage warehouse orders
- **Admin Panel**: Secure admin interface with authentication
- **Responsive Design**: Built with Bootstrap 5 for mobile-friendly interface

## Tech Stack

- **Backend**: PHP
- **Frontend**: HTML, CSS, Bootstrap 5
- **Icons**: Font Awesome
- **Database**: MySQL
- **Dependency Management**: Composer
- **Email**: PHPMailer

## Project Structure

```
├── admin/
│   ├── controller/     # Business logic controllers
│   ├── model/          # Database models
│   ├── view/           # UI templates
│   └── public/         # Static assets (CSS, JS, images)
├── vendor/             # Composer dependencies
└── composer.json       # PHP dependencies
```

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/YOUR_USERNAME/Lagerhaus.git
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure your database connection in the appropriate configuration file

4. Import the database schema from `admin/public/daten/edv3.sql`

5. Set up your web server to point to the project directory

## Requirements

- PHP 7.4 or higher
- MySQL/MariaDB
- Apache/Nginx web server
- Composer

## License

All rights reserved.

## Author

Developed as a warehouse management solution.
