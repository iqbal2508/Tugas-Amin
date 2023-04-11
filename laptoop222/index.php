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

    <!-- Banner -->
    <!-- Malachi - Collection Banners -->
<div class="full-width-conatiner">
  <div class="collection-banner-conatiner">
    <div class="sixteen columns collection-banner intestinal-health clearfix">
    <!--Do Not copy top part -->

      <!-- Prebiotic Banner -->
      

          <div class="jarrow-category-banner prebiotic-health-css-banner">
                <div class="jcb-left color-white ">
                  <h1 class="caps-lock sans-serif raleway font-bold size-60">Laptop,Yahuy</h1>
                  <h2 class="sans-serif raleway font-bold size-40 border-top">Rasanya Enak Untuk Digunakan!!!!</h2>
                  <p class="sans-serif raleway font-normal border-top"> Laptop berasal dari kata lap yang berarti pangkuan serta top yang berarti atas.</p>
               
                </div>
                <div id="badge">GO YAHUY!</div>
                <div class="jcb-right">
                  <div class="white-glow"></div>
                  <img class="prebiotic-health-cb-pic" src="img-product/lup.png" alt="" />
                  <!-- <div class="black-shadow">
                </div>
                  <div class="black-shadow-2">
                </div> -->
              </div>
            </div>

<!--Do Not COPY Bottom Part!! -->      
    </div>
  </div>
</div>
    <!-- End Banner -->

    <!-- Section Title -->
    <div class="container">
        <div class="section-title">
        <h3><span class="iconify icon-brand" data-icon="emojione-v1:laptop-computer"></span> New Laptop</h3>

            <form action="" method="get" class="form-search">
  <input type="text" name="search" placeholder="Search...">
 <span class="iconify" data-icon="bi:search"></span>
</form>
        </div>
    </div>
    <!-- End Section Title -->

    <!-- Content -->
    <div class="container">
        <div class="row-card">
           <?php
include 'database/koneksi.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM laptop_tb WHERE NamaLaptop LIKE '%$search%' ORDER BY idPrinter DESC";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) {
  while ($data = mysqli_fetch_array($result)) {
?>
<div class="card">
  <div class="card-image">
    <img src="img-product/<?= $data['GambarPrinter'] ?>" alt="">
  </div>
  <div class="card-body">
  <h4 class="title-product"><?= $data['NamaLaptop'] ?></h4>
  
  
  <p class="price-product"><?= 'Rp.' . number_format($data['HargaLaptop']) ?></p>
  <?php
  $stok = $data['stok'];
  if ($stok == 0) {
    // hapus data laptop_tb berdasarkan idPrinter jika stok 0
    $queryHapusPrinter = "DELETE FROM laptop_tb WHERE idPrinter = '".$data['idPrinter']."'";
    $resultHapusPrinter = mysqli_query($koneksi, $queryHapusPrinter);
  }
?>
<p class="title-product">Stock: <?= $stok ?></p>

 
  <a href="detail.php?id=<?php echo $data['idPrinter']; ?>" class="btn-add-to-cart">Details<span class="iconify icon-to-cart" data-icon="el:shopping-cart-sign"></span></a>

</div>

</div>
<?php
  }
} else {
  echo '<p>No product found.</p>';
}
?>

        </div>
    </div>
    <!-- End Content -->

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>

</body>
</html>