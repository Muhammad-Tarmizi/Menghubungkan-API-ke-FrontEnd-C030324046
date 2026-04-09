<?php

require_once('./orm/StokPulsaORM.php');
require_once('./orm/ProviderORM.php');

// Join provider untuk tampilkan nama_provider
$rows = ORM::for_table('stok_pulsa')
    ->select('stok_pulsa.*')
    ->select('provider.nama_provider', 'nama_provider')
    ->left_outer_join('provider', ['stok_pulsa.id_provider', '=', 'provider.id_provider'])
    ->order_by_asc('stok_pulsa.id_pulsa')
    ->find_array();

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
											<li class="breadcrumb-item"><a href="?page=pulsa">Modul Stok Pulsa</a></li>
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
                                            <h5>Data Stok Pulsa</h5>
                                            <a href="?page=pulsa/tambah" class="btn btn-primary">Tambah Stok</a>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Produk</th>
                                                        <th>Provider</th>
                                                        <th>Jumlah</th>
                                                        <th>Keterangan</th>
                                                        <th>Harga</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;">
                                                    <?php if (count($rows) > 0): ?>
                                                        <?php $no = 1; foreach ($rows as $r): ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo htmlspecialchars((string)($r['nama_produk'] ?? '')); ?></td>
                                                                <td><?php echo htmlspecialchars((string)($r['nama_provider'] ?? '-')); ?></td>
                                                                <td><?php echo htmlspecialchars((string)($r['jumlah'] ?? '0')); ?></td>
                                                                <td><?php echo htmlspecialchars((string)($r['keterangan'] ?? '')); ?></td>
                                                                <td><?php echo htmlspecialchars((string)($r['harga'] ?? '0')); ?></td>
                                                                <td>
                                                                    <a href="?page=pulsa/edit&id=<?php echo urlencode((string)($r['id_pulsa'] ?? '')); ?>" class="btn btn-sm btn-warning">Edit</a>
                                                                    <a href="?page=pulsa/delete&id=<?php echo urlencode((string)($r['id_pulsa'] ?? '')); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center">Tidak ada data stok pulsa</td>
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

