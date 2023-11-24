<?php
$con = mysqli_connect("localhost", "root", "", "sirohand");

if (mysqli_connect_errno()) {
    echo "Gagal Terkoneksi ke MySQL: " . mysqli_connect_error();
    exit();
}
?>