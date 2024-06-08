<?php 
include 'koneksi.php';

$id = $_POST['ido'];
$idk = $_POST['idk'];
$status = $_POST['status'];

$sql = "UPDATE tb_order SET status_order = '$status', kurir_antar='$idk', status_notif='belum dilihat' WHERE id_order = '$id'";
$koneksi->query($sql);

header("location:order.php");

?>