<?php

require_once('./orm/UserORM.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$user = $id ? UserORM::findOne($id) : null;

if (!$user) {
    echo "<script>alert('User tidak ditemukan'); window.location.href='?page=user';</script>";
    exit;
}

if (isset($_POST['perbaharui'])) {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $level = (string)($_POST['level'] ?? '');

    if ($username === '' || !in_array($level, ['admin', 'petugas'], true)) {
        echo "<script>alert('Username dan level wajib diisi'); window.location.href='?page=user/edit&id=" . urlencode((string)$user->id_user) . "';</script>";
        exit;
    }

    $exists = UserORM::where('username', $username)->where_not_equal('id_user', $user->id_user)->find_one();
    if ($exists) {
        echo "<script>alert('Username sudah digunakan'); window.location.href='?page=user/edit&id=" . urlencode((string)$user->id_user) . "';</script>";
        exit;
    }

    $user->username = $username;
    $user->level = $level;
    if ($password !== '') {
        $user->password = $password;
    }

    if ($user->save()) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='?page=user';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui'); window.location.href='?page=user';</script>";
    }
}

?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5>Home</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="?page=user">Modul User</a></li>
                                            <li class="breadcrumb-item"><a href="?page=user/edit&id=<?php echo urlencode((string)$user->id_user); ?>">Edit</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Edit User</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="?page=user/edit&id=<?php echo urlencode((string)$user->id_user); ?>" method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label">ID User</label>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars((string)$user->id_user); ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="username">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" required value="<?php echo htmlspecialchars((string)$user->username); ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="level">Level</label>
                                                        <select class="form-control" id="level" name="level" required>
                                                            <option value="admin" <?php echo ((string)$user->level === 'admin') ? 'selected' : ''; ?>>admin</option>
                                                            <option value="petugas" <?php echo ((string)$user->level === 'petugas') ? 'selected' : ''; ?>>petugas</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="password">Password (opsional)</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak diganti">
                                                    </div>
                                                    <button type="submit" name="perbaharui" class="btn btn-primary mb-4">Submit</button>
                                                    <a href="?page=user" class="btn btn-light mb-4">Kembali</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->