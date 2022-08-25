<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login & Signup Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>

        <div class="form-container">
            <div id="msg" style="text-align:center;"></div>
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>

            </div>


            <div class="form-inner">
                <form action="#" class="login">
                    <div class="field">
                        <input type="text" id="logid" placeholder="E-Mail / No. Handphone" required>
                    </div>
                    <div class="field btnn">

                        <div class="btn-layer"></div>

                        <input type="submit" value="Login" onclick="logIn();">

                    </div>

                    <div class="signup-link">Not a member? <a href="">Signup now</a></div>

                </form>
                <form action="#" class="signup">
                    <div class="field">
                        <input type="text" placeholder="Nama Lengkap" id="namalengkap" required>
                    </div>
                    <div class="field">
                        <input type="email" placeholder="Email" id="email" required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="No.Handphone" id="nope" required>
                    </div>
                    <div class="field btnn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup" onclick="signUp();">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function signUp() {
            event.preventDefault();
            var namalengkap = $('#namalengkap').val();
            var email = $('#email').val();
            var nope = $('#nope').val();

            if (namalengkap == '') {
                $('#msg').html("<div class='alert alert-danger mt-3'>Harap isi nama lengkap</div>");
                return;
            }

            if (validateEmail(email)) {} else {
                $('#msg').html("<div class='alert alert-danger mt-3'>Email tidak valid</div>");
                return;
            }

            if (nope == '') {
                $('#msg').html("<div class='alert alert-danger mt-3'>No.Handphone tidak boleh kosong</div>");
                return;
            }

            $('#msg').html("<img src='./src/img/loading.gif' style='width:30px;'>");

            $.ajax({
                type: 'POST',
                url: './src/register_act.php',
                data: {
                    namalengkap: namalengkap,
                    email: email,
                    nope: nope,
                },
                cache: false,
                success: function(data) {
                    var response = data.split("^");
                    if (response[0] == 'error') {
                        $('#msg').html("<div class='alert alert-danger mt-3'>" + response[1] + "</div>");
                    } else {
                        $('#msg').html("<div class='alert alert-success mt-3'>" + response[1] + "</div>");
                    }
                }
            });

        }

        function logIn() {
            event.preventDefault();
            var logid = $('#logid').val();
            $('#msg').html("<img src='./src/img/loading.gif' style='width:30px;'>");
            $.ajax({
                type: 'POST',
                url: './src/login_act.php',
                data: {
                    logid: logid,
                },
                cache: false,
                success: function(data) {
                    var response = data.split('^');
                    if (response[0] === 'error') {
                        $('#msg').html("<div class='alert alert-danger mt-3'>" + response[1] + "</div>");
                    } else {
                        window.location.href = "otp_form.php";
                    }
                }
            });
        }
    </script>

</body>

</html>