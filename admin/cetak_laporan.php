<?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

<h3>LAPORAN PENJUALAN</h3>
<p style="text-align:center;">
    Dari tanggal <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b>
</p>

<table>
    <tr>
        <th>No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Jumlah Barang</th>
        <th>Total Harga</th>
    </tr>

    <?php
    $no = 1;

    $query = mysqli_query($koneksi, "
        SELECT 
            p.id_jual,
            p.tgl_jual,
            p.total_harga,
            u.user_nama,
            SUM(pd.jumlah) AS jumlah_barang
        FROM penjualan p
        JOIN penjualan_detail pd ON p.id_jual = pd.id_jual
        JOIN user u ON p.user_id = u.user_id
        WHERE p.tgl_jual BETWEEN '$dari' AND '$sampai'
        GROUP BY p.id_jual
        ORDER BY p.id_jual DESC
    ");

    while ($d = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td>INVOICE-<?php echo $d['id_jual']; ?></td>
            <td><?php echo $d['tgl_jual']; ?></td>
            <td><?php echo $d['user_nama']; ?></td>
            <td><?php echo $d['jumlah_barang']; ?></td>
            <td><?php echo "Rp. " . number_format($d['total_harga']); ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
