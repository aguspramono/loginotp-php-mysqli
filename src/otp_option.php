<?php
include './koneksi.php'; //import file koneksi.php
include './myfunction.php'; //import file myfunction.php
session_start();
date_default_timezone_set("Asia/Jakarta");

$logid = ($_SESSION['optionotp'] == 'email' ? $_SESSION['email'] : $_SESSION['nope']);

$kodeotp = generateNumericOTP(6); //random kode otp 6 digit
$minutes_to_add = 2; //expired time
$time = new DateTime();
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
$stamp = $time->format('Y-m-d H:i:s');

$status = "";
$pesan = "";
$query = "";
$token = "";
$nama = "";
$email = "";

//cek apakah token ada dalam database by nope
$query = mysqli_query($koneksi, "select * from tb_users where NopeUser='" . $logid . "'");
if (mysqli_num_rows($query) < 1) {

    $query = mysqli_query($koneksi, "select * from tb_users where EmailUser='" . $logid . "'");
    $data = mysqli_fetch_array($query);

    $_SESSION['token'] = $data['kodeUser'];
    $_SESSION['nope'] = $data['NopeUser'];
    $_SESSION['email'] = $data['EmailUser'];
    $_SESSION['nama'] = $data['NamaLengkap'];
    $_SESSION['optionotp'] = 'email';

    $subject = "Kode OTP untuk login";
    $isi = "Hallo " . $_SESSION['nama'] . "<br/> Berikut kode OTP untuk login <br/><br/><b>" . $kodeotp . "</b>";
    kirimemail($_SESSION['email'], $subject, $isi);
} else {
    $data = mysqli_fetch_array($query);


    $_SESSION['token'] = $data['kodeUser'];
    $_SESSION['nope'] = $data['NopeUser'];
    $_SESSION['email'] = $data['EmailUser'];
    $_SESSION['nama'] = $data['NamaLengkap'];
    $_SESSION['optionotp'] = 'phone';

    $isi = "Hallo " . $_SESSION['nama'] . ", Berikut kode OTP untuk login " . $kodeotp . "";
    kirimsms($nope, $isi);
}

$_SESSION['exptime'] = $stamp;
$querydeleteotp = mysqli_query($koneksi, "delete from tb_otp where kodeUser='" . $_SESSION['token'] . "'");
$queryinsertotp = mysqli_query($koneksi, "insert into tb_otp(`IDOtp`, `kodeUser`, `kodeOtp`, `expDate`) values(NULL,'" . $_SESSION['token'] . "','" . $kodeotp . "','" . $stamp . "')");

header('location:./../../otp_form.php');
