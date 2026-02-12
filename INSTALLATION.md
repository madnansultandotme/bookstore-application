# Installation Guide - Online Bookstore

## Prerequisites

Before you begin, ensure you have the following installed:

1. **PHP 8.1 or higher**
   - Download from: https://www.php.net/downloads
   - For Windows: https://windows.php.net/download/

2. **Composer** (PHP Dependency Manager)
   - Download from: https://getcomposer.org/download/

3. **MySQL or PostgreSQL**
   - MySQL: https://dev.mysql.com/downloads/
   - Or use XAMPP/WAMP which includes MySQL

4. **Node.js and NPM** (for frontend assets)
   - Download from: https://nodejs.org/

## Installation Steps

### 1. Install PHP

For Windows:
- Download PHP from https://windows.php.net/download/
- Extract to `C:\php`
- Add `C:\php` to your system PATH
- Copy `php.ini-development` to `php.ini`
- Enable required extensions in `php.ini`:
  ```
  extension=pdo_mysql
  extension=mbstring
  extension=openssl
  extension=fileinfo
  ```

### 2. Install Composer

- Download and run the installer from https://getcomposer.org/Composer-Setup.exe
- Follow the installation wizard
- Verify installation: `composer --version`

### 3. Install MySQL

- Download and install MySQL from https://dev.mysql.com/downloads/
- Or install XAMPP which includes MySQL: https://www.apachefriends.org/
- Create a new database named `bookstore`

### 4. Setup the Project

Open Command Prompt in the project directory and run:

```cmd
composer install
```

### 5. Configure Environment

```cmd
copy .env.example .env
```

Edit `.env` file and update database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Generate Application Key

```cmd
php artisan key:generate
```

### 7. Run Migrations and Seeders

```cmd
php artisan migrate --seed
```

This will create all tables and populate them with sample data.

### 8. Create Storage Link

```cmd
php artisan storage:link
```

### 9. Start the Development Server

```cmd
php artisan serve
```

The application will be available at: http://localhost:8000

## Default Login Credentials

### Admin Account
- Email: admin@bookstore.com
- Password: password

### User Account
- Email: user@bookstore.com
- Password: password

## Features Available

1. **User Features:**
   - User Registration
   - Login/Logout
   - Password Reset
   - Browse Books with Search & Filters
   - Add Books to Cart
   - Place Orders
   - View Order History

2. **Admin Features:**
   - Manage Books (Add, Edit, Delete)
   - Manage Users
   - Manage Orders
   - Update Order Status

## Troubleshooting

### Issue: "Class not found" errors
**Solution:** Run `composer dump-autoload`

### Issue: Database connection errors
**Solution:** 
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database `bookstore` exists

### Issue: Permission errors
**Solution:** 
```cmd
mkdir storage\framework\cache
mkdir storage\framework\sessions
mkdir storage\framework\views
```

### Issue: Missing vendor folder
**Solution:** Run `composer install`

## Next Steps

1. Customize the application as needed
2. Add more books through the admin panel
3. Configure email settings for password reset functionality
4. Deploy to production server when ready

## Support

For issues or questions, please refer to Laravel documentation:
- https://laravel.com/docs
