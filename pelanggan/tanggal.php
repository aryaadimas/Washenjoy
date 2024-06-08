<?php
// Daftar bulan dalam bahasa Indonesia
$bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
);

// Mendapatkan tanggal hari ini dalam format 'm-d'
$tanggal_hari_ini = date('m-d');

// Membagi tanggal menjadi bulan dan tanggal
list($bulan_angka, $tanggal) = explode('-', $tanggal_hari_ini);

// Mengonversi bulan dari angka menjadi teks dalam bahasa Indonesia
$bulan_indonesia = $bulan[(int)$bulan_angka];

// Format tanggal dengan bulan dalam bahasa Indonesia
$tanggal_format = $bulan_indonesia . ' ' . $tanggal;

echo $tanggal_format; // Output: "Maret 12"
?>