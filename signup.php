<?php

session_start();
if (!isset($_SESSION['id']))
{
	header('Location: login.php');
	exit();
}


if (isset($_POST['firstName']))
{
	$session = $_SESSION['id'];
	$fname = $_POST['firstName'];
	$lname = $_POST['lastName'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$deptt = $_POST['department'];
	$result = exec('user_details.py '.$session.' '.$fname.' '.$lname.' '.$email.' '.$contact.' '.$deptt);
	if ($result == '1')
	{	
		echo ("<html>
			<script type = 'text/javascript'>
			alert('Sucessfully updated')
			</script>
			</html>");
		header('Location: ');
	}
	else
	{
		echo ("<html>
        <script type = 'text/javascript'>
        alert('Some error has occured')
        location.replace('login.php');
        </script>
        </html>");
	}
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
                        <span class="icon-bar" style="background-color: #4eb980"></span>
                        <span class="icon-bar" style="background-color: #4eb980"></span>
                        <span class="icon-bar" style="background-color: #4eb980"></span> 
                    </button>

                    <a class="navbar-brand" href="index.html" style="color: #ffffff">
                        Oil and Natural Gas Corporation
                    </a>
                </div
            </div> 	 
        </nav>

		<!-- Main -->
			<div id="main">
				<div class="box alt container">
					<section>
						<header>
							<h3>User Details</h3>
						</header>
						<form method="post" action="#">
							<div class="row">
								<div class="col-6 col-12-mobilep">
									<label for="name">First Name</label>
									<input class="text" type="text" name="firstName" id="firstName" value="" placeholder="Enter your first name" />
								</div>
								<div class="col-6 col-12-mobilep">
									<label for="email">Last Name</label>
									<input class="text" type="text" name="lastName" id="lastName" value="" placeholder="Enter your last name" />
								</div>
                                <div class="col-6 col-12-mobilep">
									<label for="email">Email</label>
									<input class="text" type="text" name="email" id="email" value="" placeholder="Enter yor Email ID" />
                                </div>
                                <div class="col-6 col-12-mobilep">
									<label for="name">Contact Number</label>
									<input class="text" type="text" name="contact" id="contact" value="" placeholder="Enter your Contact Number" />
                                </div>
                                <div class="col-6 col-12-mobilep">
									<label for="name">Department</label>
									<input class="text" type="text" name="department" id="department" value="" placeholder="Enter your Department" />
								</div>
								<div class="col-12">
									<ul class="actions special">
										<li><input type="submit" value="Sign Up" /></li>
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