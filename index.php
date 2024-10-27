<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "include/koneksi.php";

// Assuming you have a database connection $kon
// Query to fetch popular articles (you can define the criteria for 'popular', like number of views or likes)
$popular_articles_query = $kon->query("SELECT posts.*, categories.name AS category_name FROM posts 
                                       INNER JOIN categories ON posts.category_id = categories.id 
                                       ORDER BY id_post DESC LIMIT 4");

// Query to fetch the latest articles
$latest_articles_query = $kon->query("SELECT posts.*, categories.name AS category_name FROM posts 
                                      INNER JOIN categories ON posts.category_id = categories.id 
                                      ORDER BY id_post DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic - Podcast</title>
    <link rel="icon" href="Untitled design (2).png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <?php include_once "layout/navbar.php"; ?>


    <!-- Hero Section -->
    <?php
    // Fetch all text content from the database
    $sql = "SELECT text_content FROM text_snippets"; // Replace 'your_table_name' with your actual table name
    $result = $kon->query($sql);

    $text_snippets = [];

    if ($result->num_rows > 0) {
        // Fetch each row and add the text content to the array
        while ($row = $result->fetch_assoc()) {
            $text_snippets[] = $row['text_content'];
        }
    } else {
        echo "No records found.";
    }
    ?>

    <!-- HTML for the Hero Section -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('https://scontent.fpku3-1.fna.fbcdn.net/v/t39.30808-6/300006345_377512477896621_3871332974856076907_n.jpg?stp=dst-jpg_s960x960&_nc_cat=100&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=Y5CiWaALOq4Q7kNvgHEYUwH&_nc_zt=23&_nc_ht=scontent.fpku3-1.fna&_nc_gid=AnMLUUny8_ud_BKY2LLMEfC&oh=00_AYAIOysJgU4xh1hTGqw-OB6CbEJfYwXrMKZoPMQDFjy76g&oe=671BD791');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative container mx-auto px-6 py-32 text-left text-white">
            <h1 class="text-5xl font-extrabold leading-tight mb-6">
                <span class="text-white">SMA Sains Tahfizh - Blog</span>
            </h1>
            <!-- Container for typing text effect -->
            <div class="text-xl mb-8">
                <span id="typingText" class="typing-text"></span>
            </div>
        </div>
        <span id="popular-articles"></span>
    </section>

    <!-- Styles for the typing effect -->
    <style>
        .typing-text {
            font-family: 'Arial', sans-serif;
            color: #ffffff;
            white-space: normal;
            /* Allow text to wrap */
            overflow-wrap: break-word;
            /* Ensure long words break properly */
            word-break: break-word;
            border-right: 2px solid rgba(255, 255, 255, 0.75);
            animation: blink 0.75s step-end infinite;
            max-width: 100%;
            /* Limit text width to the container */
            line-height: 1.5;
            /* Adjust line height for readability */
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }
    </style>

    <!-- JavaScript for the typing effect -->
    <script>
        // PHP array is passed to JavaScript
        const textSnippets = <?php echo json_encode($text_snippets); ?>;

        const typingTextElement = document.getElementById("typingText");
        let snippetIndex = 0;
        let charIndex = 0;
        let typingSpeed = 100; // Typing speed in milliseconds
        let deletingSpeed = 50; // Deleting speed in milliseconds
        let pauseBetween = 1500; // Pause between typing and deleting

        function typeText() {
            if (charIndex < textSnippets[snippetIndex].length) {
                typingTextElement.textContent += textSnippets[snippetIndex].charAt(charIndex);
                charIndex++;
                setTimeout(typeText, typingSpeed);
            } else {
                setTimeout(deleteText, pauseBetween);
            }
        }

        function deleteText() {
            if (charIndex > 0) {
                typingTextElement.textContent = textSnippets[snippetIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(deleteText, deletingSpeed);
            } else {
                snippetIndex = (snippetIndex + 1) % textSnippets.length; // Cycle through text snippets
                setTimeout(typeText, typingSpeed);
            }
        }

        // Start the typing effect on page load
        window.onload = typeText;
    </script>



    <!-- Popular Articles Section -->
    <section class="container max-w-7xl mx-auto p-6 py-12">
        <h2 class="text-3xl font-bold mb-8">Popular Articles</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="200">
            <?php
            // Assuming you already have a database connection ($db) and a query to fetch popular articles

            // Fetch the main article (the first one)
            $main_article_query = $kon->query("
        SELECT
        posts.id_post, posts.tittle AS tittle, posts.content, posts.images, posts.created_at,
        categories.id AS category_id, categories.name AS category_name, users.username AS author_name
        FROM posts
        JOIN users ON posts.author_id = users.id_user
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.id_post DESC
        LIMIT 1  
      ");
            $main_article = $main_article_query->fetch_assoc();

            // Fetch other small articles (next three)  
            $small_articles_query = $kon->query("
        SELECT posts.id_post, posts.tittle AS tittle, posts.content, posts.images, posts.created_at, categories.id AS category_id, categories.name AS category_name
        FROM posts
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.id_post DESC
        LIMIT 1, 3
      ");
            ?>

            <!-- Main article (left side) -->
            <div class="lg:col-span-2" data-aos="fade-up" data-aos-duration="1000">
                <div class="bg-white p-6">
                    <div class="flex items-center mb-4">
                        <img src="https://siakadponpes.com/assets/img/clients/6.png" alt="Main Article Image" loading="lazy" class="w-15 h-10 rounded-full mr-4">
                        <div>
                            <p class="text-sm text-gray-500"><?= $main_article['author_name'] ?></p>
                            <p class="text-xs text-gray-400 mt-1">Author</p>
                        </div>
                    </div>
                    <a href="main.php?p=readpage&id=<?= $main_article['id_post'] ?>" class="text-2xl font-bold mb-4"><?= $main_article['tittle'] ?></a>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <a href="main.php?p=categorypage&id=<?= $main_article['category_id'] ?>" class="mr-4"><?= $main_article['category_name'] ?></a>
                        <p class="text-gray-500 text-sm"><?= date('F d, Y', strtotime($main_article['created_at'])) ?></p>
                    </div>
                    <img src="assets/img/uploads/<?= $main_article['images'] ?>" alt="Main Article Image" loading="lazy" class="w-full h-64 object-cover rounded-lg mb-4">
                </div>
            </div>

            <!-- Small articles (right side) -->
            <div class="grid grid-cols-1 gap-4" data-aos="fade-up" data-aos-duration="1000">
                <?php while ($small_article = $small_articles_query->fetch_assoc()) { ?>
                    <div class="flex bg-white p-4">
                        <div class="flex-grow pr-4">
                            <a href="main.php?p=readpage&id=<?= $small_article['id_post'] ?>" class="text-lg font-semibold mb-2"><?= $small_article['tittle'] ?></>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <a href="main.php?p=categorypage&id=<?= $small_article['category_id'] ?>" class="mr-4"><?= $small_article['category_name'] ?></a>
                                    <p class="text-gray-500 text-sm"><?= date('F d, Y', strtotime($small_article['created_at'])) ?></p>
                                </div>
                        </div>
                        <img src="assets/img/uploads/<?= $small_article['images'] ?>" loading="lazy" alt="Small Article Image" class="w-32 h-20 object-cover rounded-lg">
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <span id="latest-articles"></span>

    <!-- Latest Post -->
    <?php
    // Fetch latest articles with the author's username
    $query = "SELECT posts.id_post, posts.tittle AS tittle, posts.content, posts.images, posts.created_at,
            categories.id AS category_id, categories.name AS category_name, users.username AS author_name
          FROM posts
          JOIN categories ON posts.category_id = categories.id
          JOIN users ON posts.author_id = users.id_user
          ORDER BY posts.id_post DESC LIMIT 4";

    $result = mysqli_query($kon, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>
        <section class="bg-gray-50 py-12 mt-5">
            <div class="container mx-auto px-6">
                <!-- Section Title -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Latest News</h2>
                    <a href="main.php?p=latest_posts" class="text-black-600 hover:text-gray-800 text-sm font-bold">See all →</a>
                </div>

                <!-- Articles Grid -->
                <div id="latest-articles-content" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom">
                    <?php while ($article = mysqli_fetch_assoc($result)) { ?>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                            <img src="assets/img/uploads/<?= $article['images'] ?>" loading="lazy" class="w-full h-40 object-cover" alt="Article Image">
                            <div class="p-4">
                                <div class="flex items-center space-x-2 text-sm mb-2">
                                    <!-- Author Image -->
                                    <img src="https://siakadponpes.com/assets/img/clients/6.png" loading="lazy" alt="Author Image" class="w-6 h-6 rounded-full object-cover">
                                    <!-- Author Name -->
                                    <span><?= $article['author_name'] ?></span>
                                    <span>|</span>
                                    <!-- Formatted Date -->
                                    <span><?= date('F d, Y', strtotime($article['created_at'])) ?></span>
                                </div>
                                <a href="main.php?p=readpage&id=<?= $article['id_post'] ?>" class="text-lg font-semibold text-gray-900 mb-2"><?= $article['tittle'] ?></a> <!-- Article title -->
                                <a href="main.php?p=readpage&id=<?= $article['id_post'] ?>" class="text-gray-600 text-sm"><?= substr($article['content'], 0, 100) ?>...</a> <!-- Short description -->
                                <div class="flex items-center space-x-1 justify-start mt-2 text-sm text-muted-foreground">
                                    <a href="main.php?p=categorypage&id=<?= $article['category_id'] ?>" class="text-black-500 font-semibold"><?= $article['category_name'] ?></a> <!-- Display article category -->
                                    <span>|</span>
                                    <span>8 min read</span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php
    } else {
        echo "<p>No articles found.</p>";
    }
    ?>


    <!-- Footer -->
    <footer class="bg-black text-white py-10" ata-aos="fade-up" data-aos-delay="200">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row justify-between items-center lg:items-start">
                <!-- School Information Section with Logo -->
                <div class="lg:w-1/3 mb-8 lg:mb-0 text-center lg:text-left">
                    <img src="https://siakadponpes.com/assets/img/clients/6.png" alt="SMA Sains Tahfizh Logo" loading="lazy" class="mx-auto lg:mx-0 mb-4" style="max-width: 150px;">
                    <h4 class="font-bold text-xl text-green-400">SMA Sains Tahfizh</h4>
                    <p class="text-green-200">Islamic Center Siak</p>
                    <p class="mt-4 text-gray-300 leading-relaxed">
                        Alamat Sekolah:<br>
                        Komplek. Islamic Center Kampung Rempak<br>
                        Provinsi Kec. Siak, Kab. Siak - Riau, Indonesia
                    </p>
                </div>

                <!-- Contact Details -->
                <div class="lg:w-1/3 mb-8 lg:mb-0 text-center lg:text-left">
                    <ul class="text-gray-300 space-y-4">
                        <li class="flex items-center justify-center lg:justify-start">
                            <i class="fas fa-phone-alt mr-2 text-green-400"></i>
                            <span>Phone: (0764) 3249465</span>
                        </li>
                        <li class="flex items-center justify-center lg:justify-start">
                            <i class="fas fa-envelope mr-2 text-green-400"></i>
                            <span>Email: <a href="mailto:smastics@gmail.com" class="hover:text-white">smastics@gmail.com</a></span>
                        </li>
                        <li class="flex items-center justify-center lg:justify-start">
                            <i class="fas fa-globe mr-2 text-green-400"></i>
                            <span>Website: <a href="http://www.smastic.sch.id" class="hover:text-white">www.smastic.sch.id</a></span>
                        </li>
                    </ul>
                </div>

                <!-- Blog and Social Media Section -->
                <div class="lg:w-1/3 text-center lg:text-left">
                    <h4 class="font-bold text-lg mb-4">Stay Connected</h4>
                    <div class="flex justify-center lg:justify-start space-x-4 mb-6">
                        <a href="https://www.facebook.com/share/g4kocCusPFdRtJ8U/" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://youtube.com/@smasticofficial?si=GoqizrA1K9zlRhvP" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/smasticsofficial?igsh=MWJ1bnlodzNtdWZ6cQ==" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                    <h4 class="font-bold text-lg mb-4">Explore Our Blog</h4>
                    <ul class="text-gray-300 space-y-2">
                        <?php
                        $query = $kon->query("SELECT * FROM categories ORDER BY id DESC");
                        foreach ($query as $key) { ?>
                            <li><a href="main.php?p=categorypage&id=<?= $key['id'] ?>" class="hover:text-white"><?= $key['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom Text -->
            <div class="mt-10 text-center text-sm text-gray-500">
                <p>&copy; 2024 SMA Sains Tahfizh. All rights reserved.</p>
            </div>
        </div>
    </footer>



</body>

</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300;500;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
    }

    /* Transparent navbar at the top */
    .navbar-transparent {
        background-color: transparent;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Glamorphism style for navbar when scrolled */
    .navbar-glassmorphism {
        backdrop-filter: blur(15px) saturate(180%);
        -webkit-backdrop-filter: blur(15px) saturate(180%);
        background-color: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: background-color 0.3s ease, border 0.3s ease, color 0.3s ease;
    }

    /* Hamburger icon should be white when the page is at the top */
    #hamburger {
        color: white;
        /* Default color when navbar is transparent */
        transition: color 0.3s ease;
    }

    /* Change hamburger to black when navbar becomes light */
    .navbar-light #hamburger {
        color: black;
    }

    /* Dropdown menu text always black */
    #mobile-menu a {
        color: black;
        /* Ensure text is black */
    }

    /* Hover effect for dropdown menu */
    #mobile-menu a:hover {
        background-color: #e5e5e5;
        /* Light grey hover effect */
    }

    /* Ensure mobile menu is hidden by default */
    #mobile-menu {
        display: none;
        /* Hidden by default */
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    /* Show mobile menu when class 'show' is added */
    #mobile-menu.show {
        display: block;
        /* Display block when menu is active */
        opacity: 1;
    }

    /* Dynamic text color */
    .navbar-light a {
        color: #000;
    }

    .navbar-light a:hover {
        color: #333;
    }

    .navbar-dark a {
        color: #fff;
    }

    .navbar-dark a:hover {
        color: #f0f0f0;
    }

    /* Smooth transitions for hover effects */
    a {
        transition: color 0.3s ease;
    }

    .nav-logo {
        transition: transform 0.3s ease-in-out;
    }

    .nav-logo:hover {
        transform: scale(1.1);
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 50;
        height: 70px;
        transition: background-color 0.3s ease;
    }

    /* Ensure consistent navbar height */
    header nav {
        height: 70px;
    }

    /* Style for the "Sign Up" button */
    .signup-button {
        background-color: white;
        color: black;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Style for "Sign Up" when navbar is dark */
    .navbar-dark .signup-button {
        background-color: #ffffff;
        /* Light background to contrast with dark text */
        color: black;
        /* Black text on light background */
    }

    /* Style for "Sign Up" when navbar is light */
    .navbar-light .signup-button {
        background-color: black;
        /* Dark background for light navbar */
        color: white;
        /* White text on dark background */
    }

    .signup-button:hover {
        background-color: #333;
        color: white;
    }

    /* Additional native CSS for precise spacing if necessary */
    .main-article img {
        object-fit: cover;
        height: 100%;
    }

    .main-article:hover img {
        transform: scale(1.05);
    }

    .small-article:hover img {
        transform: scale(1.05);
    }

    a:hover {
        color: #1119
    }

    .transition-shadow {
        transition: all 0.3s ease-in-out;
    }
</style>

<!-- JavaScript for AOS animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<!-- JavaScript for dynamic navbar style -->
<script>
    document.addEventListener("scroll", function() {
        const navbar = document.getElementById('navbar');
        const hamburger = document.getElementById('hamburger');

        if (window.scrollY > 50) {
            // When scrolled down, apply glassmorphism and adjust text color
            navbar.classList.remove('navbar-transparent', 'navbar-dark');
            navbar.classList.add('navbar-glassmorphism', 'navbar-light');

            // Set hamburger icon to black when scrolled
            hamburger.style.color = "black";
        } else {
            // When at the top, revert back to transparent
            navbar.classList.remove('navbar-glassmorphism', 'navbar-light');
            navbar.classList.add('navbar-transparent', 'navbar-dark');

            // Set hamburger icon to white when at the top of the page
            hamburger.style.color = "white";
        }
    });

    // Ensure dropdown menu text is always black
    var menuItems = document.querySelectorAll('#mobile-menu a');
    menuItems.forEach(function(item) {
        item.style.color = 'black'; // Force text color to black
    });
</script>