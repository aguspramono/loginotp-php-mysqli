<?php
include './koneksi.php'; //import file koneksi.php
include './myfunction.php'; //import file myfunction.php
session_start();
date_default_timezone_set("Asia/Jakarta");

//ambil data dari param link
$token = $_GET['token'];
$email = (!empty($_GET['email']) ? $_GET['email'] : "");
$nope = (!empty($_GET['nope']) ? $_GET['nope'] : "");

$kodeotp = generateNumericOTP(6); //random kode otp 6 digit

//expired time
$minutes_to_add = 2;

$time = new DateTime();
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

$stamp = $time->format('Y-m-d H:i:s');

$_SESSION['exptime'] = $stamp;

//jika pilihan otp melalui email
if (!empty($email)) {
    $querycek = mysqli_query($koneksi, "select * from tb_users where EmailUser='" . $email . "'");
    $dataemail = mysqli_fetch_array($querycek);
    if ($token != $dataemail['kodeUser']) { // cek apakah kode user sama dengan token
        $_SESSION['msgerror'] = "Terjadi kesalahan";
        header("location:./../otp_option.php");
        return;
    }

    $subject = "Kode OTP untuk login";
    $isi = "Hallo " . $_SESSION['nama'] . "<br/> Berikut kode OTP untuk login <br/><br/><b>" . $kodeotp . "</b>";
    kirimemail($email, $subject, $isi); //cek file myfunction.php
}

if (!empty($nope)) {
    $querycek = mysqli_query($koneksi, "select * from tb_users where NopeUser='" . $nope . "'");
    $dataemail = mysqli_fetch_array($querycek);
    if ($token != $dataemail['kodeUser']) { // cek apakah kode user sama dengan token
        $_SESSION['msgerror'] = "Terjadi kesalahan";
        header("location:./../otp_option.php");
        return;
    }

    $isi = "Hallo " . $_SESSION['nama'] . ", Berikut kode OTP untuk login " . $kodeotp . "";
    kirimsms($nope, $isi);
}

$querydeleteotp = mysqli_query($koneksi, "delete from tb_otp where kodeUser='" . $token . "'");

$queryinsertotp = mysqli_query($koneksi, "insert into tb_otp(`IDOtp`, `kodeUser`, `kodeOtp`, `expDate`) values(NULL,'" . $token . "','" . $kodeotp . "','" . $stamp . "')");
header("location:./../otp_form.php");
