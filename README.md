# CodeIgniter 3 CRUD Application

A complete CRUD (Create, Read, Update, Delete) application built with CodeIgniter 3 and MySQL, featuring user management with a modern Bootstrap interface.

## Features

- **Full CRUD Operations**: Create, Read, Update, Delete users
- **Search Functionality**: Search users by name or email  
- **Responsive Design**: Bootstrap 5 interface
- **Form Validation**: Server-side validation with error handling
- **Flash Messages**: Success/error notifications
- **Clean URL Structure**: SEO-friendly URLs

## Requirements

- **Web Server**: Apache/Nginx
- **PHP**: 7.4 or higher
- **MySQL**: 5.6 or higher
- **Extensions**: mysqli, session support

## Installation

### 1. Database Setup

Connect to MySQL and run these commands:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS ci3webapp;

-- Create user
CREATE USER IF NOT EXISTS 'ci3user'@'localhost' IDENTIFIED BY 'ci3password';
GRANT ALL PRIVILEGES ON ci3webapp.* TO 'ci3user'@'localhost';
FLUSH PRIVILEGES;

-- Use the database
USE ci3webapp;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO users (name, email, phone, address) VALUES 
('John Doe', 'john.doe@example.com', '123-456-7890', '123 Main St, City, State'),
('Jane Smith', 'jane.smith@example.com', '098-765-4321', '456 Oak Ave, City, State'),
('Bob Johnson', 'bob.johnson@example.com', '555-123-4567', '789 Pine Rd, City, State');
```

### 2. Configuration

The application is pre-configured with these settings:

- **Database**: `application/config/database.php`
- **Base URL**: `application/config/config.php`
- **Routes**: `application/config/routes.php`
- **Autoload**: Libraries and helpers automatically loaded

### 3. File Structure

```
ci3webapp/
├── application/
│   ├── controllers/
│   │   └── Users.php              # Main CRUD controller
│   ├── models/
│   │   └── User_model.php         # Database operations
│   ├── views/
│   │   ├── templates/
│   │   │   ├── header.php         # Common header
│   │   │   └── footer.php         # Common footer
│   │   └── users/
│   │       ├── index.php          # List users
│   │       ├── view.php           # View user details  
│   │       ├── create.php         # Create user form
│   │       └── edit.php           # Edit user form
│   └── config/                    # Configuration files
├── system/                        # CodeIgniter core
├── index.php                      # Application entry point
├── test_db.php                    # Database connection test
└── README.md                      # This file
```

## Usage

### Testing Database Connection

Visit: `http://localhost/ci3webapp/test_db.php`

This will:
- Test database connectivity
- Create tables if they don't exist
- Insert sample data
- Show any connection errors with troubleshooting tips

### Main Application

Visit: `http://localhost/ci3webapp/`

The application will load the Users management interface where you can:

1. **View Users**: See all users in a responsive table
2. **Add User**: Click "Add New User" to create a user
3. **Edit User**: Click the edit button next to any user  
4. **View Details**: Click "View" to see full user information
5. **Delete User**: Click delete (with confirmation prompt)
6. **Search Users**: Use the search box to find users by name/email

## API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/users` | List all users |
| GET | `/users/view/{id}` | View user details |
| GET | `/users/create` | Show create form |
| POST | `/users/create` | Create new user |
| GET | `/users/edit/{id}` | Show edit form |
| POST | `/users/edit/{id}` | Update user |
| GET | `/users/delete/{id}` | Delete user |
| POST | `/users/search` | Search users |

## Database Schema

### Users Table

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT PRIMARY KEY | Auto-incrementing user ID |
| `name` | VARCHAR(100) | Full name (required) |
| `email` | VARCHAR(100) | Email address (required, unique) |  
| `phone` | VARCHAR(20) | Phone number (optional) |
| `address` | TEXT | Full address (optional) |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Last modification time |

## Security Features

- **Input Validation**: Server-side validation for all form inputs
- **XSS Protection**: HTML entities escaped in output
- **SQL Injection Protection**: Using CodeIgniter's Query Builder
- **CSRF Protection**: Can be enabled in config
- **Email Uniqueness**: Prevents duplicate email addresses

## Customization

### Adding Fields

1. **Database**: Add column to users table
2. **Model**: Update User_model.php methods  
3. **Controller**: Add validation rules in Users.php
4. **Views**: Update forms and display pages

### Styling

The application uses Bootstrap 5 CDN. To customize:

1. **CSS**: Modify styles in `templates/header.php`
2. **Layout**: Edit template files
3. **Components**: Update individual view files

### Configuration

Key settings in `application/config/`:

- `config.php`: Base URL, encryption keys
- `database.php`: Database credentials
- `autoload.php`: Auto-loaded libraries
- `routes.php`: URL routing rules

## Troubleshooting

### Database Connection Issues

1. Check MySQL is running: `sudo service mysql start`
2. Verify credentials in `application/config/database.php`
3. Test connection with `test_db.php`
4. Check MySQL error logs

### Permission Issues

```bash
sudo chown -R www-data:www-data /var/www/html/ci3webapp
sudo chmod -R 755 /var/www/html/ci3webapp
```

### URL Rewriting

For clean URLs without `index.php`, configure Apache `.htaccess`:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

## Development

### Adding New Features

1. **Model**: Add methods to User_model.php
2. **Controller**: Create controller methods
3. **Views**: Add corresponding view files
4. **Routes**: Update routes if needed

### Form Validation

Add validation rules in controller:

```php
$this->form_validation->set_rules('field', 'Label', 'trim|required|callback_custom');
```

### Database Queries

Use CodeIgniter's Query Builder:

```php
$this->db->select('*')
         ->from('users') 
         ->where('active', 1)
         ->get()
         ->result_array();
```

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For issues and questions:
1. Check the troubleshooting section
2. Review CodeIgniter 3 documentation
3. Test database connection with `test_db.php`

---

**Built with ❤️ using CodeIgniter 3 Framework**