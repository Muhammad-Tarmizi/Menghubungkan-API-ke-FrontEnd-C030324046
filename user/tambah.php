<?php

require_once('./orm/UserORM.php');

if (isset($_POST['simpan'])) {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $level = (string)($_POST['level'] ?? '');

    if ($username === '' || $password === '' || !in_array($level, ['admin', 'petugas'], true)) {
        echo "<script>alert('Username, password, dan level wajib diisi'); window.location.href='?page=user/tambah';</script>";
        exit;
    }

    $exists = UserORM::where('username', $username)->find_one();
    if ($exists) {
        echo "<script>alert('Username sudah digunakan'); window.location.href='?page=user/tambah';</script>";
        exit;
    }

    $user = UserORM::create();
    $user->username = $username;
    $user->password = $password;
    $user->level = $level;

    if ($user->save()) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=user';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.location.href='?page=user';</script>";
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
                                            <li class="breadcrumb-item"><a href="?page=user/tambah">Tambah</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Form User</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="?page=user/tambah" method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="username">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="level">Level</label>
                                                        <select class="form-control" id="level" name="level" required>
                                                            <option value="">-- pilih level --</option>
                                                            <option value="admin">admin</option>
                                                            <option value="petugas">petugas</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" name="simpan" class="btn btn-primary mb-4">Submit</button>
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