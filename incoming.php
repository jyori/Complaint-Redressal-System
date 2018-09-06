<?php

session_start();
if (!isset($_SESSION['id']))
{
    header('Location: login.php');
    exit();
}
$session = $_SESSION['id'];
#echo ($session);

if (isset($_POST['comp_num']))
{
    #echo ("aisxgu");
    $var = $_POST[$_POST['assign_name']];
    $result = exec('head.py 6 '.$session.' '.$_POST['comp_num'].' '.$_POST[$_POST['assign_name']]);
        echo ($result);
        if ($result == '2')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Complaint assigned')
        </script>
        </html>");

    }
    else if ($result == '4')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Some error has occured.')
        </script>
        </html>");
    }

    else if ($result == '7')
            {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Please assign cpf from your own department')
        </script>
        </html>");
    }

        else if ($result == '9')
            {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('CPF yet to sign up')
        </script>
        </html>");
    }
    
}

if (isset($_POST['comp_num1']))
{
    #echo ("aisxgu");
    $result = exec('head.py 5 '.$session.' '.$_POST['comp_num1']);
        #echo ($result);
        if ($result == '2')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Complaint resolved')
        </script>
        </html>");

    }
    else if ($result == '4')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Some error has occured.')
        </script>
        </html>");
    }
    
}

function load_comp($sess)
{    
    #echo ($sess);
    $data = json_decode(exec('head.py 2 '.$sess), true);
    if ($data == '5')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Unauthorized access')
        location.replace('login.php');
        </script>
        </html>");

        header('Location: login.php');
        exit();
    }
    foreach($data as &$value)
        {
            #echo ($value);

            list($num,$cpf,$from_deptt,$for_deptt,$content,$comp_time,$approved_on,$under_process_on,$resolved_on,$assigned_to)=explode("#",$value);
            $sub_button_enable = 'sub_button_enable'.$num;
            $sub_button = 'sub_button'.$num;
            $assign_cpf = 'assign_cpf'.$num;
            if ($under_process_on != 'None' && $resolved_on == 'None')
            {
                            echo "<tr>
                                                    <td>$cpf</td>
                                                    <td>$num</td>
                                                    <td>$from_deptt</td>
                                                    <td>$comp_time</td>
                                                    <td>$approved_on</td>
                                                    <td>$under_process_on</td>
                                                    <td>$content</td>
                                                    <td>$assigned_to</td>
                                                    <td><form action = 'incoming.php' method = 'POST'>
                                                    <input type = 'hidden' id = 'comp_num' name = 'comp_num' value = $num>
                                                    <input type = 'hidden' id = 'assign_name' name = 'assign_name' value = $assign_cpf>
                                                    <button type= 'button' id = $sub_button_enable style='color: #4eb980; display:inline' onclick = 'AssignJs(\"$num\")'>Assign</button>
                                                    <button type= 'submit' id = $sub_button style='color: #4eb980; display:none'>Assign</button>
                                                    <input type = 'text' name = $assign_cpf id = $assign_cpf style = 'display:none' placeholder = 'Enter cpf of the target'></form>
                                                    <td><form action = 'incoming.php' method = 'POST'>
                                                    <input type = 'hidden' id = 'comp_num1' name = 'comp_num1' value = $num>
                                                    <button type= 'submit' id = $sub_button style='color: #4eb980'>Resolve</button>
                                                    </form>
                                                       
                                                </tr>";
            }
            else
            if ($resolved_on == 'None')
                {            
                    echo "<tr>
                                                                    <td>$cpf</td>
                                                                    <td>$num</td>
                                                                    <td>$from_deptt</td>
                                                                    <td>$comp_time</td>
                                                                    <td>$approved_on</td>
                                                                    <td>$under_process_on</td>
                                                                    <td>$content</td>
                                                                    <td>$assigned_to</td>
                                                                    <td><form action = 'incoming.php' method = 'POST'>
                                                                    <input type = 'hidden' id = 'comp_num' name = 'comp_num' value = $num>
                                                                    <input type = 'hidden' id = 'assign_name' name = 'assign_name' value = $assign_cpf>
                                                                    <button type= 'button' id = $sub_button_enable style='color: #4eb980; display:inline' onclick = 'AssignJs(\"$num\")'>Assign</button>
                                                                    <button type= 'submit' id = $sub_button style='color: #4eb980; display:none'>Assign</button>
                                                                    <input type = 'text' name = $assign_cpf id = $assign_cpf style = 'display:none' placeholder = 'Enter cpf of the target'></form>
                                                                       
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
		<meta charset="utf-8" />+
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
                    <div class = "collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right" style="font-size: 16px; margin:0px">
                            <li class="active"><a href="newcom.php">Register Complaint</a></li>
                            <li class="active"><a href="checkstatus.php">Your Complaints</a></li>
                            <li class="dropdown">
                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                        Department
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" style="background-color: #403441;">
                                        <li><a href="file:///C:/Users/Priyank%20Ahuja/Desktop/complaint_redressal/frontend/status_dep.html" style="color: #4eb980">Complaint Status</a></li>
                                        <li><a href="file:///C:/Users/Priyank%20Ahuja/Desktop/complaint_redressal/frontend/complaint_req.html" style="color: #4eb980">Complaint Requests</a></li>
                                    </ul>
                                </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    {User Name}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="background-color: #403441;">
                                    <li><a href="#" style="color: #4eb980">Profile</a></li>
                                    <li><a href="logout.php" style="color: #4eb980">Logout</a></li>
                                </ul>
                            </li>
						</ul>
					</div>
				</div> 	 
			</nav>
			
		<!-- Main -->
			<div id="main">
				<div class="box alt container">
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
                                                <th>Approved on</th>
                                                <th>Assigned on</th>
                                                <th>Complaint</th>
                                                <th>Assigned to</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody style = "width:100% height:100%">
                                            <?php load_comp($session); ?>
                                            
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

		<!-- Footer -->
			<div id="footer">
				<div class="container medium">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
					</ul>

					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>

				</div>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>




        <script type = "text/javascript">

            function AssignJs(num)
            {
                var sub_button_enable = 'sub_button_enable' + num
                var sub_button = 'sub_button' + num
                var assign_cpf = 'assign_cpf' + num
                document.getElementById(assign_cpf).style.display = "inline";
                document.getElementById(sub_button_enable).style.display = "none";
                document.getElementById(sub_button).style.display = "inline";

            }
        </script>




	</body>
</html>