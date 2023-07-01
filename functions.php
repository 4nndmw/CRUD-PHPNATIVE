<?php

require_once "./db/config.php";

function query($ambil)
{
    global $conn;
    $result = mysqli_query($conn, $ambil);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// tambah data //////////////////
function tambah($data)
{
    global $conn;
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa 
            (nrp, nama, jurusan, gambar)            
                        VALUES 
            ('$nrp', '$nama', '$jurusan', '$gambar')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah gambar tidak ada yg di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
                </script>";
        return false;
    }

    // cek upload hanya gambar
    $ekstesiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstesiGambar = explode('.', $namaFile);
    $ekstesiGambar = strtolower(end($ekstesiGambar));
    if (!in_array($ekstesiGambar, $ekstesiGambarValid)) {
        echo "<script>
            alert('yang anda upload bukan file');
            </script>";
        return false;
    }

    // cek ukuran terlalu besar
    if ($ukuranFile > 100000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar');
            </script>";
    }

    // lolos pengecekan, gambar sia di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstesiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// Hapus data//////////////////
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

//  ubah data //////////////////
function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    $query = " UPDATE mahasiswa SET 
                nrp = '$nrp', 
                nama = '$nama',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
                ";


    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa 
                        WHERE
                    nama LIKE '%$keyword%' OR
                    nrp LIKE '%$keyword%' OR 
                    jurusan LIKE '%$keyword%' 
                        ";
    return query($query);
}

function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "</script>
                      alert('username sudah terdaftar');
                   </script>";
        return false;
    }
    // cek konfirmasi password
    if ($password != $password2) {
        echo "<script>
                    alert('Konfirmasi password tidak sesuai');
                    </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah userbaru ke database 
    mysqli_query($conn, "INSERT INTO user (username,password) VALUES ('$username', '$password')");
    return mysqli_affected_rows($conn);
}
