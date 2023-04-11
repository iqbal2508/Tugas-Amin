<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'lsp2';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

if (!$koneksi) {
    die("Koneksi Gagal" . mysqli_connect_error());
}

?>