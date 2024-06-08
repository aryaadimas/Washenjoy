<?php
// Koneksi ke database
include '../koneksi.php';

// Ambil data diskon dari tabel tb_diskon
$berat = $_POST['berat'];
$sql = "SELECT harga_diskon FROM tb_diskon WHERE berat = $berat";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        echo $row["harga_diskon"];
    }
} else {
    echo "0"; // Jika tidak ada data diskon untuk berat tersebut
}

$koneksi->close();
?>