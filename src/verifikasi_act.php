<?php
include './koneksi.php'; //import file koneksi.php
session_start();

$token = $_GET['token'];

//cek token kosong atau tidak
if (empty($token)) {
    $_SESSION['msgerror'] = "terjadi kesalahan";
    header("location:./../login.php");
    return;
}

//cek apakah token ada dalam database
$querycek = mysqli_query($koneksi, "select * from tb_users where kodeUser='" . $token . "'");
if (mysqli_num_rows($querycek) < 1) {
    $_SESSION['msgerror'] = "terjadi kesalahan";
    header("location:./../login.php");
    return;
}

//update status verifikasi di tabel tb_users
$queryupdateuser = mysqli_query($koneksi, "update tb_users set statusVerif='Y' where kodeUser='" . $token . "'");

if ($queryupdateuser) {
    $_SESSION['msgsuccess'] = "email anda berhasil diverifikasi, silahkan login";
    header("location:./../login.php");
    return;
} else {
    $_SESSION['msgerror'] = "terjadi kesalahan";
    header("location:./../login.php");
    return;
}
