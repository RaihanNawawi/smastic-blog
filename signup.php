<?php
// Include koneksi database
include "include/koneksi.php";

function registerUser($username, $email, $password)
{
    global $kon;  // Menggunakan koneksi database global

    // Validasi input
    if (empty($username) || empty($email) || empty($password)) {
        return "Semua kolom harus diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Format email tidak valid.";
    }

    // Cek apakah email sudah terdaftar
    $query = $kon->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        return "Email sudah terdaftar.";
    }

    // Hash password sebelum menyimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Simpan user baru ke database
    $createdAt = date('Y-m-d H:i:s');
    $stmt = $kon->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $createdAt);

    // Cek apakah eksekusi query berhasil
    if ($stmt->execute()) {
        return "<META HTTP-EQUIV='Refresh' Content='0; URL=login.php'>";
    } else {
        return "Terjadi kesalahan: " . $stmt->error;
    }
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Panggil fungsi untuk mendaftarkan user
    $message = registerUser($username, $email, $password);
    echo $message;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f9f9f9;
            /* Flexbox centering */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .custom-btn {
            background-color: #111;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
            font-weight: 500;
        }

        .custom-btn:hover {
            background-color: #1119;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.75rem;
            width: 100%;
            background-color: white;
            transition: background-color 0.2s;
        }

        .social-btn img {
            margin-right: 0.5rem;
        }

        .social-btn:hover {
            background-color: #f3f4f6;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #6b7280;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex-grow: 1;
            background: #d1d5db;
            height: 1px;
            margin: 0 1rem;
        }
    </style>
</head>

<body>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="https://siakadponpes.com/assets/img/clients/6.png" class="h-45" alt="Logo">
        </div>

        <h2 class="text-2xl font-semibold text-center mb-4">Buat akun baru</h2>

        <form id="signupForm" class="space-y-4" method="post">
            <!-- Nama lengkap input -->
            <div id="nameInput">
                <input name="username" type="text" id="name" placeholder="Nama lengkap*" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <!-- Email input -->
            <div id="emailInput">
                <input type="email" name="email" id="email" placeholder="Alamat email*" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <!-- Password input -->
            <div id="passwordInput">
                <input type="password" name="password" id="password" placeholder="Kata sandi*" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <!-- Sign Up button -->
            <button type="submit" id="signupButton" class="custom-btn w-full text-center">Daftar</button>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">Sudah punya akun?
                <a href="login.php" class="text-blue-500">Masuk</a>
            </p>
        </div>

        <!-- <div class="divider my-4">ATAU</div>

        <div class="space-y-2">
            <button class="social-btn">
                <img src="https://img.icons8.com/color/24/000000/google-logo.png"> Lanjutkan dengan Google
            </button>
            <button class="social-btn">
                <img src="https://img.icons8.com/color/24/000000/microsoft.png"> Lanjutkan dengan Akun Microsoft
            </button>
            <button class="social-btn">
                <img src="https://img.icons8.com/ios-filled/24/000000/mac-os.png"> Lanjutkan dengan Apple
            </button>
        </div> -->
    </div>

</body>

</html>