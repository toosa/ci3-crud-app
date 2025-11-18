# CI3 CRUD Application - Deployment Guide

## Quick Setup for Production

### 1. Clone Repository
```bash
git clone https://github.com/toosa/ci3-crud-app.git
cd ci3-crud-app
```

### 2. Database Setup
```sql
-- Connect to MySQL
mysql -u root -p

-- Create database and user
CREATE DATABASE IF NOT EXISTS ci3webapp;
CREATE USER IF NOT EXISTS 'ci3user'@'localhost' IDENTIFIED BY 'your_password_here';
GRANT ALL PRIVILEGES ON ci3webapp.* TO 'ci3user'@'localhost';
FLUSH PRIVILEGES;

-- Use database and create table
USE ci3webapp;
source database_schema.sql;
```

### 3. Configuration
1. **Database**: Update `application/config/database.php` with your credentials
2. **Base URL**: Update `application/config/config.php` with your domain/IP
3. **Web Server**: Configure Nginx or Apache (see nginx-ci3webapp.conf)

### 4. Web Server Setup

#### For Nginx:
```bash
# Copy configuration
sudo cp nginx-ci3webapp.conf /etc/nginx/sites-available/ci3webapp
sudo ln -s /etc/nginx/sites-available/ci3webapp /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

#### For Apache:
Enable mod_rewrite and use .htaccess for clean URLs.

### 5. Permissions
```bash
sudo chown -R www-data:www-data /path/to/ci3webapp
sudo chmod -R 755 /path/to/ci3webapp
sudo chmod -R 777 /path/to/ci3webapp/application/logs
sudo chmod -R 777 /path/to/ci3webapp/application/cache
```

### 6. Test Installation
Visit: `http://yourdomain.com/test_db.php` to verify database connection.

## Security Notes
- Change default database password
- Remove test_db.php in production
- Enable CSRF protection in config
- Use HTTPS in production
- Regularly update CodeIgniter framework

## Features
- Complete CRUD operations
- Responsive Bootstrap interface
- Form validation
- Search functionality
- MySQL database integration
- Clean URL routing (with proper web server config)