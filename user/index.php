<?php

require_once('./orm/UserORM.php');

$listUser = UserORM::order_by_asc('id_user')->find_many();

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
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div style="flex: auto; justify-content: space-between; display: flex; align-items: center;">
                                            <h5>Data User</h5>
                                            <a href="?page=user/tambah" class="btn btn-primary">Tambah User</a>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Level</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;">
                                                    <?php if (count($listUser) > 0): ?>
                                                        <?php $no = 1; foreach ($listUser as $u): ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo htmlspecialchars((string)$u->id_user); ?></td>
                                                                <td><?php echo htmlspecialchars((string)$u->username); ?></td>
                                                                <td><?php echo htmlspecialchars((string)$u->level); ?></td>
                                                                <td>
                                                                    <a href="?page=user/edit&id=<?php echo urlencode((string)$u->id_user); ?>" class="btn btn-sm btn-warning">Edit</a>
                                                                    <a href="?page=user/delete&id=<?php echo urlencode((string)$u->id_user); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">Tidak ada data user</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
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

