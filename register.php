<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-lg-6 col-sm-12">

            <?php
            echo (!empty($_SESSION['msgerror']) ?  "<div class='alert alert-danger' role='alert'>" . $_SESSION['msgerror'] . "</div>" : "");
            unset($_SESSION['msgerror']);
            echo (!empty($_SESSION['msgsuccess']) ?  "<div class='alert alert-success' role='alert'>" . $_SESSION['msgsuccess'] . "</div>" : "");
            unset($_SESSION['msgsuccess']); ?>


            <form action="./src/register_act.php" method="post">
                <h2>Register</h2>
                <div class="mb-3 mt-3">
                    <label for="namalengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="namalengkap" id="namalengkap" aria-describedby="namalengkap" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" required>
                </div>
                <div class="mb-1">
                    <label for="nope" class="form-label">No. Handphone</label>
                    <input type="number" class="form-control" name="nope" id="nope" aria-describedby="nope" required>
                </div>
                <div class="mb-3">
                    <span>Sudah punya akun? <a href="login.php">masuk disini!</a></span>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>