<?php
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$pel = $_SESSION['pelanggan'];
$idO = $_POST['idO'];
$karP = $_POST['karP'];
$karJ = $_POST['karJ'];
$karA = $_POST['karA'];
$ratinglaundry = $_POST['ratinglaundry'];
$ratingpencucian = $_POST['ratingpencucian'];
$ratingkurirJ = $_POST['ratingkurirJ'];
$ratingkurirA = $_POST['ratingkurirA'];
$ket = $_POST['ket'];
$tanggal = date('Y-m-d');

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename = $_FILES['foto']['name'];

mysqli_query($koneksi, "insert into rating values (NULL,'$idO','$pel','$karP', '$karJ', '$karA','$ratinglaundry','$ratingpencucian','$ratingkurirJ','$ratingkurirA','$ket','$tanggal','')");

$last_id = mysqli_insert_id($koneksi);
$idrating = $last_id;


if($filename != ""){
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if(in_array($ext,$allowed) ) {
    move_uploaded_file($_FILES['foto']['tmp_name'], 'rating/'.$rand.'_'.$filename);
    $file_gambar = $rand.'_'.$filename;

    mysqli_query($koneksi,"update rating set foto_laundry='$file_gambar' where id_rating='$last_id'");
  }
}

mysqli_query($koneksi,"update tb_order set status_order='9', status_notif='belum dilihat' where id_order='$idO'")or die(mysqli_error($koneksi));

echo '<script language="javascript" type="text/javascript">
  alert("Konfirmasi Berhasil!");</script>';
echo "<meta http-equiv='refresh' content='0; url=transaksi_oderan.php'>";