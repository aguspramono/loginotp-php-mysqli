<?php
include './koneksi.php'; //import file koneksi.php
include './myfunction.php'; //import file myfunction.php
session_start();

// menangkap data yang di kirim dari form register.php
$nama = $_POST['namalengkap'];
$email = $_POST['email'];
$nope = $_POST['nope'];
$privilege = (!empty($_POST['privilege']) ? $_POST['privilege'] : 'user');
$statusverif = ($privilege == "user" ? "N" : "Y");
$kodeuser = rand(1, 1000000000);
$status = "";
$pesan = "";


//cek apakah email dan nomor handphone sudah terdaftar atau belum
$querycek = mysqli_query($koneksi, "select * from tb_users where EmailUser='" . $email . "' or NopeUser='" . $nope . "'");
if (mysqli_num_rows($querycek) > 0) {
    if ($privilege == "user") {
        $status = "error";
        $pesan = "email atau nomor handphone sudah terdaftar";
        echo $status . "^" . $pesan;
        return;
    } else {
        $_SESSION['msgerror'] = "email atau nomor handphone sudah terdaftar";
        header("location:./../admin/tambahadmin.php");
    }
}

// menginput data ke database pada tabel tb_users
$queryuser = mysqli_query($koneksi, "insert into tb_users (`idUser`, `kodeUser`, `NamaLengkap`, `EmailUser`, `NopeUser`, `statusVerif`) values(NULL,'" . md5($kodeuser) . "','" . $nama . "','" . $email . "','" . $nope . "','" . $statusverif . "')");

//cek apakah berhasil atau tidak
if ($queryuser) {

    //masukkan data ke tabel privilege
    $queryprivilege = mysqli_query($koneksi, "insert into tb_privilege values('','" . md5($kodeuser) . "','" . $privilege . "')");

    //kirim email verifikasi
    $subject = "Verifikasi email"; //subjek email
    $isi = "Hallo " . $nama . ", <br/> silahkan verifikasi email Anda dengan klik link di bawah ini<br/><a href='http://localhost/namafolder/src/verifikasi_act.php?token=" . md5($kodeuser) . "'>Verifikasi Email</a>"; //isi pesan email
    if ($privilege == "user") {

        kirimemail($email, $subject, $isi); //cek file myfunction.php
        $status = "success";
        $pesan = "pendaftaran anda berhasil, silahkan verifikasi email anda";
        echo $status . "^" . $pesan;
    } else {
        $_SESSION['msgsuccess'] = "pendaftaran admin berhasil";
        header("location:./../admin/tambahadmin.php");
    }

    return;
} else {
    if ($privilege == "user") {
        $status = "error";
        $pesan = "endafaran anda gagal, silahkan coba kembali";
        echo $status . "^" . $pesan;
    } else {
        $_SESSION['msgerror'] = "pendaftaran admin gagal";
        header("location:./../admin/tambahadmin.php");
    }

    return;
}
