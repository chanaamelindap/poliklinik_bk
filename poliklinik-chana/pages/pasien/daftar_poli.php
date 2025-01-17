<?php
session_start();

$username = $_SESSION['username'];

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

// Ambil data dari tabel poli
$poli = query("SELECT * FROM poli");

// Memeriksa apakah tombol submit sudah ditekan atau belum dan melakukan aksi
if (isset($_POST["submit"])) {
    // Validasi input no_rm
    $no_rm = trim($_POST["no_rm"]);
    if (empty($no_rm)) {
        echo "<script>alert('Nomor Rekam Medis tidak boleh kosong!');</script>";
    } else {
        $_SESSION['no_rm'] = $no_rm;
        $_SESSION['id_poli'] = $_POST["poli"];
        header("Location: pilih_jadwal.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #DFF5E5, #A9DAB5);
        }

        header {
            background: linear-gradient(to right, #A3D9A5, #D4F5D0);
        }

        h1 {
            color: #2E7D32;
        }

        h2 {
            color: #388E3C;
        }

        label {
            color: #1B5E20;
        }

        input,
        select {
            border-color: #A5D6A7;
        }

        button {
            background-color: #4CAF50;
        }

        button:hover {
            background-color: #388E3C;
        }
    </style>
</head>

<body class="flex gap-5">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_pasien.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-white pb-10 rounded-lg shadow-lg">
        <header class="flex items-center gap-3 px-8 py-7 rounded-t-lg shadow-lg">
            <img src="../../assets/icons/stethoscope-icon.svg" alt="Icon" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Daftar Poli</h1>
        </header>

        <article class="mx-8 mt-8 p-8 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-medium mb-5">Langkah 1: Masukkan Informasi Anda</h2>
            <form action="" method="post" class="flex flex-col gap-5">
                <!-- Input Nomor Rekam Medis -->
                <div class="flex flex-col gap-3">
                    <label for="no_rm" class="text-lg font-medium">Nomor Rekam Medis</label>
                    <input type="text" name="no_rm" readonly id="no_rm" value="<?= $_SESSION['no_rm']; ?>" placeholder="Masukkan Nomor Rekam Medis"
                        class="px-4 py-3 outline-none rounded-lg border focus:border-[#81C784]">
                </div>

                <!-- Pilihan Poli -->
                <div class="flex flex-col gap-3">
                    <label for="poli" class="text-lg font-medium">Pilih Poli</label>
                    <select id="poli" name="poli" class="px-4 py-3 outline-none rounded-lg border focus:border-[#81C784]">
                        <?php foreach ($poli as $item) : ?>
                            <option value="<?= htmlspecialchars($item["id"]) ?>"><?= htmlspecialchars($item["nama_poli"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tombol Lanjut -->
                <button type="submit" name="submit"
                    class="w-full mx-auto py-3 px-6 text-white font-medium rounded-lg transition duration-300">
                    Lanjut
                </button>
            </form>
        </article>
    </main>
</body>

</html>
