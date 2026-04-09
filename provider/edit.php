<?php

require_once('./orm/ProviderORM.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$provider = $id ? ProviderORM::findOne($id) : null;

if (!$provider) {
    echo "<script>alert('Provider tidak ditemukan'); window.location.href='?page=provider';</script>";
    exit;
}

if (isset($_POST['perbaharui'])) {
    $nama_provider = trim((string)($_POST['nama_provider'] ?? ''));

    if ($nama_provider === '') {
        echo "<script>alert('Nama provider wajib diisi'); window.location.href='?page=provider/edit&id=" . urlencode((string)$provider->id_provider) . "';</script>";
        exit;
    }

    $provider->nama_provider = $nama_provider;
    if ($provider->save()) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='?page=provider';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui'); window.location.href='?page=provider';</script>";
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
											<li class="breadcrumb-item"><a href="?page=provider/edit&id=<?php echo urlencode((string)$provider->id_provider); ?>">Edit</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Edit Provider</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="?page=provider/edit&id=<?php echo urlencode((string)$provider->id_provider); ?>" method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label">ID Provider</label>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars((string)$provider->id_provider); ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama_provider">Nama Provider</label>
                                                        <input type="text" class="form-control" id="nama_provider" name="nama_provider" required value="<?php echo htmlspecialchars((string)$provider->nama_provider); ?>">
                                                    </div>
                                                    <button type="submit" name="perbaharui" class="btn btn-primary mb-4">Submit</button>
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

