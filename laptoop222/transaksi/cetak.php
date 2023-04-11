<?php
//sambungkan ke fpdf library
require '../library/fpdf.php';
include '../database/koneksi.php';

//instansiasi objek dan memberikan pengaturan halaman pdf
$pdf=new FPDF('P','mm','A4');
$pdf->addpage();

// Buat judul disini
$pdf->SetFont('Times','B',13);
$pdf->Cell(200,10,'DETAIL TRANSAKSI LAPTOP',0,0,'C');

// Buat Pengaturan tabel HEAD 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,7,'NO',1,0,'C');
$pdf->Cell(70,7,'NAMA LAPTOP',1,0,'C');
$pdf->Cell(70,7,'Tanggal',1,0,'C');
$pdf->Cell(40,7,'SUBTOTAL',1,0,'C');   


// Buat Pengaturan tabel isi
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',9);
$no=1;
$data = mysqli_query($koneksi,"SELECT transaksi.subtotal, transaksi.Jumlah, transaksi.idTransaksi, transaksi.status , transaksi.tanggal, transaksi.UserIdUser2, user.Username, laptop_tb.NamaLaptop, laptop_tb.HargaLaptop FROM transaksi INNER JOIN user ON transaksi.UserIdUser2 = user.idUser INNER JOIN laptop_tb ON transaksi.Laptop_tblIdPrinter = laptop_tb.idPrinter");
while($row = mysqli_fetch_array($data)){
     $pdf->Cell(10,7,$no++,1,0,'C');
     $pdf->Cell(70,7,$row['NamaLaptop'],1,0,'C');
     $pdf->Cell(70,7,$row['tanggal'],1,0,'C');
     $pdf->Cell(40,7,$row['subtotal'],1,1,'C');    
}

$pdf->Output();
?>