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
                <a href="tambahadmin.php" class="btn btn-primary">Tambah Admin</a>
                <?php echo (!empty($_SESSION['msgerror']) ?  "<div class='alert alert-danger mt-3' role='alert'>" . $_SESSION['msgerror'] . "</div>" : "");
                unset($_SESSION['msgerror']);
                echo (!empty($_SESSION['msgsuccess']) ?  "<div class='alert alert-success mt-3' role='alert'>" . $_SESSION['msgsuccess'] . "</div>" : "");
                unset($_SESSION['msgsuccess']);
                ?>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No.Handphone</th>
                            <th scope="col">Privilege</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include './src/koneksi.php';
                        $no = 1;
                        $query = mysqli_query($koneksi, "select * from tb_users as u inner join tb_privilege as p on(p.kodeUser=u.kodeUser) where p.privilege like '%admin%'");
                        while ($respone = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <th><?php echo $no++; ?></th>
                                <td><?php echo $respone['NamaLengkap'] ?></td>
                                <td><?php echo $respone['EmailUser'] ?></td>
                                <td><?php echo $respone['NopeUser'] ?></td>
                                <td><?php echo $respone['privilege'] ?></td>
                                <td><a href="editadmin.php?token=<?php echo $respone['kodeUser']; ?>" class="btn btn-sm btn-info">edit</a> <a href="./src/delete_act.php?token=<?php echo $respone['kodeUser']; ?>" onclick="return confirm('Yakin ingin hapus data?')" class="btn btn-danger btn-sm">hapus</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>