<?php 
include '../koneksi.php';
session_start();

$item = $_GET['id'];
$idK = $_GET['idK'];

if(isset($_SESSION['keranjang'])){


	for($a=0;$a<count($_SESSION['keranjang']);$a++){
		if($_SESSION['keranjang'][$a]['item'] == $item){
			unset($_SESSION['keranjang'][$a]);

			// urutkan kembali
			sort($_SESSION['keranjang']);
		}
	}

	
}

print_r($_SESSION['keranjang']);
header("location:pilih_kar.php?id=$idK");
?>