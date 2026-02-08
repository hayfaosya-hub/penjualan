<?php
session_start();
if($_SESSION['user_status'] != 2){
    header("location:../login.php");
}
include '../koneksi.php';
$id_user = $_SESSION['user_id'];
$riwayat = mysqli_query($koneksi, "
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        SUM(d.jumlah) AS jumlah_item
    FROM penjualan p
    JOIN penjualan_detail d ON p.id_jual = d.id_jual
    WHERE p.user_id = '$id_user'
    GROUP BY p.id_jual
    ORDER BY p.id_jual DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard Kasir</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-dark bg-dark">

            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1"> Sistem Kasir</span>
                <span class="text-white">
                    <?php echo $_SESSION['user_nama']; ?>
                </span>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h4 class="card-title">Selamat Datang 👋</h4>
                            <p class="card-text">
                                Anda login sebagai <b>Kasir</b>
                            </p>

                            <a href="penjualan.php" class="btn btn-success w-100 mb-2">
                                Transaksi Penjualan
                            </a>

                            <a href="../logout.php" class="btn btn-danger w-100">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <b>Riwayat Penjualan Terakhir</b>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Jual</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Item</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    $no = 1;
                                    if(mysqli_num_rows($riwayat) > 0){
                                        while($r = mysqli_fetch_array($riwayat)){
                                    ?>
                                    <tr>
                                        <td>INVOICE-<?= $r['id_jual']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($r['tgl_jual'])); ?></td>
                                        <td><?= $r['jumlah_item']; ?></td>
                                        <td>Rp <?= number_format($r['total_harga']); ?></td>
                                        <td>
                                            <a href="penjualan_detail.php?id=<?= $r['id_jual']; ?>"class="btn btn-sm btn-primary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Belum ada transaksi
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>