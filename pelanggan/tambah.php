<?php

require_once('./orm/PelangganORM.php');

if (isset($_POST['simpan'])) {

    $pelanggan = PelangganORM::create();
    $post = (object) $_POST;

    $pelanggan->nama = $post->nama;
    $pelanggan->email = $post->email;   
    $pelanggan->alamat = $post->alamat;
    $pelanggan->telepon = $post->telepon;

     if ($pelanggan->save()) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=pelanggan';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.location.href='?page=pelanggan';</script>";
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
                            <!-- [ basic-form ] start -->
                            <div class="col-md-12">
                                
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Form Pelanggan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="?page=pelanggan/tambah" method="POST" onsubmit="return validateForm()">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="alamat">Alamat</label>
                                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Enter alamat" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="telepon">Telepon</label>
                                                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Enter telepon" required>
                                                    </div>
                                                    <button type="submit" name="simpan" class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                function validateForm() {
                                                    const nama = document.getElementById('nama').value.trim();
                                                    const alamat = document.getElementById('alamat').value.trim();
                                                    const email = document.getElementById('email').value.trim();
                                                    const telepon = document.getElementById('telepon').value.trim();

                                                    if (!nama || !alamat || !email || !telepon) {
                                                        alert('Semua field harus diisi');
                                                        return false;
                                                    }

                                                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                                                        alert('Email tidak valid');
                                                        return false;
                                                    }

                                                    if (!/^\d+$/.test(telepon)) {
                                                        alert('Telepon hanya boleh angka');
                                                        return false;
                                                    }

                                                    return true;
                                                }
                                                </script>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- [ basic-form] end -->
                      
                            
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