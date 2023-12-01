<?php

session_start();

if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-supplier.php";

$id = $_GET['id'];

if(deleteSupplier($id)){
    echo "
        <script>document.location.href = 'data-supplier.php?masg=deleted';</script>
    ";
} else {
    echo "
        <script>document.location.href = 'data-supplier.php?masg=aborted';</script>
    ";
}

?>