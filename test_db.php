<?php
// Simple database connection test
echo "<h2>Database Connection Test</h2>";

$hostname = 'localhost';
$username = 'ci3user';
$password = 'K3t0pr4k!';
$database = 'ci3webapp';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    
    // Test if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✅ Users table exists!</p>";
        
        // Count users
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch();
        echo "<p>📊 Current users count: " . $result['count'] . "</p>";
        
    } else {
        echo "<p style='color: orange;'>⚠️ Users table does not exist. Creating it now...</p>";
        
        // Create table
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            phone VARCHAR(20),
            address TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql);
        echo "<p style='color: green;'>✅ Users table created successfully!</p>";
        
        // Insert sample data
        $sql = "INSERT INTO users (name, email, phone, address) VALUES 
                ('John Doe', 'john.doe@example.com', '123-456-7890', '123 Main St, City, State'),
                ('Jane Smith', 'jane.smith@example.com', '098-765-4321', '456 Oak Ave, City, State'),
                ('Bob Johnson', 'bob.johnson@example.com', '555-123-4567', '789 Pine Rd, City, State')";
        
        $pdo->exec($sql);
        echo "<p style='color: green;'>✅ Sample data inserted successfully!</p>";
    }
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>❌ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<h3>Troubleshooting:</h3>";
    echo "<ul>";
    echo "<li>Make sure MySQL is running</li>";
    echo "<li>Check if database 'ci3webapp' exists</li>";
    echo "<li>Verify user 'ci3user' exists and has permissions</li>";
    echo "<li>Password might be incorrect</li>";
    echo "</ul>";
    
    echo "<h3>Quick Setup Commands:</h3>";
    echo "<pre>";
    echo "-- Connect to MySQL as root:\n";
    echo "mysql -u root -p\n\n";
    echo "-- Create database and user:\n";
    echo "CREATE DATABASE IF NOT EXISTS ci3webapp;\n";
    echo "CREATE USER IF NOT EXISTS 'ci3user'@'localhost' IDENTIFIED BY 'ci3password';\n";
    echo "GRANT ALL PRIVILEGES ON ci3webapp.* TO 'ci3user'@'localhost';\n";
    echo "FLUSH PRIVILEGES;\n";
    echo "</pre>";
}

echo "<hr>";
echo "<h3>CodeIgniter 3 CRUD Application</h3>";
echo "<p><a href='index.php' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>→ Go to CI3 Application</a></p>";
?>