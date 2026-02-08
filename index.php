<!DOCTYPE html>
<html>
    <head>
        <title>Sistem Penjualan </title>
        <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
        <script type="text/javascript" src ="asset/js/jquery.js"></script>
        <script type="text/javascript" src ="asset/js/bootstrap.js"></script>
    </head>
    <body style="background: #f0f0f0;">
        <br><br><br>
        <center>
            <h2><b>SILAHKAN LOGIN</b></h2>
        </center>
        <br>
        <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <?php 
                if(isset($_GET['pesan'])) {
                    if($_GET['pesan'] == "gagal") {
                        echo "<div class='alert alert-danger'>Login gagal! username atau password salah!</div>";
                    }elseif ($_GET['pesan'] == "logout") {
                        echo "<div class='alert alert-info'>Anda telah berhasil logout!</div>";
                    }elseif ($_GET['pesan'] == "belum_login") {
                        echo "<div class='alert alert-danger'> Anda harus login untuk mengakses halaman admin!</div>";
                    }
                }
            ?>
                <form method="POST" action="login.php">
                    <div class="panel">
                        <br>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                                <input type="submit" name="login" value="Log in" class="btn btn-primary">
                        </div>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>