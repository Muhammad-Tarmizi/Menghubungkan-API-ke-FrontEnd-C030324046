<?php

require_once('./orm/StokPulsaORM.php');
require_once('./orm/ProviderORM.php');

$providers = ProviderORM::order_by_asc('nama_provider')->find_many();

if (isset($_POST['simpan'])) {
    $nama_produk = trim((string)($_POST['nama_produk'] ?? ''));
    $jumlah = (int)($_POST['jumlah'] ?? 0);
    $keterangan = trim((string)($_POST['keterangan'] ?? ''));
    $harga = (float)($_POST['harga'] ?? 0);
    $id_provider = (int)($_POST['id_provider'] ?? 0);

    if ($nama_produk === '' || $id_provider <= 0) {
        echo "<script>alert('Produk dan provider wajib diisi'); window.location.href='?page=pulsa/tambah';</script>";
        exit;
    }

    $stok = StokPulsaORM::create();
    $stok->nama_produk = $nama_produk;
    $stok->jumlah = $jumlah;
    $stok->keterangan = ($keterangan === '') ? null : $keterangan;
    $stok->harga = $harga;
    $stok->id_provider = $id_provider;

    if ($stok->save()) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=pulsa';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.location.href='?page=pulsa';</script>";
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
											<li class="breadcrumb-item"><a href="?page=pulsa">Modul Stok Pulsa</a></li>
											<li class="breadcrumb-item"><a href="?page=pulsa/tambah">Tambah</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Form Stok Pulsa</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="?page=pulsa/tambah" method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama_produk">Nama Produk</label>
                                                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Contoh: Simpati Voucher Pulsa 50rb" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="id_provider">Provider</label>
                                                        <select class="form-control" id="id_provider" name="id_provider" required>
                                                            <option value="">-- pilih provider --</option>
                                                            <?php foreach ($providers as $p): ?>
                                                                <option value="<?php echo htmlspecialchars((string)$p->id_provider); ?>">
                                                                    <?php echo htmlspecialchars((string)$p->nama_provider); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="jumlah">Jumlah</label>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" value="0" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="keterangan">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Contoh: Bentuk fisik"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="harga">Harga</label>
                                                        <input type="number" class="form-control" id="harga" name="harga" min="0" step="1" value="0" required>
                                                    </div>
                                                    <button type="submit" name="simpan" class="btn btn-primary mb-4">Submit</button>
                                                    <a href="?page=pulsa" class="btn btn-light mb-4">Kembali</a>
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

