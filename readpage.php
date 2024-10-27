<main class="container mx-auto p-4 max-w-screen-lg">
    <!-- Blog Post Article -->
    <article class="bg-white p-8 rounded-lg shadow-md mb-12">
        <?php
        if (isset($_GET['id'])) {
            $id_post = $_GET['id'];

            $a = "INNER JOIN categories ON posts.category_id = categories.id 
                  INNER JOIN users ON posts.author_id = users.id_user";

            $query = $kon->query("SELECT posts.*, categories.name AS category_name,
            users.username AS author_name FROM posts $a WHERE posts.id_post = '$id_post'");

            if ($query->num_rows > 0) {
                $key = $query->fetch_assoc();
                // Query to fetch tags related to the post
                $tagQuery = $kon->query("SELECT tags.name AS tag_name
                                         FROM post_tags
                                         INNER JOIN tags ON post_tags.id_tag = tags.id
                                         WHERE post_tags.id_posts = '$id_post'");

                // Collecting tags
                $tags = [];
                if ($tagQuery->num_rows > 0) {
                    while ($tag = $tagQuery->fetch_assoc()) {
                        $tags[] = $tag['tag_name'];
                    }
                }
        ?>
                <!-- Title -->
                <h2 class="text-3xl font-bold mb-4 text-gray-800 text-center">
                    <?= htmlspecialchars($key['tittle']); ?>
                </h2>

                <!-- Meta Information -->
                <div class="text-gray-500 mb-6 flex justify-center space-x-4 text-sm">
                    <div class="flex items-center space-x-2">
                        <a href="?p=categorypage&id=<?= $key['category_id']; ?>" class="bg-gray-200 text-gray-800 px-2 py-1 rounded mr-2"><?= htmlspecialchars($key['category_name']); ?></a>
                        <span class="mr-2">By <?= htmlspecialchars($key['author_name']); ?></span>
                        <span><?= 'Published on ' . date('F d, Y', strtotime($key['created_at'])) ?></span>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="mb-6">
                    <img src="assets/img/uploads/<?= $key['images'] ?>"
                        alt="Featured Image"
                        class="w-full h-auto object-cover max-h-96 rounded-lg shadow-md">
                </div>

                <!-- Blog Content -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-6">
                    <?= htmlspecialchars_decode($key['content']); ?>
                </div>

                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mt-4">
                    <?php
                    // Display tags as clickable badges
                    if (!empty($tags)) {
                        foreach ($tags as $tag) {
                            echo "<a href='?p=tagspage&tag=" . urlencode($tag) . "' class='inline-block bg-indigo-100 text-indigo-600 text-sm font-semibold px-3 py-1 rounded-full hover:bg-indigo-200 transition'>#$tag</a>";
                        }
                    } else {
                        echo "<span class='text-gray-500 text-sm'>No Tags</span>";
                    }
                    ?>
                </div>

            <?php
            } else {
            ?>
                <!-- Error Message -->
                <p class="text-lg font-semibold text-red-500 mb-4 text-center">
                    Blog not found or has been deleted.
                </p>
        <?php
            }
        }
        ?>
        <!-- Interaction Section -->
        <?php
        // Mendapatkan data berdasarkan id_post
        $id_post = $_GET['id'];  // id_post dari request 

        // Query untuk mendapatkan jumlah like, dislike, dan save dari tabel interactions
        $query = "
    SELECT 
        COUNT(CASE WHEN interaction_type = 'like' THEN 1 END) AS likes,
        COUNT(CASE WHEN interaction_type = 'dislike' THEN 1 END) AS dislikes,
        COUNT(CASE WHEN interaction_type = 'save' THEN 1 END) AS saves
    FROM interactions 
    WHERE post_id = ?
";

        // Mempersiapkan statement
        $stmt = mysqli_prepare($kon, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_post);  // Bind parameter 'i' untuk integer
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $likes, $dislikes, $saves);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Jika tidak ada hasil, set default nilai
        if (!$likes) $likes = 0;
        if (!$dislikes) $dislikes = 0;
        if (!$saves) $saves = 0;

        ?>
        <div class="max-w-full mx-auto mt-8 border-t pt-8">
            <div class="flex justify-between mb-8">
                <div class="flex space-x-4">
                    <!-- Like Button -->
                    <button id="like-btn" class="interaction-btn border px-4 py-2 rounded-md flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100" data-post-id="<?= $id_post; ?>">
                        <i class="fas fa-thumbs-up mr-2"></i> <span id="like-count"><?= $likes; ?></span>
                    </button>
                    <!-- Dislike Button -->
                    <button id="dislike-btn" class="interaction-btn border px-4 py-2 rounded-md flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100" data-post-id="<?= $id_post; ?>">
                        <i class="fas fa-thumbs-down mr-2"></i> <span id="dislike-count"><?= $dislikes; ?></span>
                    </button>
                </div>
                <div class="flex space-x-4">
                    <!-- Save Button -->
                    <button id="save-btn" class="interaction-btn border px-4 py-2 rounded-md flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100" data-post-id="<?= $id_post; ?>">
                        <i class="fas fa-bookmark mr-2"></i><span id="save-count"><?= $saves; ?></span>
                    </button>
                    <!-- Share Button
                    <button class="border px-4 py-2 rounded-md flex items-center transition hover:bg-gray-100">
                        <i class="fas fa-share mr-2"></i>
                        Share
                    </button> -->
                </div>
            </div>
        </div>

        <!-- Social Sharing Buttons
            <div class="flex space-x-4 mb-8">
                <button class="border px-4 py-2 rounded-md hover:bg-gray-100 flex items-center">
                    <i class="fab fa-facebook mr-2"></i>
                    Share on Facebook
                </button>
                <button class="border px-4 py-2 rounded-md hover:bg-gray-100 flex items-center">
                    <i class="fab fa-twitter mr-2"></i>
                    Share on Twitter
                </button>
                <button class="border px-4 py-2 rounded-md hover:bg-gray-100 flex items-center">
                    <i class="fab fa-linkedin mr-2"></i>
                    Share on LinkedIn
                </button>
            </div> -->

        <!-- Comments Section -->
        <!-- <div class="bg-white p-6">
            <h3 class="text-xl font-semibold mb-4">Comments</h3>
            <form class="mb-6">
                <textarea class="w-full border border-gray-300 p-3 rounded-md mb-4 placeholder-gray-400 text-black" placeholder="Leave a comment..."></textarea>
                <button class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">Post Comment</button>
            </form> -->

            <!-- Example Comments -->
            <!-- <div class="space-y-6">
                <div class="flex space-x-4">
                    <img src="path/to/user-avatar.jpg" alt="User Avatar" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <p class="font-semibold text-black">Jane Doe</p>
                        <p class="text-sm text-gray-500">May 16, 2024</p>
                        <p class="mt-2 text-black">Great article! I'm excited to see how AI will continue to evolve.</p>
                    </div>
                </div>
            </div> -->
        </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', async function() {
                const likeBtn = document.getElementById('like-btn');
                const dislikeBtn = document.getElementById('dislike-btn');
                const saveBtn = document.getElementById('save-btn');
                const postId = likeBtn.getAttribute('data-post-id');

                function updateCount(type, count) {
                    document.getElementById(`${type}-count`).innerText = count;
                }

                function toggleActive(button, isActive) {
                    if (isActive) {
                        button.classList.add('bg-black', 'text-white');
                    } else {
                        button.classList.remove('bg-black', 'text-white');
                    }
                }

                async function sendRequest(interactionType) {
                    try {
                        const response = await fetch('interaction_handler.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `post_id=${postId}&interaction_type=${interactionType}`,
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            return data; // Return data jumlah like, dislike, save, dan userActions
                        } else {
                            alert(data.message); // Error handling lebih baik
                            return null;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        return null;
                    }
                }

                likeBtn.addEventListener('click', async function() {
                    const data = await sendRequest('like');
                    if (data) {
                        toggleActive(likeBtn, true);
                        toggleActive(dislikeBtn, false);
                        updateCount('like', data.likes);
                        updateCount('dislike', data.dislikes);
                    }
                });

                dislikeBtn.addEventListener('click', async function() {
                    const data = await sendRequest('dislike');
                    if (data) {
                        toggleActive(dislikeBtn, true);
                        toggleActive(likeBtn, false);
                        updateCount('like', data.likes);
                        updateCount('dislike', data.dislikes);
                    }
                });

                saveBtn.addEventListener('click', async function() {
                    const data = await sendRequest('save');
                    if (data) {
                        toggleActive(saveBtn, saveBtn.classList.contains('bg-black') ? false : true);
                        updateCount('save', data.saves);
                    }
                });

                async function checkUserActions() {
                    const data = await sendRequest('check');
                    if (data && data.userActions) {
                        toggleActive(likeBtn, data.userActions.includes('like'));
                        toggleActive(dislikeBtn, data.userActions.includes('dislike'));
                        toggleActive(saveBtn, data.userActions.includes('save'));
                    }
                }

                checkUserActions();
            });
        </script>



        <style>
            .interaction-btn {
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .bg-black {
                background-color: #000;
            }

            .text-white {
                color: #fff;
            }
        </style>
        <!-- /Interaction Section -->
    </article>
</main>

<!-- Relevant Posts Section -->
<section class="bg-gray-50 p-8 rounded-lg shadow-md mt-12">
    <h3 class="text-2xl font-bold mb-6 text-gray-800 text-center">Relevant Posts</h3>
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <?php
            if (isset($current_category_id)) {
                // Fetch posts from the same category but exclude the current post
                $relevantQuery = $kon->query("SELECT * FROM posts
                                              WHERE category_id = '$current_category_id'
                                              AND id_post != '$id_post'
                                              ORDER BY id_post DESC
                                              LIMIT 6");

                foreach ($relevantQuery as $relevantPost) {
            ?>
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <img src="assets/img/uploads/<?= $relevantPost['images'] ?>"
                            alt="Blog Post Image"
                            class="w-full h-48 object-cover rounded-t-lg">

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800 hover:text-indigo-600 transition">
                                <a href="?p=readpage&id=<?= $relevantPost['id_post'] ?>"><?= $relevantPost['tittle'] ?></a>
                            </h3>
                            <a href="?p=readpage?id=<?= $relevantPost['id_post'] ?>"
                                class="text-indigo-500 hover:text-indigo-600 hover:underline mt-2 block transition">
                                Read More
                            </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center text-gray-500'>No relevant posts available.</p>";
            }
            ?>
        </div>
    </div>
</section>