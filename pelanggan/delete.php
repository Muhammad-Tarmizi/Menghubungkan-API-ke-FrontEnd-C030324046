<?php
require_once('./orm/PelangganORM.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

$pelanggan = PelangganORM::findOne($id);
$pelanggan->delete();
echo "<script>alert('Data berhasil dihapus'); window.location.href='?page=pelanggan';</script>";

?>