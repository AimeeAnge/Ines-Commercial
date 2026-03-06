<?php
// db.php - Database connection and schema
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'ines_commercial';

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS `$db`");
$conn->select_db($db);

// Users Table
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'Student',
    status VARCHAR(50) DEFAULT 'Active',
    avatar_url TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Products Table (with local image upload support + seller tracking)
$conn->query("CREATE TABLE IF NOT EXISTS products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT(11) DEFAULT 0,
    category VARCHAR(100),
    image_url VARCHAR(2083),
    image_path VARCHAR(500),
    seller_id INT(11) DEFAULT NULL,
    status VARCHAR(50) DEFAULT 'Published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Messages Table
$conn->query("CREATE TABLE IF NOT EXISTS messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    sender_id INT(11),
    receiver_id INT(11),
    subject VARCHAR(255),
    content TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending',
    type VARCHAR(50) DEFAULT 'Message'
)");

// Announcements Table
$conn->query("CREATE TABLE IF NOT EXISTS announcements (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Cart Items Table
$conn->query("CREATE TABLE IF NOT EXISTS cart_items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Orders Table
$conn->query("CREATE TABLE IF NOT EXISTS orders (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Order Items Table
$conn->query("CREATE TABLE IF NOT EXISTS order_items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    product_name VARCHAR(255),
    quantity INT(11) NOT NULL,
    price DECIMAL(10,2) NOT NULL
)");

// Product Requests Table (students requesting to list their products)
$conn->query("CREATE TABLE IF NOT EXISTS product_requests (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    category VARCHAR(100),
    image_path VARCHAR(500),
    status VARCHAR(50) DEFAULT 'Pending',
    admin_note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Seed admin user
$checkAdmin = $conn->query("SELECT id FROM users WHERE email = 'john.m@ines.com'");
if ($checkAdmin->num_rows == 0) {
    $name = 'Johnathan Miller';
    $email = 'john.m@ines.com';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $role = 'Admin';
    $avatar = 'https://i.pravatar.cc/150?u=john';
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, avatar_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $role, $avatar);
    $stmt->execute();
}

// Seed student user
$checkStudent = $conn->query("SELECT id FROM users WHERE email = 'student@ines.com'");
if ($checkStudent->num_rows == 0) {
    $name = 'Alice Student';
    $email = 'student@ines.com';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $role = 'Student';
    $avatar = 'https://i.pravatar.cc/150?u=alice';
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, avatar_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $role, $avatar);
    $stmt->execute();
}

// Seed products
$checkProducts = $conn->query("SELECT id FROM products LIMIT 1");
if ($checkProducts->num_rows == 0) {
    $products = [
        ['Student Laptop', 'High performance laptop for engineering students', 450000, 5, 'Electronics', 'https://picsum.photos/seed/laptop/400/400'],
        ['Scientific Calculator', 'Advanced FX-991EX for math and science', 25000, 20, 'Stationery', 'https://picsum.photos/seed/calc/400/400'],
        ['Campus Hoodie', 'Official INES University branded hoodie', 15000, 50, 'Apparel', 'https://picsum.photos/seed/hoodie/400/400'],
        ['Backpack', 'Durable waterproof backpack with laptop sleeve', 12000, 15, 'Accessories', 'https://picsum.photos/seed/bag/400/400'],
        ['Desk Lamp', 'LED desk lamp with adjustable brightness', 8000, 10, 'Electronics', 'https://picsum.photos/seed/lamp/400/400'],
        ['Notebook Set', 'Pack of 5 high-quality A4 notebooks', 5000, 100, 'Stationery', 'https://picsum.photos/seed/notebook/400/400']
    ];
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock_quantity, category, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($products as $p) {
        $stmt->bind_param("ssdiss", $p[0], $p[1], $p[2], $p[3], $p[4], $p[5]);
        $stmt->execute();
    }
}

// Seed announcements
$checkAnn = $conn->query("SELECT id FROM announcements LIMIT 1");
if ($checkAnn->num_rows == 0) {
    $announcements = [
        ['Welcome to INES PRO!', 'We are excited to launch the official student commerce platform. Start trading today!'],
        ['Upcoming Student Bazaar', 'Join us next Friday at the main hall for the monthly student bazaar and exhibition.'],
        ['Security Update', 'Please ensure you use strong passwords and never share your login credentials.']
    ];
    $stmt = $conn->prepare("INSERT INTO announcements (title, content) VALUES (?, ?)");
    foreach ($announcements as $a) {
        $stmt->bind_param("ss", $a[0], $a[1]);
        $stmt->execute();
    }
}
?>
