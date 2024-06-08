<?php 
session_start();
include '../koneksi.php';
// Periksa apakah session username telah diatur
if (!isset($_SESSION['pelanggan_type'])) {
    echo '<script language="javascript" type="text/javascript">
    alert("Nama Anda Belum Terdaftar, Mohon Daftarkan Diri Anda!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
    exit;
}

$idP = $_SESSION['pelanggan'];
$dataP = "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$idP'";
$result = mysqli_query($koneksi, $dataP);
$p = mysqli_fetch_assoc($result);

// Memeriksa apakah profil customer sudah lengkap
$profil_lengkap = !empty($p['nama_pelanggan']) &&
                 !empty($p['alamat']) &&
                 !empty($p['nomor_hp']) &&
                 !empty($p['email']) &&
                 !empty($p['foto']);

//notifikasi
$query = "SELECT COUNT(*) AS new_notifications FROM tb_order WHERE status_order AND status_notif='belum dilihat' AND pel_id='$idP'";
$notif = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($notif);
$newNotifications = $row['new_notifications'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Laundry - Oder Pelanggan</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

  <style>
    .card-img-top {
       max-width: 96%;
        height: 200px;
        margin: 0 auto;
        margin-top: 10px;
    }

    .rating {
      font-size: 24px; /* Atur ukuran ikon rating sesuai kebutuhan */
      color: gold;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <!-- <a class="navbar-brand brand-logo" href="index.php"><img src="images/ts.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logots.png" alt="logo"/></a> -->
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
             <img src="pelanggan1/<?php echo $p['foto']; ?>" alt="profile"/>
              <span class="nav-profile-name"><?php echo $p['nama_pelanggan']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="keluar.php">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-user-status dropdown">
              <p class="mb-0">Last login was 23 hours ago.</p>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-date dropdown">
            <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
              <h6 class="date mb-0">Today : <?php include 'tanggal.php'; ?></h6>
              <i class="typcn typcn-calendar"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="typcn typcn-messages mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown mr-0">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="typcn typcn-bell mx-0"></i>
              <?php if ($newNotifications > 0) : ?>
                <span class="badge badge-danger" style="font-size: 9px;"><?php echo $newNotifications; ?></span>
              <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <?php include 'notifikasi.php'; ?>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close typcn typcn-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close typcn typcn-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove typcn typcn-delete-outline"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove typcn typcn-delete-outline"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove typcn typcn-delete-outline"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove typcn typcn-delete-outline"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove typcn typcn-delete-outline"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="typcn typcn-media-record-outline text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
              <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="typcn typcn-media-record-outline text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order.php">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Order Laundry</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transaksi_oderan.php">
              <i class="typcn typcn-film menu-icon"></i>
              <span class="menu-title">Orderan Anda</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="keluar.php">
              <i class="typcn typcn-eject text-primary"></i> 
              <span class="menu-title">Keluar</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Cucian Laundry</h4>
                  <p class="card-description">
                    <h6 class="badge badge-warning">Silakan Pilih Sama Karyawan Mana Anda Ingin Laundry</h6>
                  </p>
                  <?php if (!$profil_lengkap) { ?>
                    <div class="alert alert-sm alert-danger">
                      <strong>Perhatian!</strong> Lengkapi profil Anda sebelum memilih Karyawan. <a href="" data-toggle="modal" data-target="#pelModal<?php echo $idP; ?>">Klik di sini</a> untuk mengisi data.
                    </div>
                  <?php } ?>
                  <hr>
                  <div class="table-responsive">
                    <div class="row">
                      <?php 
                      $dataK = "SELECT * FROM tb_karyawan WHERE jabatan = 'Pencucian'";
                      $result = mysqli_query($koneksi, $dataK);
                      while ($k = mysqli_fetch_assoc($result)) {
                        $idk = $k['id_karyawan'];
                      ?>
                      <div class="col-md-4 mb-4">
                        <div class="card" style="margin-bottom: 20px; text-align: center;">
                          <img src="../admin/karyawan/<?php echo $k['foto_kar']; ?>" class="card-img-top" alt="Foto Karyawan" title="<?php echo $k['nama_karyawan']; ?>">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $k['nama_karyawan']; ?></h5>
                            <div>
                              <center>
                                  <?php
                                  $query1 = "SELECT * FROM rating WHERE kar_pencuci='$idk'";
                                  $result1 = mysqli_query($koneksi, $query1);

                                  // Hitung rata-rata rating
                                  $jumlah_rating = mysqli_num_rows($result1);
                                  $total_rating = 0;
                                  while ($row1 = mysqli_fetch_array($result1)) {
                                    $total_rating += $row1['rating_pencuci'];
                                  }
                                  if ($jumlah_rating > 0) {
                                    $rata_rating = $total_rating / $jumlah_rating;
                                  } else {
                                    $rata_rating = 0;
                                  }

                                  // Tampilkan rata-rata rating pada halaman toko online dalam bentuk ikon bintang
                                  echo "<div class='rating'>";
                                  for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rata_rating) {
                                      echo "<span class='typcn typcn-star' style='font-size: 20px; color: gold;'></span>";
                                    } else {
                                      echo "<span class='typcn typcn-star-outline' style='font-size: 20px; color: gray;'></span>";
                                    }
                                  }
                                  echo "</div>";
                                ?>
                              </center>
                            </div>
                            <?php if (!$profil_lengkap) { ?>
                              <div class="alert alert-sm alert-danger">
                                <p style="font-size: 12px;">Tidak Bisa Pilih Karyawan</p>
                              </div>
                            <?php }else{ ?>
                              <p class="card-text">
                                <a class="btn btn-sm btn-primary" href="pilih_kar.php?id=<?php echo $k['id_karyawan']; ?>"> Pilih Karyawan</a>
                              </p>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="pelModal<?php echo $idP; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="update_pel.php" enctype="multipart/form-data">
                        <!-- Form untuk Menampilkan Tanggal -->
                        <input type="hidden" name="idP" value="<?php echo $idP; ?>">
                        <div class="form-group">
                            <label for="">Nama Pelanggan:</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $p['nama_pelanggan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Pelanggan:</label>
                            <textarea type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" required><?php echo $p['alamat'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">No.Hp/Wa Pelanggan:</label>
                            <input type="number" class="form-control" name="nohp" placeholder="Masukkan No.Hp/Wa" value="<?php echo $p['nomor_hp'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email Pelanggan:</label>
                            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" value="<?php echo $p['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Foto Pelanggan:</label>
                            <input type="file" class="form-control" name="foto"><br>
                            <img src="pelanggan1/<?php echo $p['foto']; ?>" width="70px" height="70px" alt="Foto Pelanggan" title="<?php echo $p['nama_pelanggan']; ?>">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y"); ?> <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">AANDANU, S.Kom</a>. All rights reserved.</span>
                    </div>
                </div>    
            </div>        
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
