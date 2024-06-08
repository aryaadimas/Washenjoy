<?php
//koneksi
include '../koneksi.php';
$idP = $_SESSION['pelanggan'];
//data pelanggan
$dataP = "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$idP'";
$result = mysqli_query($koneksi, $dataP);
$p = mysqli_fetch_assoc($result);

// Query untuk mengambil data pesanan
$sql = "SELECT * FROM tb_order WHERE pel_id='$idP' AND status_notif='belum dilihat' ORDER BY id_order DESC";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id_order'];
        $kodeorder = $row["kodeorder"];
        $orderStatus = $row["status_order"];
        $customerName = $p["nama_pelanggan"];

        // Tampilkan notifikasi sesuai dengan status pesanan
        switch ($orderStatus) {
            case "1":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-primary'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Anda Sedang Diproses<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "2":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-danger'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Anda Sedang Dijemput<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "3":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-dark'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Anda Sedang Load Laundry...!<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "4":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-warning'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Anda Sudah Dalam Antrian<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "5":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-warning'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Sedang Proses Pencucian..<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "6":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-success'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Anda Sudah Selesai<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "7":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-info'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Anda Sedang Diantar<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "8":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-dark'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Silakan Konfirmasi Laundry..<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            case "9":
                $badgeClass = "
                <a class='dropdown-item preview-item' href='detail_notif.php?id=$id&notif=$orderStatus'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-success'>
                        <i class='typcn typcn-info mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                      <h6 class='preview-subject font-weight-normal'>Laundry Sudah Diterima<br><p style='font-size:13px; color:blue;'>Dengan Kode: <u>#KO$kodeorder</u></p></h6>
                      <p class='font-weight-light small-text mb-0 text-muted'>
                        Silakan Lihat Detail
                      </p>
                    </div>
                </a>";
                break;
            default:
                $badgeClass = "badge-light";
        }

        echo "$badgeClass";
    }
} else {
    echo "Tidak ada pesanan.";
}
?>