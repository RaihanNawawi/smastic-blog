<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Pagination</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Hiding scrollbar but keeping the scroll functionality */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</head>

<body>
    <?php
    // Koneksi ke database
    include '../include/koneksi.php'; // Sesuaikan dengan konfigurasi koneksi Anda

    // Fetch categories
    $category_query = $kon->prepare("SELECT * FROM categories");
    $category_query->execute();
    $categories_result = $category_query->get_result();

    // Check if a category is selected, default to "all"
    $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

    // Fetch posts based on the selected category
    if ($category_id > 0) {
        // If category selected, fetch posts by category ID
        $post_query = $kon->prepare("
        SELECT posts.*, categories.name AS category_name, users.username AS author_name
        FROM posts
        INNER JOIN categories ON posts.category_id = categories.id
        INNER JOIN users ON posts.author_id = users.id_user
        WHERE categories.id = ?
        ORDER BY posts.created_at DESC
    ");
        $post_query->bind_param("i", $category_id);
    } else {
        // If no category is selected, fetch all posts
        $post_query = $kon->prepare("
        SELECT posts.*, categories.name AS category_name, users.username AS author_name
        FROM posts
        INNER JOIN categories ON posts.category_id = categories.id
        INNER JOIN users ON posts.author_id = users.id_user
        ORDER BY posts.created_at DESC
    ");
    }
    $post_query->execute();
    $posts_result = $post_query->get_result();

    ?>

    <section class="mb-16" id="explore-category">
        <h2 class="text-3xl font-bold mb-6 text-center">Explore by Category</h2>

        <div class="category-tabs-container relative">
            <!-- Category Tabs -->
            <div class="category-tabs flex overflow-x-auto scrollbar-hide mb-8 space-x-4 px-4">
                <!-- Make sure the very first item is fully visible and scrollable -->
                <a href="#" class="category-tab active bg-black text-white px-4 py-2 rounded-full whitespace-nowrap flex-shrink-0" data-category="0">All</a>
                <?php
                while ($category = $categories_result->fetch_assoc()) {
                    echo '<a href="#" class="category-tab bg-gray-200 text-gray-700 px-4 py-2 rounded-full whitespace-nowrap flex-shrink-0" data-category="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a>';
                }
                ?>
            </div>
        </div>
    </section>
</body>

</html>