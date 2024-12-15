<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

// Ambil data dari tabel poli
$poli = query("SELECT * FROM poli");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil ditambahkan atau tidak
    if(tambah_poli($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
            </script>
        ";
        header("Location: kelola_poli.php");
    } else{
        echo "
             <script>
                alert('Data gagal ditambahkan!');
            </script>
        ";
        header("Location: kelola_poli.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Poli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #C8E6C9, #A5D6A7);
        }
    </style>
</head>

<body class="flex gap-5">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_admin.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-white pb-10 rounded-lg shadow-lg">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/building-icon.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Kelola Poli</h1>
        </header>

        <article>
            <form action="" method="post" class="flex flex-col gap-5 mt-8 mx-5 p-8 bg-white shadow-lg rounded-lg">
                <h2 class="text-xl font-semibold text-[#388E3C]">Tambah Data Poli</h2>

                <div class="flex flex-col gap-3">
                    <label for="nama_poli" class="text-lg font-medium">Nama Poli</label>
                    <input type="text" name="nama_poli" id="nama_poli" placeholder="Nama Poli"
                        class="px-4 py-3 outline-none border rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="keterangan" class="text-lg font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan"
                        class="px-4 py-3 outline-none border rounded-lg">
                </div>

                <button type="submit" name="submit"
                    class="bg-[#388E3C] py-3 px-6 text-white font-medium rounded-lg hover:bg-[#2E7D32]">Tambah
                    Data</button>
            </form>

            <section class="mt-8 mx-5 p-8 bg-white shadow-lg rounded-lg">
                <h1 class="mb-5 text-2xl font-medium text-[#388E3C]">Daftar Poli</h1>
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-[#81C784] text-white">
                        <tr>
                            <th class="w-[5%] py-3">No</th>
                            <th class="w-[20%] py-3">Nama Poli</th>
                            <th class="w-[25%] py-3">Keterangan</th>
                            <th class="w-[30%] py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <?php $index = 1; ?>
                        <?php foreach($poli as $item) : ?>
                        <tr class="border-t">
                            <td class="py-5 text-center">
                                <?= $index  ?>
                            </td>

                            <td class="py-5 text-center">
                                <?= $item["nama_poli"]  ?>
                            </td>

                            <td class="py-5 text-center">
                                <?= $item["keterangan"] ?>
                            </td>

                            <td class="py-5 text-center flex justify-center gap-3">
                                <a href="edit_poli.php?id=<?= $item["id"] ?>" class="bg-[#43A047] px-4 py-2 rounded-lg text-white hover:bg-[#388E3C]">Edit</a>
                                <a href="hapus_poli.php?id=<?= $item["id"] ?>" class="bg-[#E53935] px-4 py-2 rounded-lg text-white hover:bg-[#D32F2F]">Delete</a>
                            </td>
                        </tr>
                        <?php $index++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </article>
    </main>
</body>

</html>
