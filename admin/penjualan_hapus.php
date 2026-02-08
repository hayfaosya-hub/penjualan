<?php
include '../koneksi.php';

$id = $_GET['id'];
$q = mysqli_query($koneksi, "
    SELECT id_barang, jumlah 
    FROM penjualan_detail 
    WHERE id_jual='$id'
");

while($d = mysqli_fetch_array($q)){
    mysqli_query($koneksi, "
        UPDATE barang 
        SET stok = stok + {$d['jumlah']} 
        WHERE id_barang='{$d['id_barang']}'
    ");
}

mysqli_query($koneksi, "DELETE FROM penjualan_detail WHERE id_jual='$id'");

mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_jual='$id'");

header("location:penjualan.php");
exit;