<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPrinter | Data Printer</title>

    <link rel="stylesheet" href="../css/side.css">
    <link rel="stylesheet" href="../css/prouk.css">
</head>
<body>
<div class="sidebar">
        <h4 class="sidebar-brand">Laptop</h4>
        <ul>
        <li>
                <a href="dashboard.php"><i class="fas fa-tachometer-alt-average"></i> &nbsp;Dashboard</a>
            </li>
            <li>
                <a href="../product/index.php"><span class="iconify icon-brand" data-icon="bi:printer-fill"></span> &nbsp;Printers</a>
            </li>
            <li>
                <a href="../transaksi"><i class="fas fa-cart-arrow-down"></i> &nbsp;Transaksi</a>
            </li>
            <li class="active">
                <a href="user.php"><i class="fas fa-cart-arrow-down"></i> &nbsp;User</a>
            </li>
            <li>
                <a href="../logout.php" onclick="return confirm('Apakah Kamu Yakin Ingin Keluar ?')"> <i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp;Logout</a>
            </li>
        </ul>
    </div>
    <?php 
        
        include "../database/koneksi.php";
        
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);

            $query = "DELETE FROM laptop_tb WHERE idPrinter='$id'";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                header("Location: index.php");
            }else {
                echo "<script>alert('Produk Gagal Dihapus')</script>";
            }
        }
        
        
    ?>
    
    <main>
        <div class="section-title">
            Data User
        </div>
        <div class="search-form">

</div>

        <div class="row">
            <div class="card mt-5">
                
                <div class="table-responsive">
                    <table border="1px">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            
                        </tr>
                        <?php 
                        
                        include "../database/koneksi.php";

                        $query = "SELECT * FROM user ORDER BY idUser ASC";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;
                        while ($data = mysqli_fetch_array($result))  { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['Username'] ?></td>
                            
                                <td><?php echo $data['Password'] ?></td>
                               
                            </tr>
                        <?php 
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b8d1f961b1.js" crossorigin="anonymous"></script>

    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>
</body>
</html>