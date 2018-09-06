<?php

session_start();
if (!isset($_SESSION['role']))
{
	header('Location: login.php');
	exit();
}

$rol = $_SESSION['role'];
if ($rol == '2')
{
    echo ("<html>
	    <script type = 'text/javascript'>
	    location.replace('headprofile.php');
	    </script>
	    </html>");
}

?>



<!DOCTYPE HTML>

<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery Library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>ONGC</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Navbar-->
			<nav class="navbar navbar-light navbar-fixed-top" style="background-color: #a41d23; margin-bottom: 0px; border-radius: 0px">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar" style="background-color: #ffffff"></span>
							<span class="icon-bar" style="background-color: #ffffff"></span>
							<span class="icon-bar" style="background-color: #ffffff"></span> 
						</button>

						<a class="navbar-brand" title="Profile" href="profile.php" style="color: #ffffff;">
                            Oil and Natural Gas Corporation
                        </a>
					</div>
				</div> 	 
			</nav>
			
		<!-- Main -->
			<div id="main">
				<div class="box alt container">
					<section>
						<header style="margin-top: 40px">
							<h3>Your Profile</h3>
						</header>
						<div class="col-12">
                            <ul>
                                <li>
                                	<a href="newcom.php" style="color: #a41d23; border-bottom: 0px">
                                    <button type="button" style="width: 100%; margin-bottom: 30px">
                                        REGISTER YOUR COMPLAINT
                                    </button></a>
                                </li>
                                <li>
                                	<a href="checkstatus.php" style="color: #a41d23; border-bottom: 0px">
                                    <button type="button" style="width: 100%; margin-bottom: 30px">
                                        CHECK STATUS OF YOUR COMPLAINTS
                                    </button></a>
                                </li>
                                <li>
                            	<a href="acomp.php" style="color: #a41d23; border-bottom: 0px">
                                <button type="button" style="width: 100%; margin-bottom: 30px">
                                    VIEW ASSIGNED COMPLAINTS
                                </button></a>
                            </li>
                            </ul>
                        </div>
					</section>
				</div>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>