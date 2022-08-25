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
                                    <h3 class="card-title"><a href="tambahadmin.php" class="btn btn-primary">Tambah Admin</a></h3>
                                </div>

                                <div class="card-body table-responsive" style="height: 500px;">
                                    <?php echo (!empty($_SESSION['msgerror']) ?  "<div class='alert alert-danger mt-3' role='alert'>" . $_SESSION['msgerror'] . "</div>" : "");
                                    unset($_SESSION['msgerror']);
                                    echo (!empty($_SESSION['msgsuccess']) ?  "<div class='alert alert-success mt-3' role='alert'>" . $_SESSION['msgsuccess'] . "</div>" : "");
                                    unset($_SESSION['msgsuccess']);
                                    ?>
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No.Handphone</th>
                                                <th>Privilege</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include './../src/koneksi.php';
                                            $no = 1;
                                            $query = mysqli_query($koneksi, "select * from tb_users as u inner join tb_privilege as p on(p.kodeUser=u.kodeUser) where p.privilege like '%admin%'");
                                            while ($respone = mysqli_fetch_array($query)) { ?>
                                                <tr>
                                                    <th><?php echo $no++; ?></th>
                                                    <td><?php echo $respone['NamaLengkap'] ?></td>
                                                    <td><?php echo $respone['EmailUser'] ?></td>
                                                    <td><?php echo $respone['NopeUser'] ?></td>
                                                    <td><?php echo $respone['privilege'] ?></td>
                                                    <td><a href="editadmin.php?token=<?php echo $respone['kodeUser']; ?>" class="btn btn-sm btn-info">edit</a> <a href="./../src/delete_act.php?token=<?php echo $respone['kodeUser']; ?>" onclick="return confirm('Yakin ingin hapus data?')" class="btn btn-danger btn-sm">hapus</a></td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
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