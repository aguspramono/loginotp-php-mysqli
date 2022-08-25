<?php
include './koneksi.php'; //import file koneksi.php
include './myfunction.php'; //import file myfunction.php
session_start();
date_default_timezone_set("Asia/Jakarta");

$token = $_POST['token'];
$otpgabungan = $_POST['otpgabungan'];

$querycek = mysqli_query($koneksi, "select * from tb_otp as o inner join tb_privilege as p on(p.kodeUser=o.kodeUser) where o.kodeUser='" . $token . "' and o.kodeOtp='" . $otpgabungan . "'");

//cek apakah otp sudah benar
if (mysqli_num_rows($querycek) < 1) {
    echo "<div class='alert alert-danger' role='alert'>kode OTP salah</div>";
    return;
}

$data = mysqli_fetch_array($querycek);

//cek apakah otp kadaluarsa
if (date('Y-m-d H:i:s') > $data['expDate']) {
    echo "<div class='alert alert-danger' role='alert'>OTP kadaluarsa</div>";
    return;
}

if ($data['privilege'] == "user") {
    $_SESSION['loginuser'] = true;
    $_SESSION['tokenusers'] = $token;
    $_SESSION['namausers'] = $_SESSION['nama'];
    echo "user";
} else {
    $_SESSION['loginadmin'] = true;
    $_SESSION['tokenadmin'] = $token;
    $_SESSION['namauadmin'] = $_SESSION['nama'];
    echo "admin";
}

$querydeleteotp = mysqli_query($koneksi, "delete from tb_otp where kodeUser='" . $token . "'");
