<?php
session_start();
if($_SESSION['user_status'] != 2){
    header("location:../login.php");
}
include '../koneksi.php';
include 'header.php';
$id_user = $_SESSION['user_id'];
$id = $_GET['id'];
$detail = mysqli_query($koneksi,"
    SELECT 
        b.nama_barang,
        d.jumlah,
        d.harga,
        d.subtotal
    FROM penjualan_detail d
    JOIN barang b ON d.id_barang = b.id_barang
    JOIN penjualan p ON d.id_jual = p.id_jual
    WHERE d.id_jual='$id'
    AND p.user_id='$id_user'
");
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><b>Detail Penjualan #<?= $id; ?></b></h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead class="table-dark">
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
                    <tr class="table-secondary fw-bold">
                        <th colspan="4" style="text-align:right;">Total Harga</th>
                        <th>Rp <?= number_format($total); ?></th>
                    </tr>
                </tfoot>
            </table>
            <a href="index.php" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>
    </div>
</div>