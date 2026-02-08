<?php
    include 'header.php';
?>

<div class="container">
        <div class="alert alert-info text-center">
            <h4 style="margin-bottom:0px;">Data Barang Sistem Penjualan</h4>
        </div>
    <div class="panel">
        <div class="panel-body">
            <a href="barang_tambah.php" class="btn btn-sm btn-primary">+Tambah Barang Baru</a>
            <br><br>
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="15%">ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th width="15%">OPSI</th>
                </tr>
                <?php
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,"select * from barang");
                    $no = 1;
                    while ($d=mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td><?php echo $d['id_barang']; ?></td>
                        <td><?php echo $d['nama_barang']; ?></td>
                        <td><?php echo $d['harga_beli']; ?></td>
                        <td><?php echo $d['harga_jual']; ?></td>
                        <td><?php echo $d['stok']; ?></td>
                        <td>
                            <a href="barang_edit.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-sm btn-info Edit">Edit</a>
                            <a href="barang_hapus.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</div>