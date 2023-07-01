<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
require 'functions.php';

// ambil data di url
$id = $_GET['id'];
// query data mahasiswa berdasarlan idnya
$mhss = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

//   $conn =  mysqli_connect("localhost", "root", "", "hospital");


//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil di ubah atau belum 
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah');
                document.location.href = 'index.php';
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
    <title>update data mahasiswa</title>
</head>

<body>
    <h1>update data mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data"> <!-- data yang siap di isi pada menu form -->
        <input type="hidden" name="id" value="<?= $mhss["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhss["gambar"]; ?>">
        <ul>
            <li>
                <label for="nrp"> nrp :</label>
                <input type="text" name="nrp" id="nrp" required value="<?= $mhss["nrp"]; ?>">
            </li>
            <li>
                <label for="nama"> nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $mhss["nama"]; ?>">
            </li>

            <li>
                <label for="jurusan"> jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $mhss["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar"> gambar :</label>
                <img src="img/ <?= $mhs['gambar']; ?> " width="40" alt="">
                <input type="file" name="gambar" id="gambar" ?>
            </li>
            <li>
                <button type="submit" name="submit">update!</button>
            </li>
        </ul>
    </form>
    <h4><a href="index.php">kembali</a></h4>
</body>

</html>