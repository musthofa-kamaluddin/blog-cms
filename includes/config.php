<?php
// Konfigurasi MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Ganti sesuai konfigurasi MySQL Anda
define('DB_PASS', ''); // Ganti sesuai konfigurasi MySQL Anda
define('DB_NAME', 'blog_cms');
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', password_hash('admin123', PASSWORD_DEFAULT)); // Ganti di produksi

// Inisialisasi database dan tabel
try {
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buat database jika belum ada
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $pdo->exec("USE " . DB_NAME);
    
    // Buat tabel posts dan users
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS posts (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        );
    ");
    
    // Tambahkan user admin jika belum ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([ADMIN_USERNAME]);
    if ($stmt->fetchColumn() == 0) {
        $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)")
            ->execute([ADMIN_USERNAME, ADMIN_PASSWORD]);
    }
} catch (PDOException $e) {
    die("Inisialisasi database gagal: " . $e->getMessage());
}
?>