<?php
session_start();
include "../include/koneksi.php";

// Fungsi untuk mengambil data blog berdasarkan jenis interaksi
$user_id = $_SESSION['id_user']; // Sesuaikan ID user, misalkan 1 sebagai contoh

function get_blogs_by_interaction($kon, $user_id, $interaction_type)
{
    $query = "SELECT posts.tittle, posts.author_id , posts.content, posts.created_at
              FROM posts
              JOIN interactions ON interactions.post_id = posts.id_post
              WHERE interactions.user_id = ? AND interactions.interaction_type = ?";
    $stmt = $kon->prepare($query);
    $stmt->bind_param("is", $user_id, $interaction_type);
    $stmt->execute();
    return $stmt->get_result();
}

// Ambil blog yang di-like, dislike, dan di-save oleh user
$liked_blogs = get_blogs_by_interaction($kon, $user_id, 'like');
$disliked_blogs = get_blogs_by_interaction($kon, $user_id, 'dislike');
$saved_blogs = get_blogs_by_interaction($kon, $user_id, 'save');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interactions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto my-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">User Interactions</h1>

            <!-- Tab Navigation -->
            <div class="mb-6">
                <button class="tab-button px-4 py-2 bg-blue-500 text-white rounded-md mr-2 active" data-tab="liked-blogs">Liked Blogs</button>
                <button class="tab-button px-4 py-2 bg-blue-500 text-white rounded-md mr-2" data-tab="disliked-blogs">Disliked Blogs</button>
                <button class="tab-button px-4 py-2 bg-blue-500 text-white rounded-md" data-tab="saved-blogs">Saved Blogs</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content liked-blogs active">
                <h2 class="text-xl font-semibold mb-4">Blogs You Liked</h2>
                <ul class="space-y-4">
                    <?php while ($blog = $liked_blogs->fetch_assoc()): ?>
                        <li class="bg-gray-100 p-4 rounded-md shadow-sm">
                            <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($blog['tittle']); ?></h3>
                            <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($blog['author_id']); ?></p>
                            <small class="text-gray-500 text-xs"><?php echo htmlspecialchars($blog['created_at']); ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="tab-content disliked-blogs hidden">
                <h2 class="text-xl font-semibold mb-4">Blogs You Disliked</h2>
                <ul class="space-y-4">
                    <?php while ($blog = $disliked_blogs->fetch_assoc()): ?>
                        <li class="bg-gray-100 p-4 rounded-md shadow-sm">
                            <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($blog['tittle']); ?></h3>
                            <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($blog['content']); ?></p>
                            <small class="text-gray-500 text-xs"><?php echo htmlspecialchars($blog['created_at']); ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <div class="tab-content saved-blogs hidden">
                <h2 class="text-xl font-semibold mb-4">Blogs You Saved</h2>
                <ul class="space-y-4">
                    <?php while ($blog = $saved_blogs->fetch_assoc()): ?>
                        <li class="bg-gray-100 p-4 rounded-md shadow-sm">
                            <h3 class="font-semibold text-lg mb-2"><?php echo htmlspecialchars($blog['tittle']); ?></h3>
                            <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($blog['content']); ?></p>
                            <small class="text-gray-500 text-xs"><?php echo htmlspecialchars($blog['created_at']); ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Script untuk penggantian tab -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    tabContents.forEach(content => content.classList.add('hidden'));
                    const target = button.getAttribute('data-tab');
                    document.querySelector(`.${target}`).classList.remove('hidden');
                });
            });
        });
    </script>
</body>

</html>