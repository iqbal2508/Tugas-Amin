<?php 
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/rot.css">
    <link rel="stylesheet" href="../css/pesan.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span class="iconify icon-brand" data-icon="fluent-emoji:laptop"></span>
            <h4 class="text-brand">LaptopYahuy</h4>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="index.php" class="nav-link active"><span class="iconify"
                        data-icon="iconoir:shopping-bag-check"></span></a>
                <span class="badge">
                    <?php 

                    if (isset($_SESSION['username'])) {

                        $id = $_SESSION['id_user'];

                        include '../database/koneksi.php';

                        $sql = "SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status ,  transaksi.UserIdUser2, user.Username, laptop_tb.NamaLaptop, laptop_tb.HargaLaptop FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN laptop_tb ON transaksi.Laptop_tblIdPrinter = laptop_tb.idPrinter WHERE UserIdUser2 = '$id'";
                        $excute = mysqli_query($koneksi, $sql);
                        $result = mysqli_num_rows($excute);

                        echo $result;

                    } else {

                        echo 0;

                    }
                    
                    ?>
                </span>
            </li>
            <li class="nav-item">
                <a href="../cart/" class="nav-link"><span class="iconify"
                        data-icon="clarity:shopping-cart-line"></span></a>
                <span class="badge"><?= count($_SESSION['cart']); ?></span>
            </li>
            <?php

            if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == 'admin') {
                    // Halaman Admin
                    echo '
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span>'. $_SESSION['username'] .'</a>
                            <div class="dropdown-content">
                                <a href="admin/dashboard.php">Dashboard</a>
                            </div>
                        </li>
                    ';
                } else {
                    echo '
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span>'. $_SESSION['username'] .'</a>
                            <div class="dropdown-content">
                                <a href="../logout.php">Logout</a>
                            </div>
                        </li>
                    ';
                }
            } else {
                echo '
                        <li class="nav-item">
                            <a href="../login/" class="nav-link"><span class="iconify" data-icon="mdi:login-variant"></span></a>
                        </li>
                    ';
            }
            ?>
        </ul>
    </nav>
    <!-- End Navbar -->

    <!-- Section Title -->
    <div class="container">
        <h2 class="section-title">List Transaksi Anda</h2>
    </div>
    <!-- End Section Title -->

    <!-- Content -->
    <div class="row">
        <div class="card mt-5">
            <div class="table-responsive">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>subtotal</th>
                        <th>Status</th>
                    </tr>
                    <?php
include '../database/koneksi.php';

if (isset($_SESSION['id_user'])) {
    $id = $_SESSION['id_user'];
    $query = "SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status ,  transaksi.UserIdUser2, user.Username, laptop_tb.NamaLaptop, laptop_tb.HargaLaptop FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN laptop_tb ON transaksi.Laptop_tblIdPrinter = laptop_tb.idPrinter WHERE UserIdUser2 = '$id'";
    $result = mysqli_query($koneksi, $query);
    $data = array_reverse(mysqli_fetch_all($result, MYSQLI_ASSOC)); // Reverse the order of the data
    for ($i = 0; $i < count($data); $i++) { 
?>
    <tr>
        <td><?= $i + 1 ?></td>
        <td><?= $data[$i]['NamaLaptop'] ?></td>
        <td><?= $data[$i]['Jumlah'] ?></td>
        <td><?= number_format($data[$i]['HargaLaptop']) ?></td>
        <td><?= number_format($data[$i]['subtotal']) ?></td>
        <?php 
            if ($data[$i]['status'] == 1) {
        ?>
                <td><span class="badge-warning">Sedang Menunggu Konfirmasi</span></td>
        <?php 
            } else if ($data[$i]['status'] == 2) {
        ?>
                <td><span class="badge-success">Produk Sedang Dikirim</span></td>
        <?php 
            } else if ($data[$i]['status'] == 3) {
        ?>
                <td><span class="badge-danger">Produk Gagal Dikirim</span></td>
        <?php 
            }
        ?>
    </tr>
<!-- notif admin confrim -->
<script>
    <?php 
        if ($data[$i]['status'] == 1) {
            echo "var status = 'Sedang Menunggu Konfirmasi';";
        } else if ($data[$i]['status'] == 2) {
            echo "var status = 'Produk Sedang Dikirim';";
        } else if ($data[$i]['status'] == 3) {
            echo "var status = 'Produk Gagal Dikirim';";
        }
        ?>
    
    if (status == 'Produk Sedang Dikirim') {
        alert('Produk berhasil dikonfirmasi oleh admin!');
    }
</script>
    <!-- notif admin confrim -->

<?php 
    } 
}
?>


                    </tr>

                    <?php 
                    ?>
                  
                </table>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>

</body>

</html>