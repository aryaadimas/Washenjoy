<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Login Laundry</title>
  <!-- base:css -->
  <link rel="stylesheet" href="pelanggan/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="pelanggan/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="pelanggan/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="pelanggan/images/favicon.png" />

  <style>
    body {
        background-image: url('banner.jpg'); /* Ganti dengan URL gambar latar belakang Anda */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center center;
        min-height: 100vh; /* Ini akan memastikan latar belakang mengisi seluruh tinggi viewport */
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <center>
                <img src="pelanggan/images/laundry.png" alt="logo" height="90px">
                </center>
              </div>
              <h4 class="text-center">Halo! Mari kita mulai</h4>
              <h6 class="font-weight-light text-center">Masuk untuk melanjutkan..</h6>
              <form id="login-form" action="proses-login.php" method="POST">
                  <!-- Form login biasa di sini -->
                  <center>
                    <button class="btn btn-sm btn-primary" type="submit" id="fb-login">Login dengan Facebook</button>
                  </center>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="pelanggan/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="pelanggan/js/off-canvas.js"></script>
  <script src="pelanggan/js/hoverable-collapse.js"></script>
  <script src="pelanggan/js/template.js"></script>
  <script src="pelanggan/js/settings.js"></script>
  <script src="pelanggan/js/todolist.js"></script>
  <!-- endinject -->

  <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: 'YOUR_APP_ID',
            cookie: true,
            xfbml: true,
            version: 'v11.0'
        });

        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                // Pengguna sudah login dengan Facebook
                // Lakukan tindakan yang sesuai di sini
            }
        });

        document.getElementById('fb-login').addEventListener('click', function() {
            FB.login(function(response) {
                if (response.status === 'connected') {
                    // Pengguna berhasil login dengan Facebook
                    // Lakukan tindakan yang sesuai di sini
                }
            }, {scope: 'public_profile,email'});
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>

</html>
