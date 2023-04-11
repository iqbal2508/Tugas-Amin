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
    <title>GoPrinter</title>

    <!-- Root CSS -->
    <link rel="stylesheet" href="css/rot.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="css/awal.css">
    

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span class="iconify icon-brand" data-icon="fluent-emoji:laptop"></span>
            <h4 class="text-brand">LaptopKuyZZ</h4>
            
            
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="order/" class="nav-link"><span class="iconify" data-icon="icon-park-solid:shopping-bag"></span></a>
                <span class="badge">
                    <?php 
                    
                    if (isset($_SESSION['username'])) {

                        $id = $_SESSION['id_user'];

                        include 'database/koneksi.php';

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
                <a href="cart/" class="nav-link"><span class="iconify" data-icon="el:shopping-cart-sign"></span></a>
                <span class="badge"><?= count($_SESSION['cart']); ?></span>
            </li>
            <?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] == 'admin') {
        echo '
            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span>'. $_SESSION['username'] .'</a>
                <div class="dropdown-content">
                    <a href="admin/dashboard.php">Dashboard</a>
                    <a href="logout.php" class="notif-logout">Logout</a>
                </div>
            </li>
        ';
    } else {
        echo '
            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span></a>
                <div class="dropdown-content">
                    <a href="logout.php" class="notif-logout">Logout</a>
                </div>
                <a href="javascript:void(0)" class="dropbtn">'. $_SESSION['username'] .'</a>
            </li>
        ';
    }
} else {
    echo '
        <li class="nav-item">
            <a href="login/" class="nav-link" ><span class="iconify" data-icon="mdi:login-variant"></span></a>
        </li>
    ';
}
?>
         
        </ul>
    </nav>
    <!-- End Navbar -->
    <?php
include 'database/koneksi.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$query = "SELECT * FROM laptop_tb WHERE idPrinter = '$id'";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) 
  $data = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $data['NamaLaptop']; ?> - Detail Product</title>
  <style>
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f7f7f7;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
      font-family: sans-serif;
    }
    h1 {
      font-size: 36px;
      margin-bottom: 10px;
    }
    img {
      max-width: 100%;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      line-height: 1.5;
      margin-bottom: 10px;
    }
    .btn-add-to-cart {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .btn-add-to-cart:hover {
      background-color: #0062cc;
    }
    .icon-to-cart {
      margin-left: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php if ($data): ?>
      <h1><?php echo $data['NamaLaptop']; ?></h1>
      <img src="img-product/<?php echo $data['GambarPrinter']; ?>" alt="">
      <p>Deskripsi: <?php echo $data['SpesifikasiPrinter']; ?></p>
      <p>Price: <?php echo 'Rp.' . number_format($data['HargaLaptop']); ?></p>
      <p>Stock: <?php echo $data['stok']; ?></p>
      <a href="cart/index.php?id=<?php echo $data['idPrinter']; ?>&action=add" class="btn-add-to-cart">PESAN <span class="iconify icon-to-cart" data-icon="el:shopping-cart-sign"></span></a>
      <a class="btn-add-to-cart" href="index.php" class="btn">BACK</a>
    <?php else: ?>
      <p>Product not found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
<script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
