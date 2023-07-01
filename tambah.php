<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
require 'functions.php';
$conn =  mysqli_connect("localhost", "root", "", "schools");

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil di tambahkan');
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal di tambahkan');
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
    <title>Tambah data mahasiswa</title>
    <link rel="stylesheet" href="src/tambah.css">
</head>

<body>
    <h1>Tambah data mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data"> <!-- data yang siap di isi pada menu form -->
        <ul>
            <li>
                <label for="nrp"> nrp :</label>
                <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
                <label for="nama"> nama :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="jurusan"> jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar"> gambar :</label>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah!</button>
            </li>
        </ul>
    </form>
    <h4><a href="index.php">kembali</a></h4>
</body>

</html>