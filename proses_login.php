<?php
session_start();

// Connect to the database
include 'koneksi.php';

// Get the submitted username and password
$username = $_POST['username'];
$password = md5($_POST['password']); // Hash the password using MD5 (not recommended for production)

// Check if the user is an admin
$query = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    // Admin login successful
    $data = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $data['id_admin'];
    $_SESSION['nama'] = $data['nama_lengkap'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['status'] = "login";

    echo '<script language="javascript" type="text/javascript">
    alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama'].'!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=admin/index.php'>";
    exit();
}

// Check if the user is a regular pelanggan
$query = "SELECT * FROM tb_pelanggan WHERE username_pel='$username' AND password_pel='$password' LIMIT 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    // Regular user login successful
    $data = mysqli_fetch_assoc($result);

     // Update data terakhir login ke database
    $sql = "UPDATE tb_pelanggan SET last_login = NOW() WHERE username_pel = '$username'";
    $koneksi->query($sql);

    $_SESSION['pelanggan_type'] = 'pelanggan';
    $_SESSION['pelanggan'] = $data['id_pelanggan'];
    $_SESSION['nama'] = $data['nama_pelanggan'];

    echo '<script language="javascript" type="text/javascript">
    alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama'].'!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=pelanggan/index.php'>";
    exit();
}

// Check if the Karyawan
$query = "SELECT * FROM tb_karyawan WHERE username_kar='$username' AND password_kar='$password' LIMIT 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    // Regular user login successful
    $data = mysqli_fetch_assoc($result);

    $_SESSION['karyawan_type'] = 'karyawan';
    $_SESSION['karyawan'] = $data['id_karyawan'];
    $_SESSION['nama_kar'] = $data['nama_karyawan'];
    $_SESSION['jabatan'] = $data['jabatan'];

    if ($_SESSION['jabatan'] == 'Petugas Jemput') {
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama_kar'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=petugas_jemput/index.php'>";
        exit();
    }elseif($_SESSION['jabatan'] == 'Pencucian'){
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama_kar'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=pencucian/index.php'>";
        exit();
    }elseif ($_SESSION['jabatan'] == 'Petugas Antar') {
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama_kar'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=petugas_antar/index.php'>";
        exit();
    }
}

// If login failed, redirect back to the login page with an error message
header("Location: index.php?error=1");
exit();
?>