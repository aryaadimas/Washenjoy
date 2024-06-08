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
//data pelanggan
$dataP = "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$idP'";
$result = mysqli_query($koneksi, $dataP);
$p = mysqli_fetch_assoc($result);

//data order
$data = "SELECT * FROM tb_order";
$sql = mysqli_query($koneksi, $data);
$dO = mysqli_fetch_assoc($sql);
$statusO = $dO['status_order'];

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
  <title>Laundry - Transaksi Oderan Pelanggan</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

  <style>
    .nav-link {
        padding: 5px 10px; /* Menambahkan padding atas/bawah dan kiri/kanan */
    }
    .nav-item {
        margin-right: 10px; /* Menambahkan margin kanan */
    }
    .garis-tebal {
        border-top: 4px solid #000000; /* Ubah warna dan ketebalan sesuai kebutuhan Anda */
    }

    .nav-tabs {
        display: flex;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Untuk dukungan gesekan pengguliran pada iOS */
    }

    /* Media query untuk perangkat seluler */
    @media (max-width: 768px) {
      .nav-tabs {
        flex-wrap: nowrap;
        overflow-x: scroll;
      }
    }

    /* Kustomisasi CSS tambahan */
    .customer-card {
        margin-bottom: 20px;
    }

    .customer-card img {
        max-width: 100%;
        height: auto;
    }
    .card-img-top {
       max-width: 94%;
        height: 160px;
        margin: 0 auto;
        margin-top: 10px;
    }

    .star {
      cursor: pointer;
      font-size: 24px;
      color: gray;
    }

    .star.active {
      color: gold;
    }

    .star1 {
      cursor: pointer;
      font-size: 24px;
      color: gray;
    }

    .star1.active {
      color: gold;
    }

    .star2 {
      cursor: pointer;
      font-size: 24px;
      color: gray;
    }

    .star2.active {
      color: gold;
    }
    .star3 {
      cursor: pointer;
      font-size: 24px;
      color: gray;
    }

    .star3.active {
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
                  <h4 class="card-title">Data Diri <?php echo $p['nama_pelanggan']; ?></h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <div class="col-md-12">
                        <div class="card customer-card">
                            <img src="pelanggan1/<?php echo $p['foto']; ?>" class="card-img-top" alt="Foto Pelanggan">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $p['nama_pelanggan']; ?></h5>
                                <p class="card-text">Alamat: <?php echo $p['alamat']; ?></p>
                                <p class="card-text">Nomor HP: <?php echo $p['nomor_hp']; ?></p>
                                <p class="card-text">Nomor HP: <?php echo $p['email']; ?></p>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--<div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Hoverable Table</h4>
                  <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Product</th>
                          <th>Sale</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>Photoshop</td>
                          <td class="text-danger"> 28.76% <i class="typcn typcn-arrow-down-thick"></i></td>
                          <td><label class="badge badge-danger">Pending</label></td>
                        </tr>
                        <tr>
                          <td>Messsy</td>
                          <td>Flash</td>
                          <td class="text-danger"> 21.06% <i class="typcn typcn-arrow-down-thick"></i></td>
                          <td><label class="badge badge-warning">In progress</label></td>
                        </tr>
                        <tr>
                          <td>John</td>
                          <td>Premier</td>
                          <td class="text-danger"> 35.00% <i class="typcn typcn-arrow-down-thick"></i></td>
                          <td><label class="badge badge-info">Fixed</label></td>
                        </tr>
                        <tr>
                          <td>Peter</td>
                          <td>After effects</td>
                          <td class="text-success"> 82.00% <i class="typcn typcn-arrow-up-thick"></i></td>
                          <td><label class="badge badge-success">Completed</label></td>
                        </tr>
                        <tr>
                          <td>Dave</td>
                          <td>53275535</td>
                          <td class="text-success"> 98.05% <i class="typcn typcn-arrow-up-thick"></i></td>
                          <td><label class="badge badge-warning">In progress</label></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>-->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Oderan Laundry</h4>
                  <p class="card-description">
                    Transaksi Oderan Laundry
                  </p>
                    <ul class="nav nav-tabs" id="myTabs">
                        <li class="nav-item">
                            <a class="nav-link active btn btn-sm btn-primary" data-toggle="tab" href="#proses">Proses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-danger" data-toggle="tab" href="#dijemput">Dijemput</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-warning" data-toggle="tab" href="#antrian">Antrian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-success" data-toggle="tab" href="#selesai">Selesai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-info" data-toggle="tab" href="#antar">Diantar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-success" data-toggle="tab" href="#terima">Diterima</a>
                        </li>
                    </ul>

                    <br>
                    <div class="table-responsive">
                    <div class="tab-content">
                        <div class="tab-pane active" id="proses">
                            <!-- Isi tab Proses diisi dengan data dari database -->
                            <table class="table table-striped">
                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_order='1' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 1) { ?>
                                        <span class="badge badge-primary">Proses</span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                        </div>
                        <!-- Tab lainnya (Dijemput, Antrian, Selesai) memiliki struktur yang sama -->
                        <div class="tab-pane" id="dijemput">
                            <table class="table table-striped">
                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order, tb_karyawan WHERE pel_id='$idP' AND status_order='2' AND id_karyawan=kurir_jemput ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 2) { ?>
                                        <span class="badge badge-danger">Dijemput</span><br>
                                        <span style="font-size: 10px;">Dijemput Oleh : <?php echo $odr['nama_karyawan']; ?></span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>

                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_order='3' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 3) { ?>
                                        <span class="badge badge-dark">Load Laundry...</span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="antrian">
                            <table class="table table-striped">
                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_order='4' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 4) { ?>
                                        <span class="badge badge-warning">Antrian</span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>

                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_order='5' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 5) { ?>
                                        <span class="badge badge-warning">Proses Laundry/Pencucian...</span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="selesai">
                            <table class="table table-striped">
                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_order='6' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 6) { ?>
                                        <span class="badge badge-success">Selesai</span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="antar">
                            <table class="table table-striped">
                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order, tb_karyawan WHERE pel_id='$idP' AND id_karyawan=kurir_antar AND status_order='7' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 7) { ?>
                                        <span class="badge badge-info">Diantar</span><br>
                                        <span style="font-size: 10px;">Diantar Oleh : <?php echo $odr['nama_karyawan']; ?></span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>

                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order, tb_karyawan WHERE pel_id='$idP' AND id_karyawan=kurir_antar AND status_order='8' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 8) { ?>
                                        <span class="badge badge-dark">Selesai Diantar</span><br>
                                        <span style="font-size: 10px;">Diantar Oleh : <?php echo $odr['nama_karyawan']; ?></span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                  <td>
                                    <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#konfirModal<?php echo $odr['id_order']; ?>"> Konfirmasi Laundry</a>
                                  </td>
                                </tr>

                                <!-- Modal -->
                      <div class="modal" id="konfirModal<?php echo $odr['id_order']; ?>">
                          <div class="modal-dialog">
                              <div class="modal-content">
                              
                                  <!-- Bagian Header Modal -->
                                  <div class="modal-header">
                                      <h4 class="modal-title">Konfirmasi Laundry</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  
                                  <!-- Bagian Body Modal -->
                                  <div class="modal-body">
                                      <!-- Isi Form -->
                                      <form method="POST" action="Proses_konfir.php" enctype="multipart/form-data">
                                        <input type="hidden" name="idO" value="<?php echo $odr['id_order']; ?>">
                                        <input type="hidden" name="karP" value="<?php echo $odr['kar_id']; ?>">
                                        <input type="hidden" name="karJ" value="<?php echo $odr['kurir_jemput']; ?>">
                                        <input type="hidden" name="karA" value="<?php echo $odr['kurir_antar']; ?>">
                                        <div class="mb-3">
                                          <label for="storeRating">Laundry Rating:</label>
                                          <div class="rating">
                                            <span class="star" data-value="1">&#9733;</span>
                                            <span class="star" data-value="2">&#9733;</span>
                                            <span class="star" data-value="3">&#9733;</span>
                                            <span class="star" data-value="4">&#9733;</span>
                                            <span class="star" data-value="5">&#9733;</span>
                                          </div>
                                          <p>Penilaian: <span id="selected-rating">0</span></p>
                                          <input type="hidden" id="selected-ratingT" name="ratinglaundry">
                                        </div>
                                        <div class="mb-3">
                                          <label for="pencucianRating">Pencucian Rating:</label>
                                          <div class="rating">
                                            <span class="star1" data-value="1">&#9733;</span>
                                            <span class="star1" data-value="2">&#9733;</span>
                                            <span class="star1" data-value="3">&#9733;</span>
                                            <span class="star1" data-value="4">&#9733;</span>
                                            <span class="star1" data-value="5">&#9733;</span>
                                          </div>
                                          <p>Penilaian: <span id="selected-rating1">0</span></p>
                                          <input type="hidden" id="selected-ratingP" name="ratingpencucian">
                                        </div>
                                        <div class="mb-3">
                                          <label for="jemputRating">Kurir Jemput Rating:</label>
                                          <div class="rating">
                                            <span class="star2" data-value="1">&#9733;</span>
                                            <span class="star2" data-value="2">&#9733;</span>
                                            <span class="star2" data-value="3">&#9733;</span>
                                            <span class="star2" data-value="4">&#9733;</span>
                                            <span class="star2" data-value="5">&#9733;</span>
                                          </div>
                                          <p>Penilaian: <span id="selected-rating2">0</span></p>
                                          <input type="hidden" id="selected-ratingJ" name="ratingkurirJ">
                                        </div>
                                        <div class="mb-3">
                                          <label for="antarRating">Kurir Antar Rating:</label>
                                          <div class="rating">
                                            <span class="star3" data-value="1">&#9733;</span>
                                            <span class="star3" data-value="2">&#9733;</span>
                                            <span class="star3" data-value="3">&#9733;</span>
                                            <span class="star3" data-value="4">&#9733;</span>
                                            <span class="star3" data-value="5">&#9733;</span>
                                          </div>
                                          <p>Penilaian: <span id="selected-rating3">0</span></p>
                                          <input type="hidden" id="selected-ratingA" name="ratingkurirA">
                                        </div>
                                        <div class="mb-3">
                                          <label for="description">Description:</label>
                                          <textarea class="form-control" id="description" name="ket" rows="3" placeholder="Masukkan Keterangan Anda Tentang Laundry.."></textarea>
                                        </div>
                                        <div class="mb-3">
                                          <label for="productImage">Laundry Image:</label>
                                          <input type="file" name="foto" class="form-control" id="productImage">
                                        </div>
                                        <!-- Bagian Footer Modal -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Konfirmasi</button>
                                        </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                                <?php } ?>
                              </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="terima">
                            <table class="table table-striped">
                              <tbody>
                                <?php
                                $dataO = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_order='9' ORDER BY id_order DESC";
                                $result = mysqli_query($koneksi, $dataO);
                                while($odr = mysqli_fetch_assoc($result)){
                                  $idO = $odr['id_order'];
                                  $hargaT = $odr['total_harga'];
                                  $status = $odr['status_order'];
                                ?>
                                <tr>
                                  <td>
                                    <span>KodeOder:</span><br>
                                    <span style="color: blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></span>
                                  </td>
                                  <td class="py-1">
                                    <?php
                                    $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                                    $resultI = mysqli_query($koneksi, $dataI);
                                    while($i = mysqli_fetch_assoc($resultI)){
                                      $namaI = $i['nama_item'];
                                    ?>
                                    <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" alt="image"/><br>-->
                                    <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                                    <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                                    <br><br>
                                    <?php } ?>
                                  </td>
                                  <td>
                                    <?php echo $p['nama_pelanggan']; ?>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Total:</strong><br> <?php echo "Rp. " .number_format($hargaT). ",-"; ?></span>
                                  </td>
                                  <td>
                                    <span style="text-align: center;"><strong>Status:</strong><br> 
                                      <?php if ($status == 9) { ?>
                                        <span class="badge badge-success">Diterima</span>
                                      <?php } ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>

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
    const stars = document.querySelectorAll('.star');
    const stars1 = document.querySelectorAll('.star1');
    const stars2 = document.querySelectorAll('.star2');
    const stars3 = document.querySelectorAll('.star3');
    const selectedRating = document.getElementById('selected-rating');
    const selectedRatingT = document.getElementById('selected-ratingT');
    const selectedRating1 = document.getElementById('selected-rating1');
    const selectedRatingP = document.getElementById('selected-ratingP');
    const selectedRating2 = document.getElementById('selected-rating2');
    const selectedRatingJ = document.getElementById('selected-ratingJ');
    const selectedRating3 = document.getElementById('selected-rating3');
    const selectedRatingA = document.getElementById('selected-ratingA');

    stars.forEach(star => {
      star.addEventListener('click', () => {
        const value = parseInt(star.getAttribute('data-value'));
                
        stars.forEach(s => {
          if (parseInt(s.getAttribute('data-value')) <= value) {
            s.classList.add('active');
          } else {
            s.classList.remove('active');
          }
        });

        selectedRating.textContent = value;
        selectedRatingT.value = value;
        });
      });

    stars1.forEach(star1 => {
      star1.addEventListener('click', () => {
        const value = parseInt(star1.getAttribute('data-value'));
                
        stars1.forEach(s => {
          if (parseInt(s.getAttribute('data-value')) <= value) {
            s.classList.add('active');
          } else {
            s.classList.remove('active');
          }
        });

        selectedRating1.textContent = value;
        selectedRatingP.value = value;
        });
      });

    stars2.forEach(star2 => {
      star2.addEventListener('click', () => {
        const value = parseInt(star2.getAttribute('data-value'));
                
        stars2.forEach(s => {
          if (parseInt(s.getAttribute('data-value')) <= value) {
            s.classList.add('active');
          } else {
            s.classList.remove('active');
          }
        });

        selectedRating2.textContent = value;
        selectedRatingJ.value = value;
        });
      });

    stars3.forEach(star3 => {
      star3.addEventListener('click', () => {
        const value = parseInt(star3.getAttribute('data-value'));
                
        stars3.forEach(s => {
          if (parseInt(s.getAttribute('data-value')) <= value) {
            s.classList.add('active');
          } else {
            s.classList.remove('active');
          }
        });

        selectedRating3.textContent = value;
        selectedRatingA.value = value;
        });
      });
  </script>
</body>

</html>
