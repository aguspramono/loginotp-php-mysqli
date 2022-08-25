<?php
include './koneksi.php';
session_start();

$token = $_GET['token'];
$query = mysqli_query($koneksi, "delete from tb_users where kodeUser='" . $token . "'");
if ($query) {
    mysqli_query($koneksi, "delete from tb_privilege where kodeUser='" . $token . "'");
    $_SESSION['msgsuccess'] = "data berhasil dihapus";
    header("location:./../admin/admin.php");
    return;
} else {
    $_SESSION['msgerror'] = "gagal menghapus data";
    header("location:./../admin/admin.php");
    return;
}
