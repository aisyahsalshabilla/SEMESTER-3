<?php

function generateNo(){
    global $koneksi;

    $queryNo = mysqli_query($koneksi, "SELECT max(no_beli) as maxno FROM head_beli");
    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row["maxno"];

    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;
    $maxno = 'PB' . sprintf("%04s", $noUrut);

    return $maxno;
}

function totalBeli($noBeli){
    global $koneksi;

    $totalBeli = mysqli_query($koneksi, "SELECT sum(jml_harga) AS total FROM beli_detail 
    WHERE no_beli = '$noBeli'");
    $data = mysqli_fetch_assoc($totalBeli);
    $total = $data["total"];

    return $total;
}

function insert($data){
    global $koneksi;

    $no = mysqli_real_escape_string($koneksi, $data['nobeli']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $kode = mysqli_real_escape_string($koneksi, $data['kodeBrg']);
    $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
    $qty = mysqli_real_escape_string($koneksi, $data['qty']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $jmlharga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);

    $cekBrg = mysqli_query($koneksi, "SELECT * FROM beli_detail WHERE no_beli = '$no'
    AND kode_brg = '$kode'");
    if(mysqli_num_rows($cekBrg)){
        echo "<script>
                alert('Barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty nya');
            </script>";
            return false;
    }

    if(empty($qty)){
        echo "<script>
                alert('Qty barang tidak boleh kosong');
            </script>";
            return false;
    } else{
        $sqlbeli = "INSERT INTO beli_detail VALUES (null, '$no', '$tgl' , 
        '$kode', '$nama', $qty, $harga, $jmlharga )";
        mysqli_query($koneksi, $sqlbeli);
    }

    mysqli_query($koneksi, "UPDATE barang SET stock = stock + $qty WHERE id_barang
    = '$kode'");

    return mysqli_affected_rows($koneksi);
}


function delete($idbrg, $idbeli, $qty){
    global $koneksi;

    $sqlDel = "DELETE FROM beli_detail WHERE kode_brg = '$idbrg' AND no_beli =
    '$idbeli'";
    mysqli_query($koneksi, $sqlDel);

    mysqli_query($koneksi, "UPDATE barang SET stock = stock - $qty WHERE id_barang
    = '$idbrg'");

    return mysqli_affected_rows($koneksi);
}

function simpan($data){
    global $koneksi;

    $nobeli = mysqli_real_escape_string($koneksi, $data['nobeli']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $suplier = mysqli_real_escape_string($koneksi, $data['suplier']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlbeli = "INSERT INTO head_beli VALUES ('$nobeli', '$tgl', '$suplier', '$total', '$keterangan')";
    mysqli_query($koneksi, $sqlbeli);

    return mysqli_affected_rows($koneksi);
}
?>