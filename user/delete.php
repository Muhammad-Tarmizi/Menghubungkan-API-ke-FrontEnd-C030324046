<?php

require_once('./orm/UserORM.php');
require_once('./auth.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$user = $id ? UserORM::findOne($id) : null;

if (!$user) {
    echo "<script>alert('User tidak ditemukan'); window.location.href='?page=user';</script>";
    exit;
}

$me = current_user();
if ($me && (string)$me['id_user'] === (string)$user->id_user) {
    echo "<script>alert('Tidak bisa menghapus user yang sedang login'); window.location.href='?page=user';</script>";
    exit;
}

$user->delete();
echo "<script>alert('Data berhasil dihapus'); window.location.href='?page=user';</script>";

