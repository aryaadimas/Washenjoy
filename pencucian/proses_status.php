<?php 
include 'koneksi.php';

$id = $_POST['ido'];
$status = $_POST['status'];

$sql = "UPDATE tb_order SET status_order = '$status', status_notif = 'belum dilihat' WHERE id_order = '$id'";
$koneksi->query($sql);

header("location:order.php");

?>