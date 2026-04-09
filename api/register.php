<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$rawBody = file_get_contents('php://input');
$payload = json_decode($rawBody, true);

if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request payload']);
    exit;
}

$username = trim((string)($payload['username'] ?? ''));
$password = (string)($payload['password'] ?? '');
$confirmPassword = (string)($payload['confirm_password'] ?? '');

if ($username === '' || $password === '' || $confirmPassword === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Username, password, dan konfirmasi password wajib diisi.']);
    exit;
}

if ($password !== $confirmPassword) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Password dan konfirmasi password tidak sama.']);
    exit;
}

if (strlen($password) < 6) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter.']);
    exit;
}

require_once __DIR__ . '/../orm/UserORM.php';

$exists = UserORM::where('username', $username)->find_one();
if ($exists) {
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'Username sudah digunakan.']);
    exit;
}

$user = UserORM::create();
$user->username = $username;
$user->password = password_hash($password, PASSWORD_DEFAULT);
$user->level = 'petugas';

if ($user->save()) {
    echo json_encode(['success' => true, 'message' => 'Registrasi berhasil. Silakan login.']);
    exit;
}

http_response_code(500);
echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data. Silakan coba lagi.']);
