<?php
// Koneksi ke database (ganti dengan koneksi Anda)
include 'koneksi.php';

// Ambil data dari form registrasi
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Mengenkripsi password

// Masukkan data ke tabel pelanggan
$sql = "INSERT INTO tb_pelanggan (username_pel, password_pel, nama_pelanggan, alamat, nomor_hp, email, foto, last_login) VALUES ('$username', '$password', '$nama', '', '', '$email', '', '')";

if ($koneksi->query($sql) === TRUE) {
    // Registrasi berhasil, arahkan ke halaman home pasien dengan sessions
    session_start();
    $_SESSION['pelanggan'] = $koneksi->insert_id;
    $_SESSION['pelanggan_type'] = 'pelanggan';
    $_SESSION['username'] = $username;
    $_SESSION['nama_pelanggan'] = $nama;
    echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Mendaftar, Silakan Masuk '.$_SESSION['nama_pelanggan'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=pelanggan/index.php'>";
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}
?>