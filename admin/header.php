<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penjualan</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
    <script type="text/javascript" src="../asset/js/jquery.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
</head>
<body style="background: #f0f0f0;">
    <?php
        session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_status'] != 1) {
            header("location:../index.php?pesan=belum_login");
            exit;
        }
    ?>
    
    <nav class="navbar navbar-inverse" style="border-radius:0px;">
        <div class="container-fluid">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand">Penjualan</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php 
                    $page = basename($_SERVER['PHP_SELF']);
                ?>
                <ul class="nav navbar-nav">
                    <li class="<?= ($page == 'index.php') ? 'active' : '' ?>">
                        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li class="<?= ($page == 'user.php') ? 'active' : '' ?>">
                        <a href="user.php"><i class="glyphicon glyphicon-user"></i> User</a>
                    </li>
                    <li class="<?= ($page == 'barang.php') ? 'active' : '' ?>">
                        <a href="barang.php"><i class="glyphicon glyphicon-th-large"></i> Barang</a>
                    </li>
                    <li class="<?= ($page == 'penjualan.php') ? 'active' : '' ?>">
                        <a href="penjualan.php"><i class="glyphicon glyphicon-shopping-cart"></i> Penjualan</a>
                    </li>
                    <li class="<?= ($page == 'laporan.php') ? 'active' : '' ?>">
                        <a href="laporan.php"><i class="glyphicon glyphicon-shopping-cart"></i> Laporan</a>
                    </li>
                    <li>
                        <a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><p style="color:white; padding:15px;"><b>Halo, <?php echo $_SESSION['user_nama']; ?></b>!</p></li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>