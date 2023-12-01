<?php

session_start();

if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-supplier.php";

$title = "Edit Supplier - SIRohand";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

//jalankan fungsi update data
if (isset($_POST['update'])){
    if(update($_POST)){
        echo "<script>
                document.location.href = 'data-supplier.php?msg=updated';
            </script>";
    }
}


$id = $_GET['id'];

$sqlEdit = "SELECT * FROM supplier WHERE id_supplier = $id";
$supplier = getData($sqlEdit)[0];

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url ?>supplier/data-supplier.php">Supplier</a></li>
              <li class="breadcrumb-item active">Edit Supplier</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-plus fa-sm"></i>Edit Supplier</h3>
                    <button type="submit" name="update" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-save"></i>Update</button>
                    <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i>Reset</button>
                </div>

                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" value="<?= $supplier['id_supplier'] ?>">
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" 
                                placeholder="nama supplier" autofocus value="<?= $supplier['nama'] ?>"  required>
                            </div>

                            <div class="form-group">
                                <label for="telpon">Telpon</label>
                                <input type="text" name="telpon" class="form-control" id="telpon" 
                                placeholder="nomor telepon supplier"pattern="[0-9]{5, }" 
                                title="minimal 5 angka" value="<?= $supplier['telpon'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Deskripsi</label>
                                <textarea type="text" name="keterangan" class="form-control" id="keterangan" 
                                placeholder="keterangan supplier" rows="1" required><?= $supplier['deskripsi'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" name="alamat" class="form-control" id="alamat" 
                                placeholder="alamat supplier" rows="3" required><?= $supplier['alamat'] ?></textarea>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php

require "../template/footer.php";

?>