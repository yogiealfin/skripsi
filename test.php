<?php
require_once('includes/init.php');
$query = "SELECT SUM(bobot) AS total_bobot FROM indikator";
$hasil = mysqli_query($koneksi, $query);
$total_bobot = mysqli_fetch_assoc($hasil);
var_dump($total_bobot);
