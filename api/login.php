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

if ($username === '' || $password === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Username dan password wajib diisi.']);
    exit;
}

require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../orm/UserORM.php';

$user = UserORM::where('username', $username)->find_one();
if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Username atau password salah.']);
    exit;
}

$stored = (string)($user->password ?? '');
$ok = false;

if ($stored !== '' && $stored === $password) {
    $ok = true;
    $user->password = password_hash($password, PASSWORD_DEFAULT);
    $user->save();
} elseif ($stored !== '' && password_verify($password, $stored)) {
    $ok = true;
}

if (!$ok) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Username atau password salah.']);
    exit;
}

$_SESSION['user'] = [
    'id_user' => $user->id_user,
    'username' => $user->username,
    'level' => $user->level,
];

echo json_encode(['success' => true, 'message' => 'Login berhasil.', 'redirect' => 'index.php']);
