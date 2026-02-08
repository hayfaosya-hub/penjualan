<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Filter Laporan Penjualan</h4>
        </div>
        <div class="panel-body">
            <form method="get">
                <table class="table table-bordered">
                    <tr>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th width="1%">Aksi</th>
                    </tr>
                    <tr>
                        <td><input type="date" name="tgl_dari" class="form-control" required></td>
                        <td><input type="date" name="tgl_sampai" class="form-control" required></td>
                        <td><button type="submit" class="btn btn-primary">Filter</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <br>

    <?php if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])) {
        $dari = $_GET['tgl_dari'];
        $sampai = $_GET['tgl_sampai'];
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Laporan Penjualan dari 
                <b><?php echo $dari; ?></b> sampai 
                <b><?php echo $sampai; ?></b>
            </h4>
        </div>

        <div class="panel-body">
            <a target="_blank"
               href="cetak_laporan.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>"
               class="btn btn-primary">
               <i class="glyphicon glyphicon-print"></i> Cetak
            </a>

            <br><br>

            <table class="table table-bordered table-striped">
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
                $data = mysqli_query($koneksi, "
                    SELECT 
                        p.id_jual,
                        p.tgl_jual,
                        p.total_harga,
                        u.user_nama AS nama_kasir,
                        SUM(d.jumlah) AS jumlah_barang
                    FROM penjualan p
                    JOIN penjualan_detail d ON p.id_jual = d.id_jual
                    JOIN user u ON p.user_id = u.user_id
                    WHERE p.tgl_jual BETWEEN '$dari' AND '$sampai'
                    GROUP BY p.id_jual
                    ORDER BY p.id_jual DESC
                ");

                while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>INVOICE-<?php echo $d['id_jual']; ?></td>
                    <td><?php echo $d['tgl_jual']; ?></td>
                    <td><?php echo $d['nama_kasir']; ?></td>
                    <td><?php echo $d['jumlah_barang']; ?></td>
                    <td><?php echo "Rp. ".number_format($d['total_harga']); ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php } ?>
</div>