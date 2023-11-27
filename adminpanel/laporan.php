<?php
require "session.php";
require "koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration{
        text-decoration: none;
    }
</style>
<body>
    <?php require"navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Laporan
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Laporan</h3>

            <form action="" method="post">
                <div>
                    <label for="laporan">Laporan</label>
                    <input type="text" id="laporan" name="laporan" placeholder="input nama laporan" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_laporan">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan_laporan'])){
                    $laporan = htmlspecialchars($_POST['laporan']);

                    $queryExist = mysqli_query($con, "SELECT nama FROM laporan WHERE nama='$laporan'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if($jumlahDataKategoriBaru > 0){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori Sudah Ada
                        </div>
                        <?php
                    }
                    else{
                        $querySimpan = mysqli_query($con, "INSERT INTO laporan (nama) VALUES ('$laporan')");
                        
                        if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Laporan Berhasil Disimpan
                            </div>

                            <meta http-equiv="refresh" content="1; url=kategori.php" />
                            <?php
                            
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Laporan</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahLaporan==0){
                        ?>
                            <tr>
                                <td colspan=3 class="text-center">Data laporan tidak ditemukan</td>
                            </tr>
                        <?php
                            }
                            else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($queryLaporan)){
                        ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td> 
                                        <td>
                                            <a href="laporan-detail.php?id=<?php echo $data['id_laporan']; ?>" class="btn btn-info">
                                            <i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>

                        <?php
                                $jumlah++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="../bootstrap/js/bootstrap.bundel.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>

</body>
</html>
