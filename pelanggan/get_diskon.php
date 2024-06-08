<?php
// Koneksi ke database
include '../koneksi.php';

// Memeriksa apakah berat dikirim melalui POST
if(isset($_POST['berat'])) {
    // Mengambil berat dari POST
    $berat = $_POST['berat'];

    // Mengambil data diskon dari tabel tb_diskon berdasarkan berat
    $sql = "SELECT harga_diskon FROM tb_diskon WHERE berat = $berat";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Jika ditemukan data diskon berdasarkan berat
        $row = $result->fetch_assoc();
        $diskonData['harga_diskon'] = $row['harga_diskon'];

        // Mengembalikan data diskon dalam format JSON
        echo json_encode($diskonData);
    } else {
        // Jika tidak ditemukan data diskon berdasarkan berat
        echo json_encode(array('harga_diskon' => 0));
    }
} else {
    // Jika berat tidak dikirim melalui POST
    echo json_encode(array('error' => 'Berat tidak ditemukan dalam permintaan'));
}

// Menutup koneksi ke database
$koneksi->close();
?>