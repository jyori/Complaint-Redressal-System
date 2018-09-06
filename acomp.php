<?php

session_start();
if (!isset($_SESSION['id']))
{
    header('Location: login.php');
    exit();
}
$session = $_SESSION['id'];

function load_comp($sess)
{    
    #echo ($sess);
    $sess = $_SESSION['id'];
    $data = json_decode(exec('user_module.py 5 '.$sess), true);
    if ($data == '4')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Some error has occured, please try reloading the page')
        location.replace('login.php');
        </script>
        </html>");
    }
    foreach($data as &$value)
        {
            #echo ($value);

            list($num,$cpf,$from_deptt,$content,$comp_time,$under_process_on)=explode("#",$value);

            echo "<tr>
             <td>$cpf</td>
             <td>$num
             <div>
                <button type='button' data-toggle='collapse' data-target='#$num'>Complaint</button>
                <div id='$num' class='collapse'>$content</div>
             </div>   
             </td>
             <td>$from_deptt</td>
             <td>$comp_time</td>
             <td>$under_process_on</td>  
         </tr>";
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
							<span class="icon-bar" style="background-color: #ffffff"></span>
							<span class="icon-bar" style="background-color: #ffffff"></span>
							<span class="icon-bar" style="background-color: #ffffff"></span> 
						</button>

						<div class="navbar-brand" href="profile.php" style="color: #ffffff">
                            Oil and Natural Gas Corporation     
                        </div>
					</div>
					<div class = "collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav navbar-right" style="font-size: 16px; margin:0px">
                            <li class="active"><a href="complaint_head.html">Register Complaint</a></li>
                            <li class="active"><a href="status_head.html">Your Complaints</a></li>
                            <li class="dropdown">
                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                        Department
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" style="background-color: #a41d23;">
                                        <li><a href="status_dep.html" style="color: #ffffff">Complaint Status</a></li>
                                        <li><a href="complaint_req.html" style="color: #ffffff">Complaint Requests</a></li>
                                    </ul>
                                </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    {User Name}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: #a41d23;">
                                    <li><a href="#" style="color: #ffffff">Profile</a></li>
                                    <li><a href="logout.php" style="color: #ffffff">Logout</a></li>
                                </ul>
                            </li>
						</ul>
					</div>
				</div> 	 
			</nav>
			
		<!-- Main -->
			<div id="main">
				<div class="box alt container" style="width: 100%; margin: 0; height: 100%">
                        <section>
                                <header>
                                    <h3>Complaint Status</h3>
                                </header>
                                <div class="table-wrapper">
                                    <table class="default">
                                        <thead>
                                            <tr>
                                                <th>CPF Number</th>
                                                <th>Complaint Number</th>
                                                <th>From Department</th>
                                                <th>Created on</th>
                                                <th>Assigned on</th>
                                            </tr>
                                        </thead>
                                        <tbody style = "width:100% height:100%">
                                            <?php load_comp($session); ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
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