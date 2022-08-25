<?php include "./header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><a href="admin.php" class="btn btn-secondary">Data Admin</a></h3>
                                </div>

                                <div class="card-body">
                                    <?php echo (!empty($_SESSION['msgerror']) ?  "<div class='alert alert-danger mt-3' role='alert'>" . $_SESSION['msgerror'] . "</div>" : "");
                                    unset($_SESSION['msgerror']);
                                    echo (!empty($_SESSION['msgsuccess']) ?  "<div class='alert alert-success mt-3' role='alert'>" . $_SESSION['msgsuccess'] . "</div>" : "");
                                    unset($_SESSION['msgsuccess']);


                                    ?>

                                    <?php
                                    include './../src/koneksi.php';
                                    $query = mysqli_query($koneksi, "select * from tb_users as u inner join tb_privilege as p on(p.kodeUser=u.kodeUser) where u.kodeUser='" . $_GET['token'] . "'");
                                    $response = mysqli_fetch_array($query);
                                    ?>

                                    <form action="./../src/edituser_act.php" method="post">
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
                    </div>

                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php include "./footer.php"; ?>