<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f9f9f9;
            /* Flexbox centering */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Ensures the body takes full height of the viewport */
            padding: 20px;
            /* Add space between the card and the top/bottom of the screen */
        }

        .custom-btn {
            background-color: #111;
            /* Matching gray color */
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

        <h2 class="text-2xl font-semibold text-center mb-4">Selamat datang kembali</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <?php
                if ($_GET['error'] == 'invalid_credentials') {
                    echo "Email atau kata sandi salah.";
                } elseif ($_GET['error'] == 'empty_fields') {
                    echo "Email dan kata sandi harus diisi.";
                }
                ?>
            </div>
        <?php endif; ?>

        <form id="loginForm" class="space-y-4" method="post" action="loginaction.php">
            <!-- Email input -->
            <div id="emailInput">
                <input type="email" name="email" placeholder="Alamat email*" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <!-- Password input -->
            <div id="passwordInput">
                <input type="password" id="passwordField" name="password" placeholder="Kata sandi*" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <!-- Show/Hide Password Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="showPasswordToggle" class="mr-2">
                <label for="showPasswordToggle" class="text-sm text-gray-600">Tampilkan kata sandi</label>
            </div>

            <!-- Continue button -->
            <button type="submit" id="continueButton" class="custom-btn w-full text-center">Lanjutkan</button>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">Belum punya akun?
                <a href="signup.php" class="text-blue-500">Daftar</a>
            </p>
        </div>
    </div>

    <script>
        // JavaScript to toggle password visibility
        document.getElementById('showPasswordToggle').addEventListener('change', function() {
            var passwordField = document.getElementById('passwordField');
            if (this.checked) {
                passwordField.type = 'text'; // Show password
            } else {
                passwordField.type = 'password'; // Hide password
            }
        });
    </script>

</body>

</html>