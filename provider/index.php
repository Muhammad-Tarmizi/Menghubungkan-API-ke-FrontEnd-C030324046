<?php

require_once('./orm/ProviderORM.php');

$listProvider = ProviderORM::order_by_asc('id_provider')->find_many();

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
											<li class="breadcrumb-item"><a href="?page=provider">Modul Provider</a></li>
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
                                            <h5>Data Provider</h5>
                                            <a href="?page=provider/tambah" class="btn btn-primary">Tambah Provider</a>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ID Provider</th>
                                                        <th>Nama Provider</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;">
                                                    <?php if (count($listProvider) > 0): ?>
                                                        <?php $no = 1; foreach ($listProvider as $p): ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo htmlspecialchars((string)$p->id_provider); ?></td>
                                                                <td><?php echo htmlspecialchars((string)$p->nama_provider); ?></td>
                                                                <td>
                                                                    <a href="?page=provider/edit&id=<?php echo urlencode((string)$p->id_provider); ?>" class="btn btn-sm btn-warning">Edit</a>
                                                                    <a href="?page=provider/delete&id=<?php echo urlencode((string)$p->id_provider); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="4" class="text-center">Tidak ada data provider</td>
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

