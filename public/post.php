<?php
require_once '../includes/config.php';
require_once '../includes/db.php';

// Ambil postingan berdasarkan ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Postingan tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="sticky top-0 bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">PHP Blog</h1>
            <nav class="space-x-6">
                <a href="index.php" class="hover:text-indigo-200 transition-colors duration-200">Home</a>
                <a href="admin/login.php" class="hover:text-indigo-200 transition-colors duration-200">Admin Login</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 max-w-4xl">
        <article class="bg-white rounded-xl shadow-md p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($post['title']); ?></h2>
            <p class="text-gray-500 text-sm mb-6"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
            <div class="prose prose-lg text-gray-700">
                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
            </div>
            <a href="index.php" class="mt-8 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">Kembali ke Home</a>
        </article>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Simple PHP Blog. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>