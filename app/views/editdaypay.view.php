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
				<h2 class="form-signin-heading">Update Account</h2>
				<?php if (!empty($errors)) : ?>
					<div class="alert alert-danger">
						<?= implode("<br>", $errors) ?>
					</div>
				<?php endif; ?>
				<hr style="margin: 3em 0;" />
				<label for="fname" class="sr-only">First Name</label>
				<input type="text" name="u_fname" id="fname" class="form-control" value="<?= $data['emp_info']->u_fname ?>" placeholder="First Name" required readonly><br>
				<label for="lname" class="sr-only">Last Name</label>
				<input type="text" name="u_lname" id="lname" class="form-control" value="<?= $data['emp_info']->u_lname ?>" placeholder="Last Name" required readonly><br>
				<label for="sta-select" class="sr-only">Choose a status:</label>
				<select name="u_status" id="sta-select" class="form-control" required readonly>
					<option value="">--Please choose an option--</option>
					<?php foreach ($data['estatus'] as $dts) {
						if ($dts->s_id == $data['emp_info']->u_status) {
							echo "<option selected value='" . $dts->s_id . "'>" . $dts->s_name . "</option>";
						} else {
							echo "<option value='" . $dts->s_id . "'>" . $dts->s_name . "</option>";
						}
					} ?>
				</select><br>
				<label for="inputEmail" class="sr-only">Email</label>
				<input type="email" name="email" id="inputEmail" class="form-control" value="<?= $data['emp_info']->email ?>" placeholder="Email" required readonly><br>

				<label for="u_reg_pay" class="form-group">Regular Pay Rate</label>
				<input type="text" name="u_reg_pay" id="u_reg_pay" class="form-control" value="<?= $data['emp_info']->u_reg_pay ?>" placeholder="Regular Pay Rate" required autofocus><br>
				<label for="u_pay" class="form-group">Regular Pay Rate</label>
				<input type="text" name="u_pay" id="u_pay" class="form-control" value="<?= $data['emp_info']->u_pay ?>" placeholder="Bonus Pay Rate" required><br>
				<label for="u_base_hrs" class="form-group">Base Hours</label>
				<input type="text" name="u_base_hrs" id="u_base_hrs" class="form-control" value="<?= $data['emp_info']->u_base_hrs ?>" placeholder="Base Hours" required><br>
				<button class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
			</form>
			<hr style="margin: 3em 0;" />
			<a class="btn btn-lg btn-outline-primary" aria-current="page" href="<?= ROOT ?>/editinfo">Back</a>

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