<?php
session_start();
include '../koneksi.php';

$tanggal   = $_POST['tanggal'];
$id_barang = $_POST['id_barang'];
$jumlah    = $_POST['jumlah'];

$total = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Preview Penjualan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-4">
            <h3>Konfirmasi Transaksi Penjualan</h3>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                for($i=0; $i<count($id_barang); $i++){
                    $q = mysqli_query($koneksi,"SELECT nama_barang, harga_jual FROM barang WHERE id_barang='$id_barang[$i]'");
                    $b = mysqli_fetch_array($q);

                    $subtotal = $jumlah[$i] * $b['harga_jual'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $b['nama_barang']; ?></td>
                        <td>Rp <?= number_format($b['harga_jual']); ?></td>
                        <td><?= $jumlah[$i]; ?></td>
                        <td>Rp <?= number_format($subtotal); ?></td>
                    </tr>

                    <input type="hidden" name="id_barang[]" value="<?= $id_barang[$i]; ?>">
                    <input type="hidden" name="jumlah[]" value="<?= $jumlah[$i]; ?>">
                <?php } ?>

                </tbody>
                <tfoot>
                    <tr class="table-secondary">
                        <th colspan="3">TOTAL</th>
                        <th>Rp <?= number_format($total); ?></th>
                    </tr>
                </tfoot>
            </table>

            <form action="proses_penjualan.php" method="post">
                <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">

                <?php
                for($i=0; $i<count($id_barang); $i++){
                    echo "<input type='hidden' name='id_barang[]' value='{$id_barang[$i]}'>";
                    echo "<input type='hidden' name='jumlah[]' value='{$jumlah[$i]}'>";
                }
                ?>

                <button type="submit" class="btn btn-success">
                    Konfirmasi & Simpan
                </button>

                <a href="penjualan.php" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </body>
</html>