<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

require '../functions/connect_database.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // $result = mysqli_query($conn, "SELECT * FROM dokter WHERE username = '$username'"); // Cek di database apakah ada username yg cocok atau tidak
    $result_admin = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' and role = 'pasien'");
    // Cek username
    // if (mysqli_num_rows($result) === 1) { //cek ada berapa baris yang ditemukan (pasti 1)
    //     // Cek Password
    //     $row = mysqli_fetch_assoc($result);
    //     if ($password === $row["password"]) {
    //         // Set Session
    //         $_SESSION["login"] = "true";
    //         $_SESSION["username"] = $username;
    //         header("Location: ../pages/dokter/dashboard_dokter.php?username=$username");
    //         exit;
    //     }
    // }

    if (mysqli_num_rows($result_admin) === 1) { //cek ada berapa baris yang ditemukan (pasti 1)

        $row = mysqli_fetch_assoc($result_admin);
        if ($password === $row["password"]) {
            // Set Session
            $_SESSION["login"] = "true";
            $_SESSION["username"] = $username;
            header("Location: ../pages/pasien/dashboard_pasien.php?username=$username");
            exit;
        }
    }

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #C8E6C9, #FFFFFF);
            color: #1B5E20;
        }

        .input-field {
            background-color: #F1F8E9;
        }

        .input-field:focus {
            outline: 2px solid #81C784;
        }

        .button-primary {
            background-color: #1B5E20;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button-primary:hover {
            background-color: #388E3C;
            transform: scale(1.05);
        }

        .shadow-lg {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="flex flex-col lg:flex-row h-screen">
    <!-- Left Side: Illustration -->
    <div class="flex justify-center items-center basis-1/2 h-full bg-[#81C784] p-10">
        <img src="../assets/images/pasien.jpg" alt="Dokter Illustration" class="w-4/5 lg:w-3/4 rounded-full shadow-lg">
    </div>

    <!-- Right Side: Login Form -->
    <div class="flex flex-col justify-center items-center basis-1/2 h-full bg-white py-10 px-8 lg:px-20 rounded-none lg:rounded-l-lg shadow-lg">
        <a href="../index.php" class="absolute top-8 left-8">
            <img src="../assets/icons/arrow-left.svg" alt="Back" width="30px">
        </a>

        <form action="" method="post" class="w-full max-w-md">
            <h1 class="text-center text-4xl font-semibold mb-6 text-[#1B5E20]">Login Pasien</h1>

            <div class="flex flex-col gap-4">
                <!-- Username Input -->
                <input type="text" name="username" placeholder="Username" required
                    class="input-field px-5 py-3 rounded-lg shadow focus:outline-none">
                <!-- Password Input -->
                <input type="password" name="password" placeholder="Password" required
                    class="input-field px-5 py-3 rounded-lg shadow focus:outline-none">

                <?php if (isset($error)) : ?>
                    <p class="text-red-500 text-sm mt-1">Username / Password salah!</p>
                <?php endif; ?>

                <!-- Login Button -->
                <button type="submit" name="login"
                    class="button-primary text-white py-3 rounded-lg font-medium w-full shadow-lg mt-4">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>

</html>