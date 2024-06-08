<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Registrasi Laundry</title>
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
              <h4 class="text-center">Baru di sini?</h4>
              <h6 class="font-weight-light text-center">Mendaftar itu mudah. Hanya perlu beberapa langkah</h6>
              <form class="pt-3" method="POST" action="daftar.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" name="username" placeholder="Nama Pengguna">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Kata Sandi">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Sudah punya akun? <a href="index.php" class="text-primary">Login</a>
                </div>
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
</body>

</html>
