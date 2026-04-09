<?php

require_once('./orm/StokPulsaORM.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$stok = $id ? StokPulsaORM::findOne($id) : null;

if (!$stok) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='?page=pulsa';</script>";
    exit;
}

$stok->delete();
echo "<script>alert('Data berhasil dihapus'); window.location.href='?page=pulsa';</script>";

