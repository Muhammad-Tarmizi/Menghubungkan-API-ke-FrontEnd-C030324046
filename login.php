<!DOCTYPE html>
<html lang="en">

<head>

	<?php
	require_once __DIR__ . '/auth.php';
	require_once __DIR__ . '/orm/UserORM.php';

	$identitas = parse_ini_file('identitas.txt');
	$nama = isset($identitas['nama']) ? $identitas['nama'] : '';
	$nim = isset($identitas['nim']) ? $identitas['nim'] : '';

	if (is_logged_in()) {
		header('Location: index.php');
		exit;
	}

	$error = null;
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$username = trim((string)($_POST['username'] ?? ''));
		$password = (string)($_POST['password'] ?? '');

		if ($username === '' || $password === '') {
			$error = 'Username dan password wajib diisi.';
		} else {
			$user = UserORM::where('username', $username)->find_one();
			if (!$user) {
				$error = 'Username atau password salah.';
			} else {
				$stored = (string)($user->password ?? '');
				$ok = false;

				// Support DB lama yang masih plaintext (contoh: passadmin)
				if ($stored !== '' && $stored === $password) {
					$ok = true;
					$user->password = password_hash($password, PASSWORD_DEFAULT);
					$user->save();
				} elseif ($stored !== '' && password_verify($password, $stored)) {
					$ok = true;
				}

				if ($ok) {
					$_SESSION['user'] = [
						'id_user' => $user->id_user,
						'username' => $user->username,
						'level' => $user->level,
					];
					header('Location: index.php');
					exit;
				}

				$error = 'Username atau password salah.';
			}
		}
	}
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

	<!-- [ auth-signin ] start -->
	<div class="auth-wrapper">
		<div class="auth-content container">
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="card-body">
							<img src="assets/images/logo-dark.svg" alt="" class="img-fluid mb-4">
							<h4 class="mb-3 f-w-400">Login into your account</h4>
							<?php if ($error): ?>
								<div class="alert alert-danger" role="alert">
									<?php echo htmlspecialchars($error); ?>
								</div>
							<?php endif; ?> <div id="login-alert" class="alert d-none" role="alert"></div>
							<form id="login-form" method="POST" action="login.php">
								<div class="form-group mb-2">
									<label class="form-label">Username</label>
									<input name="username" type="text" class="form-control" placeholder="admin / petugas" autocomplete="username" required>
								</div>
								<div class="form-group mb-3">
									<label class="form-label">Password</label>
									<input name="password" type="password" class="form-control" placeholder="Masukkan password" autocomplete="current-password" required>
								</div>

								<button type="submit" class="btn btn-primary mb-4 btf">Login</button>
							</form>

							<p class="mb-0 text-muted">Don’t have an account? <a href="register.php"
									class="f-w-400">Signup</a></p>
						</div>
					</div>
					<div class="col-md-6 d-none d-md-block">
						<img src="assets/images/auth-bg.jpg" alt="" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ auth-signin ] end -->

	<!-- Required Js -->
	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script>
		(function() {
			const form = document.getElementById('login-form');
			const alertBox = document.getElementById('login-alert');
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
					username: document.querySelector('#login-form [name="username"]').value.trim(),
					password: document.querySelector('#login-form [name="password"]').value,
				};

				if (!data.username || !data.password) {
					showAlert('Username dan password wajib diisi.', 'warning');
					return;
				}

				button.disabled = true;
				button.textContent = 'Processing...';

				try {
					const response = await fetch('api/login.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
						},
						body: JSON.stringify(data),
					});

					const result = await response.json();
					if (response.ok && result.success) {
						showAlert(result.message || 'Login berhasil.', 'success');
						window.location.href = result.redirect || 'index.php';
						return;
					}

					showAlert(result.message || 'Username atau password salah.', 'danger');
				} catch (error) {
					showAlert('Tidak bisa menghubungi server. Silakan coba lagi.', 'danger');
					console.error(error);
				} finally {
					button.disabled = false;
					button.textContent = 'Login';
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