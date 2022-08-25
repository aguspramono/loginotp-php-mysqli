<?php session_start();
if (empty($_SESSION['loginadmin'])) {
    header("location:./login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Login & Register Menggunakan OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">MawebAdmin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="useradmin.php">Users Admin</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Daftar Admin</h1>
                <a href="useradmin.php" class="btn btn-secondary">Data Admin</a>
                <?php echo (!empty($_SESSION['msgerror']) ?  "<div class='alert alert-danger mt-3' role='alert'>" . $_SESSION['msgerror'] . "</div>" : "");
                unset($_SESSION['msgerror']);
                echo (!empty($_SESSION['msgsuccess']) ?  "<div class='alert alert-success mt-3' role='alert'>" . $_SESSION['msgsuccess'] . "</div>" : "");
                unset($_SESSION['msgsuccess']);

                include './src/koneksi.php';
                $query = mysqli_query($koneksi, "select * from tb_users as u inner join tb_privilege as p on(p.kodeUser=u.kodeUser) where u.kodeUser='" . $_GET['token'] . "'");
                $response = mysqli_fetch_array($query);
                ?>
                <form action="./src/edituser_act.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $response['kodeUser'] ?>">
                    <input type="hidden" name="emailtemp" value="<?php echo $response['EmailUser'] ?>">
                    <input type="hidden" name="nopetemp" value="<?php echo $response['NopeUser'] ?>">
                    <div class="mb-3 mt-3">
                        <label for="namalengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="namalengkap" id="namalengkap" value="<?php echo $response['NamaLengkap'] ?>" aria-describedby="namalengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $response['EmailUser'] ?>" aria-describedby="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="nope" class="form-label">No. Handphone</label>
                        <input type="number" class="form-control" name="nope" id="nope" value="<?php echo $response['NopeUser'] ?>" aria-describedby="nope" required>
                    </div>
                    <div class="mb-3">
                        <label for="privilege" class="form-label">Privilege</label>
                        <select name="privilege" id="privilege" class="form-control" required>
                            <option value="admin" <?php ($response['privilege'] == "admin" ? "selected" : ""); ?>>Admin</option>
                            <option value="master admin" <?php ($response['privilege'] == "master admin" ? "selected" : ""); ?>>Master Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah Admin</button>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>