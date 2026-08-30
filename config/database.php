<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "travel_destination_db";

mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli($host, $username, $password);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$database_name = $conn->real_escape_string($database);
if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$database_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci")) {
    die("Database Setup Failed: " . $conn->error);
}
if (!$conn->select_db($database)) {
    die("Database Selection Failed: " . $conn->error);
}

$conn->set_charset("utf8mb4");

$schema = [
    "CREATE TABLE IF NOT EXISTS categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(100) NOT NULL UNIQUE,
        description TEXT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(190) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS admins (
        admin_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(190) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS destinations (
        destination_id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT NOT NULL,
        name VARCHAR(150) NOT NULL,
        location VARCHAR(200) NOT NULL,
        description TEXT NULL,
        best_time VARCHAR(100) NULL,
        entry_fee DECIMAL(10,2) DEFAULT 0,
        image VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        latitude DECIMAL(10,7) NULL,
        longitude DECIMAL(10,7) NULL,
        INDEX (category_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS reviews (
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        destination_id INT NOT NULL,
        rating INT NOT NULL,
        comment TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id),
        INDEX (destination_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
];

foreach ($schema as $statement) {
    if (!$conn->query($statement)) {
        die("Database Setup Failed: " . $conn->error);
    }
}

$conn->query("INSERT IGNORE INTO categories (category_name, description) VALUES
    ('Nature', 'Lakes, mountains, and outdoor escapes'),
    ('Culture', 'Heritage sites and cultural experiences'),
    ('Adventure', 'Trekking and exciting outdoor activities')");

foreach ([
    'latitude' => 'DECIMAL(10,7) NULL',
    'longitude' => 'DECIMAL(10,7) NULL'
] as $column => $definition) {
    $column_check = $conn->query("SHOW COLUMNS FROM destinations LIKE '" . $conn->real_escape_string($column) . "'");
    if ($column_check && $column_check->num_rows === 0) {
        $conn->query("ALTER TABLE destinations ADD COLUMN `$column` $definition");
    }
}

?>