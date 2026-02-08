<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="alert alert-info text-center">
        <h4 style="margin-bottom:0px;">Selamat Datang, Anda Login Sebagai <b>Admin</b></h4>
    </div>
    <div class="panel">
        <div class="panel-heading"><h4><b>Dashboard</b></h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-user"></i>
                                <span class="pull-right">
                                    <?php
                                    $kasir = mysqli_query($koneksi,"SELECT * FROM user WHERE user_status=2");
                                    echo mysqli_num_rows($kasir);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Kasir
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-th-large"></i>
                                <span class="pull-right">
                                    <?php
                                    $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                                    echo mysqli_num_rows($barang);
                                    ?>
                                </span>
                            </h1>
                            Total Barang
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-ok-circle"></i>
                                <span class="pull-right">
                                    <?php
                                    $stok = mysqli_query($koneksi,"SELECT SUM(stok) AS total FROM barang");
                                    $s = mysqli_fetch_array($stok);
                                    echo $s['total'];
                                    ?>
                                </span>
                            </h1>
                            Total Stok
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                <span class="pull-right">
                                    <?php
                                    $trx = mysqli_query($koneksi,"SELECT * FROM penjualan");
                                    echo mysqli_num_rows($trx);
                                    ?>
                                </span>
                            </h1>
                            Total Penjualan
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h4><b>Riwayat Penjualan Terakhir</b></h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID Jual</th>
                    <th>Kasir</th>
                    <th>Tanggal</th>
                    <th>Jumlah Item</th>
                    <th>Total Harga</th>
                </tr>
                <?php
                $data = mysqli_query($koneksi, "
                    SELECT 
                        p.id_jual,
                        p.tgl_jual,
                        u.user_nama,
                        SUM(d.jumlah) AS jumlah_item,
                        p.total_harga
                    FROM penjualan p
                    JOIN user u 
                        ON p.user_id = u.user_id
                    JOIN penjualan_detail d 
                        ON p.id_jual = d.id_jual
                    GROUP BY p.id_jual
                    ORDER BY p.id_jual DESC
                    LIMIT 10
                ");
                $no=1;
                while($d=mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td>INVOICE-<?= $d['id_jual']; ?></td>
                    <td><?= $d['user_nama']; ?></td>
                    <td><?= date('d-m-Y', strtotime($d['tgl_jual'])); ?></td>
                    <td><?= $d['jumlah_item']; ?></td>
                    <td><b>Rp <?= number_format($d['total_harga']); ?></b></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>