<?php

if(userLogin()['level'] == 3){
    header("location:" . $main_url . "error-page.php");
    exit();
}

function generateId(){
    global $koneksi;

    $queryId = mysqli_query($koneksi, "SELECT max(id_barang) as maxid FROM barang");
    $data = mysqli_fetch_array($queryId);
    $maxid = $data['maxid'];

    $noUrut = (int) substr($maxid, 4, 3);
    $noUrut++;
    $maxid = "BRG-" . sprintf("%03s", $noUrut);

    return $maxid;
}

function insert($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['kode']);
    $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
    $stockmin = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

    $cekBarcode = mysqli_query($koneksi, "SELECT * FROM barang WHERE barcode = $barcode");
    if(mysqli_num_rows($cekBarcode)){
        echo '<script>alert("Kode barcode sudah ada, barang gagal ditambahkan")</script>';
        return false;
    }

    //upload gambar barang
    if($gambar != null){
        $gambar = uploadimg(null, $id);
    } else{
        $gambar = 'barang.png';
    }

    //gambar tidak sesuai validasi
    if($gambar == ''){
        return false;
    }

    $sqlBrg = "INSERT INTO barang VALUE ('$id', '$barcode', '$name', 
    '$harga_beli', '$harga_jual', 0, '$satuan', '$stockmin', '$gambar')";
    mysqli_query($koneksi, $sqlBrg);

    if (mysqli_errno($koneksi)) {
        echo "Gagal mengeksekusi query: " . mysqli_error($koneksi);
        return false;
    }

    return mysqli_affected_rows($koneksi);

}

function deleteBarang($id, $gbr){
    global $koneksi;

    $sqlDel = "DELETE FROM barang WHERE id_barang = '$id'";
    mysqli_query($koneksi, $sqlDel);
    if($gbr != 'barang.png'){
        @unlink('../asset/image/'. $gbr);
    }

    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['kode']);
    $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $name = mysqli_real_escape_string($koneksi, $data['name']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
    $stockmin = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
    $gbrLama = isset($_FILES['oldImg']['name']) ? mysqli_real_escape_string($koneksi, $_FILES['oldImg']['name']) : '';
    //$gbrLama = mysqli_real_escape_string($koneksi, $_FILES['oldImg']['name']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

    //barcode lama
    $queryBarcode = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id'");
    $dataBrg = mysqli_fetch_assoc($queryBarcode);
    $curBarcode = $dataBrg['barcode'];


    //barcode baru
    $cekBarcode = mysqli_query($koneksi, "SELECT * FROM barang WHERE barcode = '$barcode'");

    //jika barcode diganti
    if($barcode !== $curBarcode){
        //jika barcode sudah ada
        if(mysqli_num_rows($cekBarcode)){
        echo '<script>alert("Kode barcode sudah ada, barang gagal diperbarui")</script>';
        return false;
        }
    }

    //cek gambar
    if($gambar != null){
        $url = "index.php";
        if($gbrLama == 'barang.png'){
            $nmgbr = $id;
        } else {
            $nmgbr = $id . '-'. rand(10, 1000);
        }
        $imgBrg = uploadimg($url, $nmgbr);
        if($gbrLama != 'barang.png'){
            @unlink('../asset/image/.$gbrLama');
        }
    } else{
        $imgBrg = $gbrLama;
    }

    mysqli_query($koneksi, "UPDATE barang SET
                                barcode = '$barcode',
                                nama_barang = '$name',
                                harga_beli = $harga_beli,
                                harga_jual = $harga_jual,
                                satuan = '$satuan',
                                stock_minimal = $stockmin,
                                gambar = '$imgBrg'
                            WHERE id_barang = '$id'
                            ");

    return mysqli_affected_rows($koneksi);
}
?>
