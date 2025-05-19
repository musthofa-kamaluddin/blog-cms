<?php
require_once '../includes/config.php';
require_once '../includes/db.php';

// Ambil semua postingan
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Blog</title>
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
    <main class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Postingan Terbaru</h2>
        <?php if (empty($posts)): ?>
            <p class="text-gray-600 text-center text-lg">Belum ada postingan. Tambahkan sekarang!</p>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($posts as $post): ?>
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="text-gray-500 text-sm mb-4"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
                            <p class="text-gray-600 line-clamp-3"><?php echo htmlspecialchars($post['content']); ?></p>
                            <a href="post.php?id=<?php echo $post['id']; ?>" class="mt-4 inline-block text-indigo-600 font-medium hover:text-indigo-800 transition-colors">Baca Selengkapnya &rarr;</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Simple PHP Blog. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>