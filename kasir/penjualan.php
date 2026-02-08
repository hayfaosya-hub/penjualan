<?php
session_start();
include '../koneksi.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Penjualan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

        <div class="container mt-4">
            <h3 class="mb-3">Transaksi Penjualan</h3>
            <form action="preview_penjualan.php" method="post">
                <div class="card shadow">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div id="barang-area">
                            <div class="row mb-2">
                                <div class="col-md-7">
                                    <label class="form-label">Nama Barang</label>
                                    <select name="id_barang[]" class="form-select" required>
                                        <option value="">-- Pilih Barang --</option>
                                        <?php
                                        $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                                        while($b = mysqli_fetch_array($barang)){
                                        ?>
                                        <option value="<?= $b['id_barang']; ?>">
                                            <?= $b['nama_barang']; ?> (Stok: <?= $b['stok']; ?>)
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah[]" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mb-3" onclick="tambahBarang()">
                            ➕ Tambah Barang
                        </button>
                        <button type="submit" class="btn btn-success w-100">
                            Simpan Transaksi
                        </button>

                    </div>
                </div>
            </form>
        </div>
        <script>
            function tambahBarang(){
                let area = document.getElementById("barang-area");
                let html = `
                    <div class="row mb-2">
                        <div class="col-md-7">
                            <select name="id_barang[]" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php
                                $barang2 = mysqli_query($koneksi,"SELECT * FROM barang");
                                while($b2 = mysqli_fetch_array($barang2)){
                                    echo "<option value='{$b2['id_barang']}'>{$b2['nama_barang']} (Stok: {$b2['stok']})</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required>
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
                        </div>
                    </div>
                `;
                area.insertAdjacentHTML("beforeend", html);
            }
        </script>
    </body>
</html>