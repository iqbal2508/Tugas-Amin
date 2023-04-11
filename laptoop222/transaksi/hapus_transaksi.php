<?php
include '../database/koneksi.php';

if (isset($_POST['idTransaksi'])) {
    $idTransaksi = $_POST['idTransaksi'];

    $query = "DELETE FROM transaksi WHERE idTransaksi='$idTransaksi'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "<script>alert('Transaksi gagal dihapus')</script>";
    }
}
?>
