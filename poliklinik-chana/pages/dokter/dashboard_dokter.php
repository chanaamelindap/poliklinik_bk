<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #C8E6C9; /* Pastel green background */
        }

        a {
            background: #81C784; /* Light green for buttons */
            border-radius: 10px;
            color: white;
            transition: background 0.3s ease;
        }

        a:hover {
            background: #66BB6A; /* Slightly darker green on hover */
            color: white;
        }

        main {
            background: #FFFFFF; /* White background for the main content */
            border-radius: 15px;
        }

        body, a, main {
            color: #333333; /* Dark font color for better visibility */
        }
    </style>
</head>

<body class="flex gap-5">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_dokter.php"); ?>
    <!-- Side Bar End -->

    <main class="grid grid-cols-2 divide-x divide-y divide-gray-300 overflow-hidden w-3/4 bg-[#C8E6C9] rounded-2xl my-7 mx-auto p-5">
        <a href="jadwal_periksa.php"
            class="flex justify-center items-center gap-5 px-10 py-8 hover:bg-[#66BB6A] group transition-all duration-300">
            <img src="../../assets/icons/clipboard-list.svg" alt="" width="80px" class="p-2 rounded-lg invert group-hover:invert-0">
        </a>

        <a href="memeriksa_pasien.php"
            class="flex justify-center items-center gap-5 px-10 py-8 hover:bg-[#66BB6A] group transition-all duration-300">
            <img src="../../assets/icons/stethoscope-icon.svg" alt="" width="80px" class="p-2 rounded-lg invert group-hover:invert-0">
        </a>

        <a href="riwayat_pasien.php"
            class="flex justify-center items-center gap-5 px-10 py-8 hover:bg-[#66BB6A] group transition-all duration-300">
            <img src="../../assets/icons/notebook-pen.svg" alt="" width="80px" class="p-2 rounded-lg invert group-hover:invert-0">
        </a>

        <a href="profil.php"
            class="flex justify-center items-center gap-5 px-10 py-8 hover:bg-[#66BB6A] group transition-all duration-300">
            <img src="../../assets/icons/pasien-icon.svg" alt="" width="80px" class="p-2 rounded-lg invert group-hover:invert-0">
        </a>
    </main>
</body>

</html>
