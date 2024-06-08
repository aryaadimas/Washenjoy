<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id = $_POST["idk"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $nomor_hp = $_POST["nomor_hp"];

    // Periksa apakah ada file gambar yang diunggah
    if ($_FILES["gambar"]["name"]) {
        $gambar = $_FILES["gambar"]["name"];
        $gambar_tmp = $_FILES["gambar"]["tmp_name"];

        // Pindahkan file gambar ke direktori yang diinginkan
        move_uploaded_file($gambar_tmp, "../admin/karyawan/" . $gambar);
    } else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar yang sudah ada di database
        $query = "SELECT foto_kar FROM tb_karyawan WHERE id_karyawan = $id";
        $result = $koneksi->query($query);
        $row = $result->fetch_assoc();
        $gambar = $row["foto_kar"];
    }

    // Perbarui data karyawan dalam database
    $query = "UPDATE tb_karyawan SET nama_karyawan='$nama', alamat_karyawan='$alamat', nomor_hp='$nomor_hp', foto_kar='$gambar' WHERE id_karyawan = $id";

    if ($koneksi->query($query) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
        alert("Data karyawan '.$nama.' berhasil diperbarui.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=karyawan.php'>";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }

    // Tutup koneksi database
    $koneksi->close();
}
?>