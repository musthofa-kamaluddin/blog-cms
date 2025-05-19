<?php
require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/auth.php';

require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Postingan tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if ($title && $content) {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        header('Location: index.php');
        exit;
    } else {
        $error = 'Judul dan konten wajib diisi.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="sticky top-0 bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">Admin Dashboard</h1>
            <nav class="space-x-6">
                <a href="index.php" class="hover:text-indigo-200 transition-colors duration-200">Dashboard</a>
                <a href="logout.php" class="hover:text-indigo-200 transition-colors duration-200">Logout</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 max-w-2xl">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Postingan</h2>
        <?php if (isset($error)): ?>
            <p class="text-red-600 mb-4 text-center"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" class="bg-white rounded-xl shadow-md p-8 space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea name="content" id="content" class="mt-1 w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700 transition-colors">Simpan</button>
                <a href="index.php" class="flex-1 text-center bg-gray-200 text-gray-700 p-3 rounded-lg hover:bg-gray-300 transition-colors">Batal</a>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Simple PHP Blog. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>