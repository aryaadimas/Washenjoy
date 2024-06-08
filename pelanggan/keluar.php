<?php 

include '../koneksi.php';

session_start();
session_destroy();

unset($_SESSION['id']);
unset($_SESSION['pelanggan_type']);

header("location:../index.php");
?>