<?php 
include '../koneksi.php';

$idK = $_POST['idK'];
$item_id = $_POST['item_id'];
$jumlah = $_POST['jumlah'];
$berat = $_POST['berat'];
$estimasi = $_POST['estimasi'];

$dataI = "SELECT * FROM tb_item WHERE id_item = '$item_id'";
$result = mysqli_query($koneksi, $dataI);
$i = mysqli_fetch_assoc($result);
$nama = $i['nama_item'];

session_start();

// session_destroy();

if(isset($_SESSION['keranjang'])){
    $jumlah_isi_keranjang = count($_SESSION['keranjang']);

    $sudah_ada = 0;
    for($a = 0;$a < $jumlah_isi_keranjang; $a++){

        // cek apakah produk sudah ada dalam keranjang
        if($_SESSION['keranjang'][$a]['item'] == $item_id){

            $sudah_ada = $jumlah;
            
        }
    }

    if($sudah_ada == 0){
        $_SESSION['keranjang'][$jumlah_isi_keranjang] = array(
            'item' => $item_id,
            'jumlah' => $jumlah,
            'berat' => $berat,
            'estimasi' => $estimasi
        );

    }

}else{

    $_SESSION['keranjang'][0] = array(
        'item' => $item_id,
        'jumlah' => $jumlah,
        'berat' => $berat,
        'estimasi' => $estimasi
    );
}


echo '<script language="javascript" type="text/javascript">
    alert("Laundry '.$nama.' Terpilih!");</script>';
echo "<meta http-equiv='refresh' content='0; url=pilih_kar.php?id=$idK'>";
?>