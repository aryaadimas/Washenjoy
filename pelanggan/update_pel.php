<?php
include '../koneksi.php';
// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idP = $_POST["idP"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $nohp = $_POST["nohp"];
    $email = $_POST['email'];

    // Handle the uploaded image
    $gambar = $_FILES["foto"]["name"];
    $target_dir = "pelanggan1/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // File upload was successful
    } else {
        // File upload failed or no new image was selected
        if (empty($gambar)) {
            // If no new image was selected, retain the existing image path
            $sql = "SELECT foto FROM tb_pelanggan WHERE id_pelanggan='$idP'";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $gambar = $row["foto"];
            }
        }
    }

    // Proses update data ke database
    $updateQuery = "UPDATE tb_pelanggan SET nama_pelanggan='$nama', alamat='$alamat', nomor_hp='$nohp', email='$email', foto='$gambar' WHERE id_pelanggan=$idP";
    if ($koneksi->query($updateQuery) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
        alert("Data Berhasil Diupdate!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=order.php'>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $koneksi->error;
    }
}
?>