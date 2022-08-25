<?php session_start();
if (empty($_SESSION['nama'])) {
    header("location:./login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kode OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-lg-6 col-sm-12">

            <div id="msg"></div>
            <h2>OTP</h2>
            <span>Hallo <b><?php echo $_SESSION['nama']; ?></b>, silahkan masukkan <b>6 digit</b> kode OTP di bawah ini: </span>
            <div class="row mt-2">
                <div class="col-2">
                    <input type="text" pattern="\d*" min="0" name="otp1" id="otp1" maxlength="1" onkeyup="cekOtp(this,document.getElementById('otp2'));" class="form-control text-center" autofocus>
                </div>
                <div class="col-2">
                    <input type="text" pattern="\d*" min="0" name="otp2" id="otp2" maxlength="1" onkeyup="cekOtp(this,document.getElementById('otp3'));" class="form-control text-center">
                </div>
                <div class="col-2">
                    <input type="text" pattern="\d*" min="0" name="otp3" id="otp3" maxlength="1" onkeyup="cekOtp(this,document.getElementById('otp4'));" class="form-control text-center">
                </div>
                <div class="col-2">
                    <input type="text" pattern="\d*" min="0" name="otp4" id="otp4" maxlength="1" onkeyup="cekOtp(this,document.getElementById('otp5'));" class="form-control text-center">
                </div>
                <div class="col-2">
                    <input type="text" pattern="\d*" min="0" name="otp5" id="otp5" maxlength="1" onkeyup="cekOtp(this,document.getElementById('otp6'));" class="form-control text-center">
                </div>
                <div class="col-2">
                    <input type="text" pattern="\d*" min="0" name="otp6" id="otp6" maxlength="1" onkeyup="cekOtp(this,this);" class="form-control text-center">
                </div>
            </div>
            <p id="time"></p>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var countDownDate = new Date("<?php echo $_SESSION['exptime']; ?>").getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("time").innerHTML = "kode OTP berlaku sampai " +
                minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("time").innerHTML = "kirim ulang kode OTP <a href='./src/otp_option.php?act=<?php echo $_SESSION['optionotp']; ?>'>kirim ulang</a>";
            }
        }, 1000);


        function cekOtp(textCek, objectFocus) {

            var jumlah = textCek.value.length;
            var idFocus = objectFocus.getAttribute('id');

            if (jumlah == 1) {
                $('#' + idFocus).focus();
            }

            var otp1 = $('#otp1').val();
            var otp2 = $('#otp2').val();
            var otp3 = $('#otp3').val();
            var otp4 = $('#otp4').val();
            var otp5 = $('#otp5').val();
            var otp6 = $('#otp6').val();
            var otpgabungan = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;

            if (otp1 != "" && otp2 != "" && otp3 != "" && otp4 != "" && otp5 != "" && otp6 != "") {

                $.ajax({
                    type: 'POST',
                    url: './src/next_login_act.php',
                    data: {
                        token: '<?php echo $_SESSION['token'] ?>',
                        otpgabungan: otpgabungan,
                    },
                    cache: false,
                    success: function(data) {
                        if (data == "user") {
                            window.location.href = "user/index.php";
                        } else if (data == "admin") {
                            window.location.href = "admin/index.php";
                        } else {
                            $('#msg').html(data);
                        }

                    }
                });

            }
        }
    </script>
</body>

</html>