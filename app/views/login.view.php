<!DOCTYPE HTML>
<html>

<head>
	<title>EH Employees System</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="<?= ROOT ?>/assets/css/main.css" />
	<link rel="stylesheet" href="<?= ROOT ?>/css/bootstrap.css" />
	<noscript>
		<link rel="stylesheet" href="<?= ROOT ?>/assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-loading">
	<div id="wrapper">
		<h2 style=" text-align:center; font-size:2em; color:white;">Employees Timesheet System</h2>
		<section id="main" style="min-height: 80vh">
			<img src="<?= ROOT ?>/images/clock.svg" width="102px" alt="" />

			<form class="form-signin" method="post">
				<h2 class="form-signin-heading">Eastern Hill Landscaping</h2>
				<?php if (!empty($errors)) : ?>
					<div class="alert alert-danger">
						<?= implode("<br>", $errors) ?>
					</div>
				<?php endif; ?>
				<hr style="margin: 3em 0;" />
				<label for="inputEmail" class="sr-only">Email</label>
				<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus><br>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
				<br>
				<button class="btn btn-lg btn-outline-primary" type="submit">Login</button>
			</form>
			<hr style="margin: 3em 0;" />


		</section>
		<footer id="footer">
			<ul class="copyright">
				<li>&copy; Walvis Teach</li>
				<li>Design </li>
			</ul>
		</footer>
	</div>
	<script>
		if ('addEventListener' in window) {
			window.addEventListener('load', function() {
				document.body.className = document.body.className.replace(/\bis-loading\b/, '');
			});
			document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
		}
	</script>

</body>

</html>