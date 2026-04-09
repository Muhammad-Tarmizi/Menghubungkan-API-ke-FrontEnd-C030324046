<!DOCTYPE html>
<html lang="en">

<head>

	<?php
	$identitas = parse_ini_file('identitas.txt');
	$nama = isset($identitas['nama']) ? $identitas['nama'] : '';
	$nim = isset($identitas['nim']) ? $identitas['nim'] : '';
	?>
	<title><?php echo htmlspecialchars($nim); ?>-<?php echo htmlspecialchars($nama); ?></title>


	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.svg" type="image/x-icon">
	<!-- fontawesome icon -->
	<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<!-- animation css -->
	<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

	<!-- [ auth-signup ] start -->
	<div class="auth-wrapper">
		<div class="auth-content container">
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="card-body">
							<img src="assets/images/logo-dark.svg" alt="" class="img-fluid mb-4">
							<h4 class="mb-3 f-w-400">Sign up into your account</h4>
							<form id="register-form" novalidate>
								<div class="form-group mb-2">
									<label class="form-label" for="username">Username</label>
									<input id="username" name="username" type="text" class="form-control" placeholder="Masukkan username" autocomplete="username" required>
								</div>
								<div class="form-group mb-2">
									<label class="form-label" for="password">Password</label>
									<input id="password" name="password" type="password" class="form-control" placeholder="Masukkan password" autocomplete="new-password" required>
								</div>
								<div class="form-group mb-2">
									<label class="form-label" for="confirm_password">Konfirmasi Password</label>
									<input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Ulangi password" autocomplete="new-password" required>
								</div>
								<div id="register-alert" class="alert d-none" role="alert"></div>
								<button type="submit" class="btn btn-primary mb-4 btf">Sign up</button>
							</form>
							<p class="mb-2">Already have an account? <a href="login.php" class="f-w-400">Log in</a>
							</p>
						</div>
					</div>
					<div class="col-md-6 d-none d-md-block">
						<img src="assets/images/auth-bg.jpg" alt="" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ auth-signup ] end -->

	<!-- Required Js -->
	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script>
		(function() {
			const form = document.getElementById('register-form');
			const alertBox = document.getElementById('register-alert');
			const button = form.querySelector('button[type="submit"]');

			function showAlert(message, type = 'danger') {
				alertBox.textContent = message;
				alertBox.className = 'alert alert-' + type;
				alertBox.classList.remove('d-none');
			}

			form.addEventListener('submit', async (event) => {
				event.preventDefault();
				alertBox.classList.add('d-none');

				const data = {
					username: document.getElementById('username').value.trim(),
					password: document.getElementById('password').value,
					confirm_password: document.getElementById('confirm_password').value,
				};

				if (!data.username || !data.password || !data.confirm_password) {
					showAlert('Semua field wajib diisi.', 'warning');
					return;
				}

				button.disabled = true;
				button.textContent = 'Processing...';

				try {
					const response = await fetch('api/register.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
						},
						body: JSON.stringify(data),
					});

					const result = await response.json();
					if (response.ok && result.success) {
						showAlert(result.message || 'Registrasi berhasil.', 'success');
						setTimeout(() => {
							window.location.href = 'login.php';
						}, 1200);
						return;
					}

					showAlert(result.message || 'Terjadi kesalahan saat registrasi.', 'danger');
				} catch (error) {
					showAlert('Tidak bisa menghubungi server. Silakan coba lagi.', 'danger');
					console.error(error);
				} finally {
					button.disabled = false;
					button.textContent = 'Sign up';
				}
			});
		})();
	</script>


	<div class="footer-fab">
		<div class="b-bg">
			<i class="fas fa-question"></i>
		</div>
		<div class="fab-hover">
			<ul class="list-unstyled">
				<li><a href="../doc/index-bc-package.html" target="_blank" data-text="UI Kit" class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
				<li><a href="../doc/index.html" target="_blank" data-text="Document" class="btn btn-icon btn-rounded btn-primary m-0"><i class="feather icon feather icon-book"></i></a></li>
			</ul>
		</div>
	</div>


</body>

</html>