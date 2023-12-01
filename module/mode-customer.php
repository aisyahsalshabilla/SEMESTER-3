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

    $sqlCustomer = "INSERT INTO customer VALUES (null, '$nama', '$telpon', '$keterangan', '$alamat')";
    mysqli_query($koneksi, $sqlCustomer);

    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['id']);
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);

    $sqlCustomer = "UPDATE customer SET
                        nama = '$nama',
                        telpon = '$telpon',
                        deskripsi = '$keterangan',
                        alamat = '$alamat'
                        WHERE id_customer = $id
                        ";

    mysqli_query($koneksi, $sqlCustomer);

    return mysqli_affected_rows($koneksi);
}

?>