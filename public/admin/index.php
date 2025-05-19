<?php
require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/auth.php';

require_login();

// Ambil semua postingan
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="sticky top-0 bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">Admin Dashboard</h1>
            <nav class="space-x-6">
                <a href="add.php" class="hover:text-indigo-200 transition-colors duration-200">Tambah Postingan</a>
                <a href="logout.php" class="hover:text-indigo-200 transition-colors duration-200">Logout</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Kelola Postingan</h2>
        <?php if (empty($posts)): ?>
            <p class="text-gray-600 text-center text-lg">Belum ada postingan. Tambahkan sekarang!</p>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-md overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-4 text-gray-700 font-semibold">Judul</th>
                            <th class="p-4 text-gray-700 font-semibold">Tanggal</th>
                            <th class="p-4 text-gray-700 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4 text-gray-800"><?php echo htmlspecialchars($post['title']); ?></td>
                                <td class="p-4 text-gray-600"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></td>
                                <td class="p-4">
                                    <a href="edit.php?id=<?php echo $post['id']; ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
                                    <a href="delete.php?id=<?php echo $post['id']; ?>" class="text-red-600 hover:text-red-800 font-medium ml-4" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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