<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sirohandpos';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// if (mysqli_connect_errno()){
//     echo "Gagal koneksi ke database";
//     exit();
// }else{
//     echo "Berhasil koneksi ke database";
// }

$main_url = 'http://localhost/SIRohand/';
?>