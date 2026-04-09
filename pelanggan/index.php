<?php

require_once('./orm/PelangganORM.php');

$listPelanggan = PelangganORM::find_many();

?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-wrapper">
		<div class="pcoded-content">
			<div class="pcoded-inner-content">
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ breadcrumb ] start -->
						<div class="page-header">
							<div class="page-block">
								<div class="row align-items-center">
									<div class="col-md-12">
										<div class="page-header-title">
											<h5>Home</h5>
										</div>
										<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="index.php"><i
														class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="?page=pelanggan">Modul Pelanggan</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- [ breadcrumb ] end -->
						<!-- [ Main Content ] start -->
						<div class="row">
                            <!-- [ basic-table ] start -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div style="flex: auto; justify-content: space-between; display: flex; align-items: center;">
<h5>Data Pelanggan</h5>
<a href="?page=pelanggan/tambah" class="btn btn-primary">Tambah Pelanggan</a>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Telepon</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;">
                                                    <?php if(count($listPelanggan) > 0): ?>
                                                        <?php $no = 1; foreach($listPelanggan as $pelanggan): ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $pelanggan->nama; ?></td>
                                                            <td><?php echo $pelanggan->email; ?></td>
                                                            <td><?php echo $pelanggan->telepon; ?></td>
                                                            <td>
                                                                <a href="?page=pelanggan/edit&id=<?php echo $pelanggan->id; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                                <a href="?page=pelanggan/delete&id=<?php echo $pelanggan->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">Tidak ada data pelanggan</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ basic-table ] end -->
                      
                            
                            <!-- [ Background-Utilities ] start -->

                            <!-- [ Background-Utilities ] end -->
                        </div>

						<!-- [ Main Content ] end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ Main Content ] end -->