<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../css/boad.css">
    <link rel="stylesheet" href="../css/side.css">
</head>
<body>
    <div class="sidebar">
        <h4 class="sidebar-brand">Laptop</h4>
        <ul>
        <li class="active">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt-average"></i> &nbsp;Dashboard</a>
            </li>
            <li>
                <a href="../product/index.php"><span class="iconify icon-brand" data-icon="bi:printer-fill"></span> &nbsp;Printers</a>
            </li>
            <li>
                <a href="../transaksi"><i class="fas fa-cart-arrow-down"></i> &nbsp;Transaksi</a>
            </li>
            <li>
                <a href="user.php"><i class="fas fa-cart-arrow-down"></i> &nbsp;User</a>
            </li>
            <li>
                <a href="../logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar ?')"> <i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp;Logout</a>
            </li>
        </ul>
    </div>
    <main>
        <div class="section-title">
            Dashboard
        </div>
        
        
        <div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
            <div class="printer-title">
            Total Printer
        </div>
            </div>
            <div class="card-body">
                <?php 
                include '../database/koneksi.php';
                $query = "SELECT count(*) as total FROM laptop_tb";
                $result = mysqli_query($koneksi, $query);
                $hasil = mysqli_fetch_assoc($result);
                echo $hasil['total'];
                ?>
            </div>
        </div>
        
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Total Transaksi 
            </div>
            <div class="card-body">
                <?php 
                include '../database/koneksi.php';
                $query = "SELECT count(*) as total FROM transaksi";
                $result = mysqli_query($koneksi, $query);
                $hasil = mysqli_fetch_assoc($result);
                echo $hasil['total'];
                ?>
            </div>
        </div>
        
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
            <div class="tolos-title">
               Jumlah Transaksi Yang Berhasil di Konfirmasi
            </div>
            </div>
            <div class="card-body">
                <?php 
                include '../database/koneksi.php';
                $query = "SELECT SUM(subtotal) as subtotal FROM transaksi WHERE status != 3  AND status != 1";
                $result = mysqli_query($koneksi, $query);
                $hasil = mysqli_fetch_assoc($result);
                echo "Rp " . number_format($hasil['subtotal'], 0, ",", ".");
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
            <div class="tolak-title">
            Jumlah Transaksi Yang Gagal di Konfirmasi
               </div>
            </div>
            <div class="card-body">
            <?php 
                include '../database/koneksi.php';
                $query = "SELECT SUM(subtotal) as subtotal FROM transaksi WHERE status != 2  AND status != 1";
                $result = mysqli_query($koneksi, $query);
                $hasil = mysqli_fetch_assoc($result);
                echo "Rp " . number_format($hasil['subtotal'], 0, ",", ".");
                ?>
            </div>
        </div>
    </div>
</div>
        <div class="section-title mt-3">
            Notifikasi Transaksi
        </div>
        <div class="card-notif">
        <table>
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>subtotal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php 
            
            include '../database/koneksi.php';

            $query = "SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status ,  transaksi.UserIdUser2, user.Username, laptop_tb.NamaLaptop, laptop_tb.HargaLaptop FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN laptop_tb ON transaksi.Laptop_tblIdPrinter = laptop_tb.idPrinter"; 
            $result = mysqli_query($koneksi, $query);
            $no = 1;
                while ($data=mysqli_fetch_object($result)) {
                if ($data->status == 1) {
                        # code...
            ?>

            <tr>     
                <td><?= $no++ ?></td>
                <td><?= $data->NamaLaptop ?></td>
                <td><?= $data->Username ?></td>
                <td><?= $data->Jumlah ?></td>
                <td><?= number_format($data->HargaLaptop) ?></td>
                <td><?= number_format($data->subtotal) ?></td>
                <td><span class="badge-warning">Sedang Proses Dikonfirmasi</span></td>
                <td>
                    <a href="dashboard.php?id=<?= $data->idTransaksi ?>" class="btn-info">Konfirmasi</a>
                    <br>
                    <br>
                    <a href="dashboard.php?fail=<?= $data->idTransaksi ?>" class="btn-danger">Gagal Dikonfirmasi</a>
                </td>
            </tr>

            <?php } } ?>
            
        </table>
        
        </div>
        
    </main>
    

    

    <?php 
if (isset($_GET['id'])) {
    
    include '../database/koneksi.php';

    $id = $_GET['id'];
    $status = 2;

    // Ambil data jumlah pada transaksi
    $queryTransaksi = "SELECT * FROM transaksi WHERE idTransaksi = '$id'";
    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
    $dataTransaksi = mysqli_fetch_assoc($resultTransaksi);
    $jumlah = $dataTransaksi['Jumlah'];
    
   // Kurangi stok pada printer_tb dengan jumlah tersebut
   $queryPrinter = "SELECT * FROM laptop_tb WHERE idPrinter = '".$dataTransaksi['Laptop_tblIdPrinter']."'";
   $resultPrinter = mysqli_query($koneksi, $queryPrinter);
   $dataPrinter = mysqli_fetch_assoc($resultPrinter);
   $stokBaru = $dataPrinter['stok'] - $jumlah;
   $queryUpdateStok = "UPDATE laptop_tb SET stok = '$stokBaru' WHERE idPrinter = '".$dataTransaksi['Laptop_tblIdPrinter']."'";
   $resultUpdateStok = mysqli_query($koneksi, $queryUpdateStok);
   
   // Ubah status transaksi
   $queryUpdateStatus = "UPDATE transaksi SET status='$status' WHERE idTransaksi = '$id'";
   $run = mysqli_query($koneksi, $queryUpdateStatus);
    
    if ($run) {
        // Jika stok pada printer_tb habis (0), hapus data printer_tb sesuai idPrinter
        if ($stokBaru == 0) {
            $queryHapusPrinter = "DELETE FROM laptop_tb WHERE idPrinter = '".$dataTransaksi['Laptop_tblIdPrinter']."'";
            $resultHapusPrinter = mysqli_query($koneksi, $queryHapusPrinter);
        }
       
        header("location:dashboard.php");
    }
}
?>

    <?php 
if (isset($_GET['fail'])) {
    
    include '../database/koneksi.php';

    $id = $_GET['fail'];
    $status = 3;

    $query = "UPDATE transaksi SET status='$status' WHERE idTransaksi = '$id'";
    $run = mysqli_query($koneksi, $query);

    if ($run) {
        header("location:dashboard.php");
    }

}
?>


    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b8d1f961b1.js" crossorigin="anonymous"></script>

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</body>
</html>
