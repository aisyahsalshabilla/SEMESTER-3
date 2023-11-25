<?php
require "session.php";
require "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id_kategori WHERE a.id_produk='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori!='$data[kategori_id]'");

$generateRandomString = function($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

</head>

<style>
    form div{
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php"; ?>]

    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" id="nama" class="form-control" autocomplete="off" required> 
                </div>

                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                            while($dataKategori=mysqli_fetch_array($queryKategori)){

                        ?>
                            <option value="<?php echo $dataKategori['id_kategori']; ?>"><?php echo $dataKategori['nama']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']; ?>" required>
                </div>

                <div>
                    <label for="currentFoto">Foto Produk Sekarang</label>
                    <img src="../images/<?php echo $data['foto']; ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto</label> 
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div>
                    <label for="detail">Details</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail']; ?>
                    </textarea>
                </div>

                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php $data['stok']; ?>"><?php echo $data['stok']; ?></option>
                        <?php
                            if($data['stok']=='tersedia'){
                        ?>
                                    <option value="habis">habis</option>
                        <?php
                            }
                            else{
                        ?>
                                    <option value="tersedia">tersedia</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../images/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];

                    $random_name = $generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType; 
                    
                    if($nama=='' || $kategori=='' || $harga==''){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, kategori dan harga wajib diisi
                        </div>
            <?php
                    }
                    else{
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', 
                        nama='$nama', harga='$harga', detail='$detail', stok='$ketersediaan_stok' WHERE id_produk=$id");

                        if($nama_file!=''){
                            if($image_size > 500000){
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 500 Kb
                                </div>
            <?php
                            }
                            else{
                                if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File wajib bertipe jpg atau jpeg atau png atau gif
                                </div>
            <?php
                                }
                                else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                    $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id_produk='$id'");

                                    if($queryUpdate){
            ?>
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Produk Berhasil DiUpdate
                                        </div>

                                        <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                                    }
                                    else{
                                        echo mysqli_error($con);
                                    }
                                }
                            }

                        }
                    }
                }
            ?>

        </div> 
    </div>

    <script src="../bootstrap/js/bootstrap.bundel.min.js"></script>
</body>
</html>