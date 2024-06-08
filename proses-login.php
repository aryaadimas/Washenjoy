<?php
session_start();
require_once 'vendor/autoload.php'; // Pastikan Anda telah menginstal Facebook SDK

$fb = new Facebook\Facebook([
    'app_id' => 'YOUR_APP_ID',
    'app_secret' => 'YOUR_APP_SECRET',
    'default_graph_version' => 'v11.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exception\ResponseException $e) {
    // Tangani error jika terjadi kesalahan dalam permintaan
} catch(Facebook\Exception\SDKException $e) {
    // Tangani error jika terjadi kesalahan dalam SDK
}

if (isset($accessToken)) {
    // Token berhasil diperoleh, dapatkan informasi pengguna
    try {
        $response = $fb->get('/me?fields=id,name,email', $accessToken);
        $user = $response->getGraphUser();
        
        // Lakukan tindakan seperti menyimpan informasi pengguna ke dalam database
        // Atau melakukan login ke dalam aplikasi
    } catch(Facebook\Exception\ResponseException $e) {
        // Tangani error jika terjadi kesalahan dalam permintaan
    } catch(Facebook\Exception\SDKException $e) {
        // Tangani error jika terjadi kesalahan dalam SDK
    }
}

// Kembali ke halaman login setelah selesai
header('Location: pelanggan/index.php');