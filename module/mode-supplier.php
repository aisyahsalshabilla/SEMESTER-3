<?php

if(userLogin()['level'] == 3){
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data){
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);

    $sqlSupplier = "INSERT INTO supplier VALUES (null, '$nama', '$telpon', '$keterangan', '$alamat')";
    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['id']);
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);

    $sqlSupplier = "UPDATE supplier SET
                        nama = '$nama',
                        telpon = '$telpon',
                        deskripsi = '$keterangan',
                        alamat = '$alamat'
                        WHERE id_supplier = $id
                        ";

    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);
}

?>