<?php
session_start();
include '../koneksi.php';

$tanggal = $_POST['tanggal'];
$user_id = $_SESSION['user_id'];
$id_barang = $_POST['id_barang'];
$jumlah    = $_POST['jumlah'];
$total = 0;

for($i=0; $i<count($id_barang); $i++){
    $data = mysqli_query($koneksi,"SELECT harga_jual, stok FROM barang WHERE id_barang='$id_barang[$i]'");
    $b = mysqli_fetch_array($data);

    if($jumlah[$i] > $b['stok']){
        echo "<script>alert('Stok tidak cukup');history.back();</script>";
        exit;
    }

    $subtotal = $jumlah[$i] * $b['harga_jual'];
    $total += $subtotal;
}
mysqli_query($koneksi,"INSERT INTO penjualan VALUES(
    '',
    '$tanggal',
    '$user_id',
    '$total'
)");

$id_jual = mysqli_insert_id($koneksi);
for($i=0; $i<count($id_barang); $i++){
    $data = mysqli_query($koneksi,"SELECT harga_jual FROM barang WHERE id_barang='$id_barang[$i]'");
    $b = mysqli_fetch_array($data);

    $subtotal = $jumlah[$i] * $b['harga_jual'];

    mysqli_query($koneksi,"INSERT INTO penjualan_detail VALUES(
        '',
        '$id_jual',
        '$id_barang[$i]',
        '$jumlah[$i]',
        '{$b['harga_jual']}',
        '$subtotal'
    )");

    mysqli_query($koneksi,"UPDATE barang 
        SET stok = stok - $jumlah[$i]
        WHERE id_barang='$id_barang[$i]'
    ");
}

echo "<script>alert('Transaksi berhasil');window.location='index.php';</script>";
?>