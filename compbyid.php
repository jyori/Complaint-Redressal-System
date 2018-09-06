<?php
	session_start();
	$sess_id = $_SESSION['id'];


function value($sess_id)
{
	if (isset($_POST['comp_num']))
	{
		$data = json_decode(exec('super_user.py 4 '.$sess_id.' '.$_POST['comp_num']), true);

		foreach($data as &$value)
	        {

	            #echo ($value);

	            list($num,$cpf,$from_deptt,$for_deptt,$content,$comp_time,$approved_on,$under_process_on,$resolved_on) = explode("#",$value);

				echo "<tr>
		            <th>$cpf</th>
		            <td>$num
		                <div>
		                   <button type='button' data-toggle='collapse' data-target='#$num'>Complaint</button>
		                   <div id='$num' class='collapse'>$content</div>
		                </div>   
		            </td>
		            <th>$from_deptt</th>
		            <th>$for_deptt</th>
		            <th>$comp_time</th>
		            <th>$approved_on</th>
		            <th>$under_process_on</th>
		            <th>$resolved_on</th>
		        </tr>";



	        }
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
    
                        <a class="navbar-brand" href="profile_super.html" style="color: #ffffff">
                            Oil and Natural Gas Corporation     
                        </a>
                    </div>
                    <div class = "collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right" style="font-size: 16px; margin:0px">
                            <li class="active"><a href="newcom.php">Register Complaint</a></li>
                            <li class="active"><a href="checkstatus.php">Your Complaints</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    More Options
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: #a41d23;">
                                    <li><a href="remove_user.html" style="color: #ffffff">Remove User</a></li>
                                    <li><a href="remove_complaint.html" style="color: #ffffff">Remove Complaint</a></li>
                                    <li><a href="view_complaint.html" style="color: #ffffff">View Complaints</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </div> 	 
            </nav>
			
		<!-- Main -->
			<div id="main">
				<div class="box alt container" style="margin: 0%; width: 100%; height: 100%;">
                        <section>
                                <header>
                                    <h3>View Complaints Using CPF Number</h3>
                                </header>
                                <div class="table-wrapper">
                                	<form method = "POST" action "compbyid.php">
                                    <input type="text" id="myInput" name = "comp_num" title="Type in a CPF Number" placeholder = 
                                    "ID to be searched">
                                </form>
                                    <table id="myTable" class="default">
                                        <thead>
                                            <tr>
                                                <th>CPF Number</th>
                                                <th>Complaint Number</th>
                                                <th>From Department</th>
                                                <th>To Department</th>
                                                <th>Created on date</th>
                                                <th>Approved on date</th>
                                                <th>Under Process on date</th>
                                                <th>Resolved on date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php value($sess_id) ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
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