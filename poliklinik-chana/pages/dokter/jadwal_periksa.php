<?php
session_start();

$username = $_SESSION["username"];

if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

$nama_dokter = $_SESSION['username'];
$id_dokter = $_SESSION['id'];

// Ambil data dari tabel poli
$stmt = $conn->prepare("SELECT * FROM jadwal_periksa WHERE id_dokter = ?");
$stmt->bind_param("i", $id_dokter);
$stmt->execute();
$result = $stmt->get_result();
$jadwal_periksa = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jadwal_periksa[] = $row;
    }
}
$stmt->close();

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    $hari = $_POST['hari'] ?? '';
    $jam_mulai = $_POST['jam_mulai'] ?? '';
    $jam_selesai = $_POST['jam_selesai'] ?? '';

    // Validasi input
    if (!empty($hari) && !empty($jam_mulai) && !empty($jam_selesai)) {
        $stmt = $conn->prepare("INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_dokter, $hari, $jam_mulai, $jam_selesai);

        if ($stmt->execute()) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'jadwal_periksa.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'jadwal_periksa.php';
                </script>
            ";
        }
        $stmt->close();
    } else {
        echo "
            <script>
                alert('Semua data harus diisi!');
                document.location.href = 'jadwal_periksa.php';
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
    <title>Jadwal Periksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #E8F5E9, #C8E6C9);
        }

        header {
            background-color: #A5D6A7;
            color: #2E7D32;
        }

        main {
            background-color: #E8F5E9;
        }

        .form-section {
            background-color: #C8E6C9;
        }

        table th {
            background-color: #81C784;
            color: white;
        }

        table td {
            background-color: #C8E6C9;
        }
    </style>
</head>

<body class="flex gap-5">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_dokter.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full pb-10 rounded-lg shadow-lg">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/clipboard-list.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Jadwal Periksa dr. <?= $nama_dokter ?></h1>
        </header>

        <article>
            <form action="" method="post" class="form-section flex flex-col gap-5 mt-8 mx-5 p-8 rounded-2xl">
                <input type="hidden" name="id_dokter" id="" value="<?= $id_dokter ?>">

                <div class="flex flex-col gap-3">
                    <label for="hari" class="text-lg font-medium">Hari</label>
                    <select id="hari" name="hari" class="px-4 py-3 outline-none rounded-lg">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                <div class="flex flex-col gap-3">
                    <label for="jam_mulai" class="text-lg font-medium">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="jam_selesai" class="text-lg font-medium">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" class="px-4 py-3 outline-none rounded-lg">
                </div>

                <button type="submit" name="submit" class="bg-green-500 w-fit py-3 px-6 text-white font-medium rounded-lg">Tambah Data</button>
            </form>

            <section class="mt-8 mx-5 p-8 border border-gray-300 rounded-2xl">
                <h1 class="mb-5 text-2xl font-medium">Daftar Jadwal Periksa</h1>
                <table class="w-full table-fixed border border-gray-300">
                    <thead>
                        <tr>
                            <th class="w-[5%] border border-slate-500 py-3">No</th>
                            <th class="w-[20%] border border-slate-500 py-3">Nama Dokter</th>
                            <th class="w-[25%] border border-slate-500 py-3">Hari</th>
                            <th class="w-[20%] border border-slate-500 py-3">Jam Mulai</th>
                            <th class="w-[20%] border border-slate-500 py-3">Jam Selesai</th>
                            <th class="w-[30%] border border-slate-500 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $index = 1; ?>
                        <?php foreach ($jadwal_periksa as $item) : ?>
                            <tr>
                                <td class="border border-slate-500 py-5 text-center">
                                    <?= $index  ?>
                                </td>
                                <td class="border border-slate-500 py-5 text-center">
                                    <?= $nama_dokter ?>
                                </td>
                                <td class="border border-slate-500 py-5 text-center">
                                    <?= $item["hari"] ?>
                                </td>
                                <td class="border border-slate-500 py-5 text-center">
                                    <?= $item["jam_mulai"] ?>
                                </td>
                                <td class="border border-slate-500 py-5 text-center">
                                    <?= $item["jam_selesai"] ?>
                                </td>
                                <td class="border border-slate-500 py-5 text-center">
                                    <a href="edit_jadwal_periksa.php?id=<?= $item["id"] ?>" class="bg-green-500 px-6 py-2 rounded-lg text-white mr-3">Edit</a>
                                    <a href="hapus_jadwal_periksa.php?id=<?= $item["id"] ?>" class="bg-red-500 px-6 py-2 rounded-lg text-white">Delete</a>
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
