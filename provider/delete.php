<?php

require_once('./orm/ProviderORM.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$provider = $id ? ProviderORM::findOne($id) : null;

if (!$provider) {
    echo "<script>alert('Provider tidak ditemukan'); window.location.href='?page=provider';</script>";
    exit;
}

try {
    $provider->delete();
    echo "<script>alert('Data berhasil dihapus'); window.location.href='?page=provider';</script>";
} catch (Exception $e) {
    echo "<script>alert('Gagal menghapus data. Pastikan provider tidak dipakai di stok pulsa.'); window.location.href='?page=provider';</script>";
}

