<?php 
include '../koneksi.php';
session_start();

$idP = $_SESSION['pelanggan'];
$idk = $_POST['idk'];
$total = $_POST['total_semua'];
$tanggal = date('Y-m-d');

// Buat kode transaksi acak 6 digit
$kode_transaksi = rand(100000, 999999);

//insert order
$sql = "INSERT INTO tb_order (kodeorder, pel_id, kar_id, status_order, tanggal_order, tgl_selesai, total_harga, status_notif) VALUES ('$kode_transaksi', '$idP', '$idk', '1', '$tanggal', '', '$total', 'belum dilihat')";
mysqli_query($koneksi, $sql);
$id_terbaru = mysqli_insert_id($koneksi);
$id_odr = $id_terbaru;

$jumlah_isi_keranjang = count($_SESSION['keranjang']);

for($a = 0; $a < $jumlah_isi_keranjang; $a++){
    $item_id = $_SESSION['keranjang'][$a]['item'];
    $jml = $_SESSION['keranjang'][$a]['jumlah'];
    $brt = $_SESSION['keranjang'][$a]['berat'];
    $estimasi = $_SESSION['keranjang'][$a]['estimasi'];

    $item_data = "SELECT * FROM tb_item WHERE id_item='$item_id'";
    $result = mysqli_query($koneksi, $item_data);
    $i = mysqli_fetch_assoc($result);

    $d = mysqli_query($koneksi, "SELECT * FROM tb_diskon WHERE berat = $brt");
    $rd = mysqli_fetch_assoc($d);
    $harga_d = $rd['harga_diskon'] ?? null;

    $e = mysqli_query($koneksi, "SELECT * FROM tb_estimasi WHERE id_estimasi = $estimasi");
    $re = mysqli_fetch_assoc($e);
    $harga_e = $re['harga_perkilo'] ?? null;

    $hasil = $brt * $harga_e;

    $item = $i['id_item'];
    $jumlah = $_SESSION['keranjang'][$a]['jumlah'];
    $berat = $_SESSION['keranjang'][$a]['berat'];
    $harga = $i['harga_peritem'];
    $harga_beli = $harga * $jumlah - $harga_d + $hasil;


    $file_name = $_FILES['bukti']['name'];
    $file_tmp = $_FILES['bukti']['tmp_name'];


    $target_dir = "../admin/bukti/";
    $target_file = $target_dir . basename($file_name);


    move_uploaded_file($file_tmp, $target_file);


    $sql1 = "INSERT INTO tb_detail_order (order_id, item_id, jumlah_item, berat, estimasi, total_harga_peritem, bukti) VALUES ('$id_odr', '$item', '$jumlah', '$berat', '$harga_e', '$harga_beli', '$file_name')";
    mysqli_query($koneksi, $sql1);


    mysqli_query($koneksi,"insert into tb_transaksi values(NULL,'$id_odr','','$tanggal','$total')");

    unset($_SESSION['keranjang'][$a]);
}
echo '<script language="javascript" type="text/javascript">
alert("Laundry Berhasil Diorder !!");</script>';
echo "<meta http-equiv='refresh' content='0; url=pilih_kar.php?id=$idk'>";
?>
