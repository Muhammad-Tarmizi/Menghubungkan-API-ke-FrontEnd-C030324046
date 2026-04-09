<?php

require_once('./orm/ProviderORM.php');

if (isset($_POST['simpan'])) {
    $nama_provider = trim((string)($_POST['nama_provider'] ?? ''));

    if ($nama_provider === '') {
        echo "<script>alert('Nama provider wajib diisi'); window.location.href='?page=provider/tambah';</script>";
        exit;
    }

    $provider = ProviderORM::create();
    $provider->nama_provider = $nama_provider;

    if ($provider->save()) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=provider';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.location.href='?page=provider';</script>";
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
											<li class="breadcrumb-item"><a href="?page=provider">Modul Provider</a></li>
											<li class="breadcrumb-item"><a href="?page=provider/tambah">Tambah</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Form Provider</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="?page=provider/tambah" method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama_provider">Nama Provider</label>
                                                        <input type="text" class="form-control" id="nama_provider" name="nama_provider" placeholder="Contoh: Telkomsel" required>
                                                    </div>
                                                    <button type="submit" name="simpan" class="btn btn-primary mb-4">Submit</button>
                                                    <a href="?page=provider" class="btn btn-light mb-4">Kembali</a>
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

