<?php
session_start();
require '../database/koneksi.php';

// Menyimpan data biodata ke dalam session
$_SESSION['nama'] = $_POST['nama'];
$_SESSION['alamat'] = $_POST['alamat'];
$_SESSION['no_telp'] = $_POST['no_telp'];

// Redirect ke halaman checkout
header('Location: checkout.php');
exit();
?>
