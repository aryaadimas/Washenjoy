<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item_id"])) {
    $item_id = $_POST["item_id"];

    $query = "SELECT harga_peritem FROM tb_item WHERE id_item = '$item_id'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data = array("harga" => $row["harga_peritem"]);
        echo json_encode($data);
    }
}

mysqli_close($koneksi);
?>