<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';
$mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa");

// tombol cari di ketik

if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="UBM.png">
    <title>Tabel Mahasiswa</title>
    <link rel="stylesheet" href="src/style.css">
</head>

<body>
    <div class="navigation">
        <h1>Kampus UBM</h1>
        <ul>
            <li><a href="">Tabel Mahasiswa</a></li>
            <li><a href="">Beasiswa</a></li>
            <li><a href="">Sesi</a></li>
            <li><a href="">Nilai</a></li>
            <li><a href="">Pendaftaran</a></li>
        </ul>
    </div>
    <div class="container">
        <form action="" method="post">

            <div class=" list">
                <input type="text" name="keyword" autofocus placeholder="Find a patient !" autocomplete="off" size="40">
                <button class="cari" type="submit" name="cari">Cari!</button>
                <a class="add" href="tambah.php">Tambah Data</a>
            </div>

            <a class="logout" href="logout.php">Logout</a>

        </form>

        <br>
        <table border="1" cellpadding="20" cellspacing="0">
            <tr>
                <th class="ob">No</th>
                <th>Gambar</th>
                <th>Nrp</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $mhs) : ?>

                <tr>
                    <td class="ob"><?= $i ?></td>
                    <td><img src="img/<?= $mhs["gambar"] ?>" width="100"></td>
                    <td><?= $mhs["nrp"]; ?></td>
                    <td><?= $mhs["nama"]; ?></td>
                    <td><?= $mhs["jurusan"]; ?></td>
                    <td>
                        <a class="update" href="ubah.php?id=<?= $mhs["id"]; ?>">Update</a> |
                        <a class="delete" href="hapus.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Yakin anda Ingin menghapusnya ?')">Delete</a>
                    </td>
                </tr>
                <?php $i++ ?>
            <?php endforeach; ?>

        </table>
    </div>
</body>

</html>