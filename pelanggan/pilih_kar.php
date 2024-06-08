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

$idK = $_GET['id'];
$idP = $_SESSION['pelanggan'];

$dataP = "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$idP'";
$result = mysqli_query($koneksi, $dataP);
$p = mysqli_fetch_assoc($result);

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
  <title>Laundry - Order Pelanggan</title>
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
      max-width: 70%;
      height: 170px;
      margin: 0 auto;
      margin-top: 10px;
    }

    .rating {
      font-size: 24px; /* Atur ukuran ikon rating sesuai kebutuhan */
    }

    .typcn-star,
    .typcn-star-outline {
      color: gold; /* Atur warna ikon rating sesuai keinginan */
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
              <a class="dropdown-item">
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
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Anda Memilih Karyawan Dengan Data :</h5>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <div class="col-md-12">
                        <?php 
                        $dataK = "SELECT * FROM tb_karyawan WHERE jabatan = 'Pencucian' AND id_karyawan='$idK'";
                        $result = mysqli_query($koneksi, $dataK);
                        while ($k = mysqli_fetch_assoc($result)) {
                          $kar = $k['id_karyawan'];
                        ?>
                        <div class="card" style="text-align: center;">
                            <img src="../admin/karyawan/<?php echo $k['foto_kar']; ?>" class="card-img-top" alt="Foto Karyawan" title="<?php echo $k['nama_karyawan']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $k['nama_karyawan']; ?></h5>
                                <p class="card-text">Alamat: <?php echo $k['alamat_karyawan']; ?></p>
                                <p class="card-text">Nomor HP: <?php echo $k['nomor_hp']; ?></p>
                                <p class="card-text">Jabatan: <?php echo $k['jabatan']; ?></p>
                                <div>
                                  <?php
                                    $query1 = "SELECT * FROM rating WHERE kar_pencuci='$kar'";
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
                                    echo "<div class='rating mb-0'>";
                                    for ($i = 1; $i <= 5; $i++) {
                                      if ($i <= $rata_rating) {
                                        echo "<span class='typcn typcn-star' style='font-size: 30px; color: gold;'></span>";
                                      } else {
                                        echo "<span class='typcn typcn-star-outline' style='font-size: 30px; color: gray;'></span>";
                                      }
                                    }
                                    echo "</div>";
                                    echo "<p style='font-size: 11px;'>Penilaian: ".number_format($rata_rating, 1)."</p>";
                                  ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Data Pelanggan</h5>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <input type="text" class="form-control" value="<?php echo $p['nama_pelanggan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Alamat Pelanggan</label>
                      <textarea type="text" class="form-control" readonly><?php echo $p['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Nomor Hp/Wa Pelanggan</label>
                      <input type="number" class="form-control" value="<?php echo $p['nomor_hp']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Email Pelanggan</label>
                      <input type="email" class="form-control" value="<?php echo $p['email']; ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pilih Jenis Laundry</h5>
                  <p class="card-description">
                  </p>
                    <form id="itemForm" method="POST" action="proses_order.php">
                      <input type="hidden" name="idK" value="<?php echo $idK; ?>">
                      <div class="form-group">
                          <label for="itemSelect">Pilih Jenis Pencucian :</label>
                          <select class="form-control" id="item_select" name="item_id">
                              <option selected disabled>Pilih Jenis Pencucian</option>
                              <?php
                              // Query untuk mendapatkan data item
                              $query = "SELECT id_item, nama_item, harga_peritem FROM tb_item";
                              $result = mysqli_query($koneksi, $query);

                              // Tampilkan opsi item dalam select
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . $row['id_item'] . "'>" . $row['nama_item'] . "</option>";
                              }
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="harga">Harga:</label>
                          <input type="text" class="form-control" id="hargaI" readonly>
                          <input type="hidden" id="harga" name="harga">
                      </div>
                      <div class="form-group">
                          <label for="jumlah">Jumlah:</label>
                          <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Laundry">
                      </div>
                      <div class="form-group">
                        <label for="berat">Berat:</label>
                        <input type="number" class="form-control" id="berat" name="berat" min="0" step="1" required placeholder="Berat Laundry">
                      </div>
                      <div class="form-group">
                        <label>Pilih Estimasi</label>
                        <select class="form-control" id="estimasi" name="estimasi">
                          <option selected disabled>Pilih Estimasi</option>
                          <?php 
                          $e = mysqli_query($koneksi, "SELECT * FROM tb_estimasi");
                          while ($re = mysqli_fetch_assoc($e)){
                          ?>
                          <option value="<?php echo $re['id_estimasi']; ?>"><?php echo $re['nama_estimasi']; ?> - <?php echo "Rp. " .number_format($re['harga_perkilo']). ",-"; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="totalHarga">Total Harga:</label>
                          <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
                      </div>
                      <div class="form-group">
                        <label for="bukti">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="bukti" id="file_upload" accept="../admin/bukti/*">
                      </div>
                      <div id="diskonMessage"></div><br>  
                      <input type="hidden" id="total" name="total">
                      <input type="hidden" id="total1" name="total1">
                      <button type="submit" class="btn btn-primary">Pilih</button>
                  </form>
                  <br>
                  <div class="table-responsive">
                    <?php 
                    if(isset($_SESSION['keranjang'])){

                    $jumlah_isi_keranjang = count($_SESSION['keranjang']);

                    if($jumlah_isi_keranjang != 0){

                    ?>
                    <hr>
                  <form method="POST" action="proses_pesan.php">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Nama Laundry</th>
                              <th>Harga Per Laundry</th>
                              <th>Jumlah</th>
                              <th>Berat</th>
                              <th>Total Harga</th>
                              <th>Estimasi</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $jumlah_total = 0;
                        $total = 0;
                        for($a = 0; $a < $jumlah_isi_keranjang; $a++){
                            $item_id = $_SESSION['keranjang'][$a]['item'];
                            $jml = $_SESSION['keranjang'][$a]['jumlah'];
                            $berat = $_SESSION['keranjang'][$a]['berat'];
                            $estimasi = $_SESSION['keranjang'][$a]['estimasi'];

                            $item_data = "SELECT * FROM tb_item WHERE id_item='$item_id'";
                            $result = mysqli_query($koneksi, $item_data);
                            $i = mysqli_fetch_assoc($result);
                            $harga = $i['harga_peritem'];

                            $b = mysqli_query($koneksi, "SELECT * FROM tb_diskon WHERE berat = $berat");
                            $rb = mysqli_fetch_assoc($b);
                            $harga_d = $rb['harga_diskon'] ?? null;

                            $e = mysqli_query($koneksi, "SELECT * FROM tb_estimasi WHERE id_estimasi = '$estimasi'");
                            $re = mysqli_fetch_assoc($e);
                            $harga_e = $re['harga_perkilo'] ?? null;

                            $hasil = $berat * $harga_e;

                            $total = $harga*$jml - $harga_d + $hasil;
                            $jumlah_total += $total;
                        ?>
                        <tr>
                          <!--<td>
                            <img src="../admin/item/<?php echo $i['foto_item']; ?>" width="50px" height="50px" alt="foto item" title="<?php echo $i['nama_item']; ?>">
                          </td>-->
                          <td><?php echo $i['nama_item']; ?></td>
                          <td><?php echo "Rp. " .number_format($i['harga_peritem']). ",-"; ?></td>
                          <td><?php echo $jml; ?></td>
                          <td><?php echo $berat; ?> Kg</td>
                          <td><?php echo "Rp. " .number_format($harga_e). ",-" ?></td>
                          <td><?php echo "Rp. " .number_format($total). ",-"; ?></td>
                          <td>
                              <a class="btn btn-sm btn-danger" href="hapus_item.php?id=<?php echo $i['id_item']; ?>&idK=<?php echo $idK; ?>" onclick="hapusData()"><i class="typcn typcn-trash"></i> </a>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tr>
                        <th colspan="3">Total Keseluruhan :</th>
                        <td><b><?php echo "Rp. " .number_format($jumlah_total). ",-"; ?></b></td>
                      </tr>
                  </table>
                  <hr>
                  <button class="btn btn-sm btn-warning" type="submit">Order Laundry</button>
                  <input type="hidden" name="idk" value="<?php echo $idK; ?>">
                  <input type="hidden" name="total_semua" value="<?php echo $jumlah_total; ?>">
                  </form>
                  <?php } } ?>
                  </div>
                </div>
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
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y"); ?>. All rights reserved.</span>
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
   <script>
    function number_format(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(document).ready(function () {
        $("#item_select").change(function () {
            var item_id = $(this).val();
            $.ajax({
                url: 'get_item_data.php',
                type: 'POST',
                data: { item_id: item_id },
                dataType: 'json',
                success: function (data) {
                    $("#hargaI").val("Rp. " + number_format(data.harga) + " ,-");
                    $("#harga").val(data.harga);
                    hitungTotalHarga();
                }
            });
        });

        $("#jumlah").keyup(function () {
            hitungTotalHarga();
        });

        $("#berat").keyup(function () {
            hitungTotalHarga();
        });

        function hitungTotalHarga() {
            var harga = parseFloat($("#harga").val());
            var jumlah = parseFloat($("#jumlah").val());
            var berat = parseFloat($("#berat").val());

            if (!isNaN(harga) && !isNaN(jumlah) && !isNaN(berat)) {
                var total = harga * jumlah;

                // Cek apakah berat sama dengan 10 kilo
                if (berat === 10) {
                    // Lakukan pengambilan data diskon dari database
                    $.ajax({
                        url: 'get_diskon.php',
                        type: 'POST',
                        data: { berat: berat },
                        dataType: 'json',
                        success: function (diskonData) {
                            var diskon = diskonData.harga_diskon;
                            total -= diskon; // Kurangkan diskon dari total harga
                            $("#diskon").val(diskon);
                            $("#total_harga").val("Rp. " + number_format(total) + " ,-");
                            $("#total").val(total);
                            $("#total1").val(total);
                        }
                    });
                } else {
                    $("#diskon").val(0); // Reset diskon jika berat bukan 10 kilo
                    $("#total_harga").val("Rp. " + number_format(total) + " ,-");
                    $("#total").val(total);
                    $("#total1").val(total);
                }
            }
        }
    });
  </script>

    <script>
      function hapusData() {
        // Logika penghapusan data akan diimplementasikan di sini
        alert("Yakin Ingin Menghapus Laundry Ini ?");
      }
    </script>

    <script>
      function number_format(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
      document.getElementById("orderButton").addEventListener("click", function() {
          // Gantilah data berikut dengan data pelanggan yang sesuai
          var namaPelanggan = "<?php echo $p['nama_pelanggan']; ?>";
          var alamat = "<?php echo $p['alamat']; ?>";
          var nomorHP = "<?php echo $p['nomor_hp']; ?>";
          var email = "<?php echo $p['email']; ?>";
          var total = "Rp. <?php echo number_format($jumlah_total); ?>"

          // Gantilah dengan nomor WhatsApp Anda atau nomor yang akan digunakan
          var nomorWhatsApp = "<?php echo $p['nomor_hp']; ?>";

          // Pesan yang akan dikirim ke pelanggan
          var pesan = "Halo " + namaPelanggan + ",\nAlamat: " + alamat + "\nNomor HP: " + nomorHP + "\nEmail: " + email + "\nLaundry Anda Dengan Total "+ total +" sedang diproses.";

          // Encode pesan untuk URL
          var encodedPesan = encodeURIComponent(pesan);

          // Buat URL untuk membuka WhatsApp dengan pesan yang sudah ditulis
          var whatsappURL = "https://api.whatsapp.com/send?phone=" + nomorWhatsApp + "&text=" + encodedPesan;

          // Buka WhatsApp dalam tab atau jendela baru
          window.open(whatsappURL);

      });
      </script>

      <script>
      function number_format(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
      $(document).ready(function() {
          $('#berat').on('input', function() {
              var berat = $(this).val();
              if (berat == 10) {
                  $.ajax({
                      url: 'get_discount.php', // File PHP untuk mengambil data diskon
                      method: 'POST',
                      data: {berat: berat},
                      success: function(response) {
                          $('#diskonMessage').text('Selamat, Anda mendapatkan potongan harga sebesar Rp. ' + number_format(response) + ',-');
                      }
                  });
              } else {
                  $('#diskonMessage').text('');
              }
          });
      });
      </script>

      <script>
      $(document).ready(function () {
        $("#berat, #estimasi").change(function () {
          hitungTotalHargaEstimasi();
        });

        function hitungTotalHargaEstimasi() {
          var berat = parseFloat($("#berat").val());
          var estimasi_id = $("#estimasi").val();
          var total = parseFloat($("#total").val());

          if (!isNaN(berat) && estimasi_id !== null) {
            $.ajax({
              url: 'get_estimasi_data.php',
              type: 'POST',
              data: { estimasi_id: estimasi_id },
              dataType: 'json',
              success: function (data) {
                var harga_per_kilo = parseFloat(data.harga_perkilo);
                var total_harga = berat * harga_per_kilo;
                var hasil = total + total_harga;
                $("#total_harga").val("Rp. " + number_format(hasil) + " ,-");
                $("#total1").val(hasil);
              }
            });
          }
        }
      });
    </script>

</body>

</html>
