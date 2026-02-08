<?php
include '../koneksi.php';
include 'header.php';

$id = $_GET['id'];

$detail = mysqli_query($koneksi,"
    SELECT 
        b.nama_barang,
        d.jumlah,
        d.harga,
        d.subtotal
    FROM penjualan_detail d
    JOIN barang b ON d.id_barang = b.id_barang
    WHERE d.id_jual='$id'
");
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Detail Penjualan #<?= $id; ?></b></h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $total = 0;
                    while($d = mysqli_fetch_array($detail)){ 
                        $total += $d['subtotal'];
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td>Rp <?= number_format($d['harga']); ?></td>
                        <td><?= $d['jumlah']; ?></td>
                        <td>Rp <?= number_format($d['subtotal']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right;">Total Harga</th>
                        <th>Rp <?= number_format($total); ?></th>
                    </tr>
                </tfoot>
            </table>
            <a href="penjualan.php" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>