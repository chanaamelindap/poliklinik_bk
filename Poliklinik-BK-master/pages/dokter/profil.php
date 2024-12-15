<?php
session_start();

$username = $_SESSION["username"];

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

// Ambil data dari tabel dokter berdasarkan username
$dokter = query("SELECT * FROM dokter WHERE username = '$username'");

// Cek apakah data dokter ditemukan
if (!$dokter || count($dokter) === 0) {
    $dokter = [
        "nama" => "",
        "alamat" => "",
        "no_hp" => ""
    ];
} else {
    $dokter = $dokter[0];
}

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    if (edit_profil($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'profil.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diedit!');
                document.location.href = 'profil.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #C8E6C9, #A5D6A7);
        }
    </style>
</head>

<body class="flex gap-5">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_dokter.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-white pb-10 rounded-lg shadow-lg">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/pasien-icon.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Profil Dokter</h1>
        </header>

        <article class="mx-8 mt-8 p-8 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-medium text-[#388E3C] mb-5">Edit Data Dokter</h2>
            <form action="" method="post" class="flex flex-col gap-5">
                <input type="hidden" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
                
                <div class="flex flex-col gap-3">
                    <label for="nama" class="text-lg font-medium">Nama Dokter</label>
                    <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($dokter["nama"]) ?>"
                        class="px-4 py-3 outline-none rounded-lg border border-gray-300 focus:border-[#81C784]">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="alamat" class="text-lg font-medium">Alamat Dokter</label>
                    <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($dokter["alamat"]) ?>"
                        class="px-4 py-3 outline-none rounded-lg border border-gray-300 focus:border-[#81C784]">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="no_hp" class="text-lg font-medium">Telepon Dokter</label>
                    <input type="text" name="no_hp" id="no_hp" value="<?= htmlspecialchars($dokter["no_hp"]) ?>"
                        class="px-4 py-3 outline-none rounded-lg border border-gray-300 focus:border-[#81C784]">
                </div>

                <button type="submit" name="submit"
                    class="bg-[#43A047] w-fit mx-auto py-3 px-6 text-white font-medium rounded-lg hover:bg-[#388E3C]">
                    Simpan Perubahan
                </button>
            </form>
        </article>
    </main>
</body>

</html>
