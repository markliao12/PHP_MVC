<!DOCTYPE HTML>
<html>

<head>
	<meta content='600; url=index.html' http-equiv='refresh'>
	<title>EH Employees System</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="<?= ROOT ?>/assets/css/main.css" />
	<link rel="stylesheet" href="<?= ROOT ?>/css/bootstrap.css" />
	<!--<noscript><link rel="stylesheet" href="<?= ROOT ?>/assets/css/noscript.css" /></noscript>-->
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/jquery.dataTables.min.css" />




</head>

<body class="is-loading" onload="show_date();show_time()">
	<div id="wrapper">

		<section id="main" style="color:black;min-height: 85vh">

			<h2 style=" text-align:center; font-size:2em; color:black;">Eastern Hill Landscaping</h2>
			<form id="clock" runat="server" style="background-color: #495D7A;border-radius: 15px;width: 360px;margin: 0 auto">
				<div id="show_date" style="color:white;font-size: 1.3em;"></div>
				<div id="show_time" style="color:white;font-size: 2.5em; display: inline"></div>
				<div id="show_second" style="color:white;font-size: 1.3em;display: inline"></div>
			</form>
			<hr />
			<div style="text-align: centre;">
				<h4>
					<?php

					if (isset($_SESSION['USER'])) {
						echo "Hello&nbsp;" . $_SESSION['USER']->u_fname;
					}

					?></h4>
				<hr />
				<div class="row">
					<div class="col-sm-12 text-center">
						<a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>">Home</a>

						<a class="btn btn-outline-secondary" href="<?= ROOT ?>/logout">Logout</a>
					</div>
				</div>
			</div>
			<br>
			<div class="table-responsive" style="min-height: 25vh">
				<table id="home" class="table table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">Date</th>
							<th scope="col">Working HRS</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($data['times'])) {
							foreach ($data['times'] as $dt) {
								echo "<tr class='table-primary'>";
								foreach ($dt as $val) {
									echo "<td>" . $val . "</td>";
								}
								echo "</tr>";
							}
						} else {
							echo "<tr class='table-primary'>";
							echo "<td colspan='2'>No Data Available</td>";
							echo "</tr>";
						}
						?>


					</tbody>
				</table>
				<div>

					<hr />

					<div class="row">
						<div class="col-6 text-center">
							Weekly
						</div>
						<div class="col-6 text-center">
							<?php if (!empty($data["total"])) {
								echo "Total HRS: " . $data['total'];
							} else {
								echo "Total HRS: 0.00";
							} ?>
						</div>
					</div>
					<br>
					<div style="text-align: left;">

					</div>


		</section>

		<footer id="footer">
			<ul class="copyright">
				<li>&copy; Walvis Tech</li>
				<li>Design </li>
			</ul>
		</footer>
	</div>

	<!-- Modal_in -->


	<!-- Modal_out -->



	<script>
		if ('addEventListener' in window) {
			window.addEventListener('load', function() {
				document.body.className = document.body.className.replace(/\bis-loading\b/, '');
			});
			document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
		}
	</script>

	<script language="JavaScript">
		function show_time() {
			var NowDate = new Date();
			var h = NowDate.getHours();
			var m = NowDate.getUTCMinutes();
			var s = NowDate.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('show_time').innerHTML = h + ':' + m;
			document.getElementById('show_second').innerHTML = ':' + s;
			setTimeout('show_time()', 1000);
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}

		function show_date() {
			var today = new Date();
			var y = today.getFullYear();
			var m = (today.getMonth() + 1);
			//var m=('0'+(today.getMonth()+1)).slice(-2)
			var d = today.getDate();
			document.getElementById('show_date').innerHTML = y + '-' + m + '-' + d + ' ';
		}
	</script>
	<!-- <script language="javascript">
				　var Today=new Date();
				　document.write(Today.getFullYear()+ "/" + (Today.getMonth()+1) + "/" + Today.getDate());
				</script> -->


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>