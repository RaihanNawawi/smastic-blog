<?php
require '../include/koneksi.php'; // Koneksi database


if ($_GET['blog'] == "add") {
    // Tangkap data dari form
    $tittle = mysqli_real_escape_string($kon, $_POST['tittle']);
    $content = mysqli_real_escape_string($kon, $_POST['content']);

    // Clean content and replace relative image paths
    $content = stripslashes($content);

    $category_id = $_POST['category_id'];
    $slug = createSlug1($tittle);
    $author_id = 1; // ID penulis dari sesi


    // Simpan post baru ke database
    $query = $kon->prepare("INSERT INTO posts (tittle, content, slug, category_id, author_id,  created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $query->bind_param('sssis', $tittle, $content, $slug, $category_id, $author_id,);

    if ($query->execute()) {
        $postId = $query->insert_id;

        // Menangani tag yang dipilih
        handleTags1($kon, $postId, $_POST['selected_tags']);

        // Redirect setelah berhasil
        redirectToBlog1();
    } else {
        echo "Terjadi kesalahan saat menyimpan data: " . $query->error;
    }
}

function handleTags1($kon, $postId, $selectedTags)
{
    // Ambil tags dari input hidden, pisahkan dengan koma
    $tags = explode(',', $selectedTags);

    // Gunakan array_unique untuk mencegah duplikasi
    $uniqueTags = array_unique($tags);

    // Simpan tag ke dalam database
    foreach ($uniqueTags as $tagId) {
        if (!empty($tagId)) {
            // Cek apakah relasi tag dan post sudah ada, gunakan INSERT IGNORE
            $kon->query("INSERT IGNORE INTO post_tags (id_posts, id_tag) VALUES ('$postId', '$tagId')");
        }
    }
}

function redirectToBlog1()
{
    header('Location: test.php');
    exit;
}
function createSlug1($tittle)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tittle)));
}
