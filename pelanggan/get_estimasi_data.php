<?php
// Koneksi ke database atau logika lainnya untuk mendapatkan data estimasi
include '../koneksi.php';

// Ambil data estimasi berdasarkan estimasi_id yang diterima dari permintaan AJAX
if (isset($_POST['estimasi_id'])) {
    $estimasi_id = $_POST['estimasi_id'];

    // Query untuk mengambil data estimasi dari database
    $query = "SELECT harga_perkilo FROM tb_estimasi WHERE id_estimasi = $estimasi_id";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        // Ambil hasil query
        $row = $result->fetch_assoc();

        // Buat array untuk dijadikan response JSON
        $response = array(
            'harga_perkilo' => $row['harga_perkilo']
        );

        // Mengembalikan hasil dalam format JSON
        echo json_encode($response);
    } else {
        echo "Data estimasi tidak ditemukan";
    }
} else {
    echo "Estimasi ID tidak ditemukan";
}

// Tutup koneksi database
$koneksi->close();
?>