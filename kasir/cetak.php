<?php
include '../koneksi.php';

if (!isset($_GET['id_jual'])) {
    echo "ID Penjualan tidak ditemukan!";
    exit;
}

$id_jual = $_GET['id_jual'];
$jual = mysqli_query($koneksi, "
    SELECT 
        p.id_jual,
        p.tgl_jual,
        p.total_harga,
        u.user_nama
    FROM penjualan p
    LEFT JOIN user u ON p.user_id = u.user_id
    WHERE p.id_jual = '$id_jual'
");

if (mysqli_num_rows($jual) == 0) {
    echo "Data penjualan tidak ditemukan!";
    exit;
}

$p = mysqli_fetch_assoc($jual);

/* =====================
   AMBIL DETAIL BARANG
   ===================== */
$detail = mysqli_query($koneksi, "
    SELECT 
        b.nama_barang,
        d.jumlah,
        d.harga,
        d.subtotal
    FROM penjualan_detail d
    LEFT JOIN barang b ON d.id_barang = b.id_barang
    WHERE d.id_jual = '$id_jual'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Struk</title>
    <style>
        body {
            font-family: Arial;
        }
        .text-center {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

<h3 class="text-center">STRUK PENJUALAN</h3>
<hr>

<table>
    <tr>
        <td><b>Invoice</b></td>
        <td>INVOICE-<?php echo $p['id_jual']; ?></td>
    </tr>
    <tr>
        <td><b>Tanggal</b></td>
        <td><?php echo $p['tgl_jual']; ?></td>
    </tr>
    <tr>
        <td><b>Kasir</b></td>
        <td><?php echo $p['user_nama']; ?></td>
    </tr>
</table>

<table>
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    <?php 
    $no = 1; 
    while ($d = mysqli_fetch_assoc($detail)) { 
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama_barang']; ?></td>
        <td><?php echo $d['jumlah']; ?></td>
        <td><?php echo number_format($d['harga']); ?></td>
        <td><?php echo number_format($d['subtotal']); ?></td>
    </tr>
    <?php } ?>

    <tr>
        <th colspan="4">Total</th>
        <th>Rp <?php echo number_format($p['total_harga']); ?></th>
    </tr>
</table>

<p class="text-center" style="margin-top:20px;">
    Terima kasih telah berbelanja 🙏
</p>

</body>
</html>
