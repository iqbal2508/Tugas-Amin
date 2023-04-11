<?php
ob_start();
?>
<?php

session_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Toko Online</title>
  <link rel="stylesheet" href="style.css">
  <!-- Root CSS -->
  <link rel="stylesheet" href="../css/rot.css">

<!-- Style CSS -->
<link rel="stylesheet" href="../css/jang.css">
</head>

<center><h3>MASUKAN BIODATA DIRI</h3></center>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span class="iconify icon-brand" data-icon="fluent-emoji:laptop"></span>
            <h4 class="text-brand">LaptopYahuy</h4>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="../order/" class="nav-link"><span class="iconify"
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
                <a href="index.php" class="nav-link active"><span class="iconify"
                        data-icon="clarity:shopping-cart-line"></span></a>
                <span class="badge">
                    <?= count($_SESSION['cart']); ?>
                </span>
            </li>
            <?php

            if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == 'admin') {
                    // Halaman Admin
                    echo '
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="dropbtn"><span class="iconify icon-user" data-icon="carbon:user-avatar"></span>'. $_SESSION['username'] .'</a>
                            <div class="dropdown-content">
                                <a href="../admin/dashboard.php">Dashboard</a>
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

    <?php
    require '../database/koneksi.php';
    require '../item.php';

    if (isset($_GET['id']) && !isset($_POST['update'])) {
        $sql = 'SELECT * FROM laptop_tb WHERE idPrinter=' . $_GET['id'];
        $result = mysqli_query($koneksi, $sql);
        $product = mysqli_fetch_object($result);
        $item = new Item();
        $item->id = $product->idPrinter;
        $item->name = $product->NamaLaptop;
        $item->price = $product->HargaLaptop;
        $iteminstock = 10;
        $item->quantity = 1;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $index = -1;
        $cart = unserialize(serialize($_SESSION['cart']));
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]->id == $_GET['id']) {
                $index = $i;
                break;
            }
        }

        if ($index == -1) {
            $_SESSION['cart'][] = $item;
        } else {
            if ($cart[$index]->quantity < $iteminstock) {
                $cart[$index]->quantity++;
            }

            $_SESSION['cart'] = $cart;
        }  
    }

    if (isset($_GET['index']) && !isset($_POST['update'])) {
        $cart = unserialize(serialize($_SESSION['cart']));
        unset($cart[$_GET['index']]);
        $cart = array_values($cart);
        $_SESSION['cart'] = $cart;
    }
    
    if (isset($_POST['update'])) {
        $arrQuantity = $_POST['quantity'];
        $cart = unserialize(serialize($_SESSION['cart']));
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]->quantity = $arrQuantity[$i];
        }
        $_SESSION['cart'] = $cart;
    }
    ?>

  <form action="checkout.php" method="POST">
  <div class="formbold-main-wrapper">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="formbold-form-wrapper">
    <form action="https://formbold.com/s/FORM_ID" method="POST">
      <div class="row">
        <div class="card mt-5">
            <form method="POST">
                <table id="t01">
        <label for="nama" class="formbold-form-label"> Full Name </label>
        <input
          type="text"
          name="nama"
          id="nama"
          placeholder="Full Name"
          class="formbold-form-input"
        />
      </div>
      <div class="formbold-mb-5">
        <label for="alamat" class="formbold-form-label"> Alamat </label>
        <input
          type="text"
          name="alamat"
          id="alamat"
          placeholder="Enter your alamat"
          class="formbold-form-input"
        />
      </div>
      <div class="formbold-mb-5">
        <label for="no_telp" class="formbold-form-label"> Phone Number </label>
        <input
          type="text"
          name="no_telp"
          id="no_telp"
          placeholder="Enter your phone number"
          class="formbold-form-input"
        />
      </div>
      <div class="formbold-mb-5">
        <label for="email" class="formbold-form-label"> Email Address </label>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Enter your email"
          class="formbold-form-input"
        />
      </div>
      
         
      <div>
        
        <button type="submit" class="btn" name="submit">Checkout</button>
        <a href="index.php" class="btn">BACK</a>

        </table>
      </div>
    </form>
  </div>
</div>
<script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>

 