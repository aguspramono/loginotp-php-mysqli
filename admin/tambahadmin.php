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

                                    <form action="./../src/register_act.php" method="post">
                                        <div class="mb-3 mt-3">
                                            <label for="namalengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="namalengkap" id="namalengkap" aria-describedby="namalengkap" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">E-Mail</label>
                                            <input type="email" class="form-control" name="email" id="email" aria-describedby="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nope" class="form-label">No. Handphone</label>
                                            <input type="number" class="form-control" name="nope" id="nope" aria-describedby="nope" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nope" class="form-label">Privilege</label>
                                            <select name="privilege" id="privilege" class="form-control" required>
                                                <option value="admin">Admin</option>
                                                <option value="master admin">Master Admin</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tambah Admin</button>
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