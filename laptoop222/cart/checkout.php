<?php 
session_start();
require '../database/koneksi.php';
require '../item.php';
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];
$iduser = $_SESSION['id_user'];
$cart = unserialize(serialize($_SESSION['cart']));
$status = 1;

$sql = "INSERT INTO transaksi (NamaAnda, alamat, no_telp, email, status, UserIdUser, jumlah, subtotal, HargaLaptop, Laptop_tblIdPrinter, UserIdUser2) VALUES ('$nama', '$alamat', '$no_telp', '$email', '$status', '$iduser', ";
for($i=0; $i<count($cart);$i++) {
    $subtotal = $cart[$i]->price * $cart[$i]->quantity;
    $sql .= $cart[$i]->quantity . ', ' . $subtotal . ', ' . $cart[$i]->price . ', ' . $cart[$i]->id . ', ' . $iduser;
    if ($i != count($cart) - 1) {
        $sql .= '), (' . "'$nama', '$alamat', '$no_telp', '$email', '$status', '$iduser', ";
    }
}
$sql .= ')';
mysqli_query($koneksi, $sql);

// Clear all product in cart
unset($_SESSION['cart']);
header('Location: ../order/');
?>
