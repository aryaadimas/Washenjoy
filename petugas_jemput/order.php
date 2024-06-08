<?php 
session_start();
include 'koneksi.php';
// Periksa apakah session username telah diatur
if (!isset($_SESSION['karyawan_type'])) {
    echo '<script language="javascript" type="text/javascript">
    alert("Anda Belum Terdaftar, Silakan Anda Daftar Sebagai Petugas Jemput!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
    exit;
}

$idk = $_SESSION['karyawan'];
$data = "SELECT * FROM tb_karyawan WHERE jabatan='Petugas Jemput' AND id_karyawan='$idk'";
$result = mysqli_query($koneksi, $data);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../admin/img/logo/logo.png" rel="icon">
  <title>Laundry - Data order Pelanggan</title>
  <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../admin/css/ruang-admin.min.css" rel="stylesheet">
  <link href="../admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="../admin/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">RuangPetugas</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Laundry
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="karyawan.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Karyawan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="order.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Order</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-warning badge-counter">2</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                      having.</div>
                    <div class="small text-gray-500">Udin Cilok · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
                    <div class="status-indicator bg-default"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                      say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Jaenab · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks fa-fw"></i>
                <span class="badge badge-success badge-counter">3</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Task
                </h6>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Design Button
                      <div class="small float-right"><b>50%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Make Beautiful Transitions
                      <div class="small float-right"><b>30%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Create Pie Chart
                      <div class="small float-right"><b>75%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="../admin/karyawan/<?php echo $row['foto_kar']; ?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['nama_kar']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Oderan</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./indek.php">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Data Oderan</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Data Oderan -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Oderan</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>Kode Oder</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Laundry Oder</th>
                        <th>Total Bayar</th>
                        <th>Status Oder</th>
                        <th>Update Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1; 
                        $dataO = "SELECT * FROM tb_order, tb_pelanggan WHERE id_pelanggan=pel_id ORDER BY id_order DESC";
                        $result = mysqli_query($koneksi, $dataO);
                        while($odr = mysqli_fetch_assoc($result)){
                          $idO = $odr['id_order'];
                          $hargaT = $odr['total_harga'];
                          $status = $odr['status_order'];
                          $kurir = $odr['kurir_jemput'];

                          if (empty($kurir)) {
                              // Jika kurir kosong, maka tombol "Ubah Status Order" aktif
                              $buttonClass = "btn btn-sm btn-primary";
                              $buttonDisabled = "";
                          } else {
                              // Jika kurir terisi, maka tombol "Ubah Status Order" dinonaktifkan
                              $buttonClass = "btn btn-sm btn-primary disabled";
                              $buttonDisabled = "disabled";
                          }
                      ?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td style="color:blue;"><u>#KO<?php echo $odr['kodeorder']; ?></u></td>
                        <td><?php echo $odr['tanggal_order']; ?></td>
                        <td><?php echo $odr['nama_pelanggan']; ?></td>
                        <td>
                          <?php
                          $dataI = "SELECT * FROM tb_detail_order, tb_item WHERE id_item=item_id AND order_id='$idO'";
                          $resultI = mysqli_query($koneksi, $dataI);
                          while($i = mysqli_fetch_assoc($resultI)){
                            $namaI = $i['nama_item'];
                          ?>
                          <!--<img src="../admin/item/<?php echo $i['foto_item']; ?>" width="30px" height="30px" alt="image"/><br>-->
                          <span style="text-align: center; font-size: 10px"><?php echo $namaI; ?> X<?php echo $i['jumlah_item']; ?> </span><br>
                          <span style="text-align: center; font-size: 10px"><?php echo "Rp. " .number_format($i['total_harga_peritem']). ",-"; ?></span>
                          <br><br>
                          <?php } ?>
                        </td>
                        <td>
                          <span style="text-align: center;"><strong><?php echo "Rp. " .number_format($hargaT). ",-"; ?></strong></span>
                        </td>
                        <td>
                          <span style="text-align: center;"> 
                            <?php if ($status == 1) { ?>
                              <span class="badge badge-primary">Proses</span>
                            <?php }elseif ($status == 2) { ?>
                              <span class="badge badge-danger">Dijemput</span>
                            <?php }elseif ($status == 3) { ?>
                              <span class="badge badge-dark">Load Laundry</span>
                            <?php }elseif ($status == 4) { ?>
                              <span class="badge badge-warning">Antrian</span>
                            <?php }elseif ($status == 5) { ?>
                              <span class="badge badge-warning">Proses Laundry</span>
                            <?php }elseif ($status == 6) { ?>
                              <span class="badge badge-success">Selesai</span>
                            <?php }elseif ($status == 7) { ?>
                              <span class="badge badge-info">Diantar</span>
                            <?php }elseif ($status == 8) { ?>
                              <span class="badge badge-dark">Laundry Selesai Diantar</span>
                            <?php }elseif ($status == 9) { ?>
                              <span class="badge badge-success">Laundry Diterima</span>
                            <?php } ?>
                          </span><br>
                          <?php 
                          $dataK = "SELECT * FROM tb_karyawan WHERE jabatan='Petugas Jemput' AND id_karyawan='$kurir'";
                          $resultK = mysqli_query($koneksi, $dataK);
                          while($rowK = mysqli_fetch_assoc($resultK)){
                          ?>
                          <small style="font-size: 13px;" >Yang Menjemput: <span class="badge badge-dark"><?php echo $rowK['nama_karyawan']; ?></span></small>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ($status == 1) { ?>
                          <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#myModal<?php echo $odr['id_order']; ?>"> Ubah Status Order</a>
                          <?php }elseif ($status == 2) { ?>
                          <a class="<?= $buttonClass ?>" href="" data-toggle="modal" data-target="#myModal<?php echo $odr['id_order']; ?>" <?= $buttonDisabled ?>> Ubah Status Order</a>
                          <?php } ?>

                          <!-- Modal -->
                          <div class="modal fade" id="myModal<?php echo $odr['id_order']; ?>">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                          <h4 class="modal-title">Ubah Status Order</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>

                                      <!-- Modal Body -->
                                      <div class="modal-body">
                                          <form method="POST" action="proses_status.php">
                                            <input type="hidden" name="ido" value="<?php echo $odr['id_order']; ?>">
                                            <input type="hidden" name="idk" value="<?php echo $idk; ?>">
                                              <div class="form-group">
                                                  <label for="nama">Status Order:</label>
                            <select class="form-control" name="status">
                              <option selected disabled>Pilih Update status Order</option>
                              <option <?php if($status == "2"){echo "selected='selected'";} ?> value="2">Dijemput</option>
                            </select>
                                              </div>
                                              <!-- Modal Footer -->
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="keluar.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../admin/vendor/jquery/jquery.min.js"></script>
  <script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../admin/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="../admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>