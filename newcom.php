<?php
	
	session_start();
    if (!isset($_SESSION['id']))
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Unauthorized access')
        location.replace('login.php');
        </script>
        </html>");
    }

if (isset($_POST['to']))
{
	$to = $_POST['to'];
	$content = $_POST['message'];
	$session = $_SESSION['id'];
	$comp_reg = exec('comp_reg.py '.$session.' '.$to.' '.$content);
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

                        <a class="navbar-brand" href="profile.php" style="color: #ffffff">
                            Oil and Natural Gas Corporation
                        </a>
                    </div>
                    <div class = "collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="newcom.php">Register Complaint</a></li>
                            <li class="active"><a href="checkstatus.php">Status</a></li>
                            <li class="active"><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>   
            </nav>
			
		<!-- Main -->
			<div id="main">
				<div class="box alt container">
					<section>
						<header>
							<h3>Register your Complaint here</h3>
						</header>
						<form method="post" action="#">
							<div class="row">
								<div class="col-6 col-12-mobilep">
									<label for="name">To:</label>
									<input class="text" type="text" name="to" id="to" value="" placeholder="Department Name" />
								</div>
								<div class="col-12">
									<label for="subject">Complaint</label>
									<textarea name="message" id="message" placeholder="Enter your complaint" rows="6"></textarea>
								</div>
								<div class="col-12">
									<ul class="actions special">
										<li><input type="submit" value="Register" /></li>
									</ul>
								</div>
							</div>
						</form>
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