<?php
include './koneksi.php'; //import file koneksi.php
include './myfunction.php'; //import file myfunction.php
session_start();

// menangkap data yang di kirim dari form register.php
$nama = $_POST['namalengkap'];
$email = $_POST['email'];
$nope = $_POST['nope'];
$emailtemp = $_POST['emailtemp'];
$nopetemp = $_POST['nopetemp'];
$privilege = $_POST['privilege'];
$token = $_POST['token'];


//cek apakah nomor handphone sudah terdaftar atau belum
if ($nope != $nopetemp) {
    $querycek = mysqli_query($koneksi, "select * from tb_users where NopeUser='" . $nope . "'");
    if (mysqli_num_rows($querycek) > 0) {
        $_SESSION['msgerror'] = "nomor handphone sudah terdaftar";
        header("location:./../admin/editadmin.php?token=" . $token);
        return;
    }
}

//cek apakah email sudah terdaftar atau belum
if ($email != $emailtemp) {
    $querycek = mysqli_query($koneksi, "select * from tb_users where EmailUser='" . $email . "'");
    if (mysqli_num_rows($querycek) > 0) {
        $_SESSION['msgerror'] = "email sudah terdaftar";
        header("location:./../admin/editadmin.php?token=" . $token);
        return;
    }
}

// update data tabel tb_users
$queryuser = mysqli_query($koneksi, "update tb_users set NamaLengkap='" . $nama . "',EmailUser='" . $email . "',NopeUser='" . $nope . "' where kodeUser='" . $token . "'");

//cek apakah berhasil atau tidak
if ($queryuser) {

    //update data tabel privilege
    $queryprivilege = mysqli_query($koneksi, "update tb_privilege set privilege='" . $privilege . "' where kodeUser='" . $token . "'");
    $_SESSION['msgsuccess'] = "edit admin berhasil";
    header("location:./../admin/admin.php");
    return;
} else {
    $_SESSION['msgerror'] = "edit admin gagal, silahkan coba kembali";
    header("location:./../admin/admin.php");
    return;
}
