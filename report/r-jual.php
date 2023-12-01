<?php

session_start();

if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/function.php";

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$datajual = getData("SELECT * FROM jual_head WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
</head>
<body>
    <div style="text-align: center;">
        <h2 style="margin-bottom: -15px;">Rekap Laporan Penjualan</h2>
        <h2 style="margin-bottom: 15px;">SIRohand</h2>
    </div>

    <table>
        <thead>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px;",
                    size="3", color="grey", width="150%">
                </td>
            </tr>

            <tr>
                <th>No</th>
                <th style="width: 120px;">Tgl Penjualan</th>
                <th style="width: 120px;">ID Penjualan</th>
                <th style="width: 120px;">Customer</th>
                <th style="width: 120px;">Total Penjualan</th>
                <th style="width: 120px;">Jumlah Bayar</th>
                <th style="width: 120px;">Kembalian</th>
            </tr>

            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin-top: 1px;",
                    size="3", color="grey", width="150%">
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach($datajual as $data){ ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td align="center" ><?= in_date($data['tgl_jual']) ?></td>
                    <td align="center" ><?= $data['no_jual'] ?></td>
                    <td><?= $data['customer'] ?></td>
                    <td align="right" ><?= number_format($data['total'],0,",",".") ?></td>
                    <td align="right" ><?= number_format($data['jml_bayar'],0,",",".") ?></td>
                    <td align="right" ><?= number_format($data['kembalian'],0,",",".") ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin-top: 1px;",
                    size="3", color="grey", width="150%">
                </td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>