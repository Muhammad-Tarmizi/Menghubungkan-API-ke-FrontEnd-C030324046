<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
	<?php
	require_once __DIR__ . '/../auth.php';
	$u = current_user();
	?>

	<div class="m-header">
		<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
		<a href="index.html" class="b-brand">

			<img src="assets/images/logo.svg" alt="" class="logo images">
			<img src="assets/images/logo-icon.svg" alt="" class="logo-thumb images">
		</a>
	</div>
	<a class="mobile-menu" id="mobile-header" href="#!">
		<i class="feather icon-more-horizontal"></i>
	</a>
	<div class="collapse navbar-collapse">

		<ul class="navbar-nav ms-auto">

			<li>
				<div class="dropdown drp-user">
					<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
						<i class="icon feather icon-settings"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end profile-notification">
						<div class="pro-head">
							<img src="assets/images/user/avatar-1.jpg" class="img-radius"
								alt="User-Profile-Image">
							<span>
								<span class="text-muted"><?php echo htmlspecialchars($u['level'] ?? '-'); ?></span>
								<span class="h6"><?php echo htmlspecialchars($u['username'] ?? '-'); ?></span>
							</span>
						</div>
						<ul class="pro-body">

							<li><a href="logout.php" class="dropdown-item" data-api-logout="1"><i
										class="feather icon-power text-danger"></i> Logout</a></li>
						</ul>
					</div>
				</div>
			</li>
		</ul>
	</div>

</header>
<script>
	(function() {
		function logoutApi(event) {
			const trigger = event.target.closest('[data-api-logout]');
			if (!trigger) {
				return;
			}
			event.preventDefault();

			fetch('api/logout.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
				})
				.then((response) => response.json())
				.then((result) => {
					if (result && result.success) {
						window.location.href = result.redirect || 'login.php';
					} else {
						window.location.href = 'login.php';
					}
				})
				.catch(() => {
					window.location.href = 'login.php';
				});
		}

		document.addEventListener('click', logoutApi);
	})();
</script>