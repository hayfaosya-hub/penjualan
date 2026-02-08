<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['user_nama'] = $data['user_nama'];
        $_SESSION['user_status'] = $data['user_status'];

        if ($data['user_status'] == 1) {
            header("Location: admin/index.php");
            exit;
        } else if ($data['user_status'] == 2) {
            header("Location: kasir/index.php");
            exit;
        }
    } else {
        echo "<script>alert('Username atau Password salah');</script>";
    }
}
?>