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
    $result = exec('head.py '.$_POST['value'].' '.$session.' '.$_POST['comp_num']);
        if ($result == '2')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Complaint approved')
        </script>
        </html>");

        header('Location: compstatus.php');
        exit();
    }
    else if ($result == '5')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Some error has occured')
        </script>
        </html>");
    }
        else if ($result == '1')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Complaint closed')
        </script>
        </html>");
    }
        else if ($result == '4')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Some error has occured')
        </script>
        </html>");
    }
}


function load_comp($sess)
{    
    #echo ($sess);
    $sess = $_SESSION['id'];
    $data = json_decode(exec('user_module.py 3 '.$sess), true);
    if ($data == '4')
    {
            echo ("<html>
        <script type = 'text/javascript'>
        alert('Please try again')
        </script>
        </html>");

        header('Location: login.php');
        exit();
    }
    foreach($data as &$value)
        {
            #echo ($value);

            list($num, $for_deptt, $content,$comp_time,$created_on,$approved_on,$under_process_on,$resolved_on)=explode("#",$value);
           
             echo "<tr>
             <td>$num</td>
             <td>$for_deptt</td>
             <td>$content</td>
             <td>$comp_time</td>
             <td>$approved_on</td>
             <td>$under_process_on</td>
             <td>$resolved_on</td> 
            </tr>";
        }
}

?>



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
				<div class="box alt container" style="width: 100%; margin: 0; height: 100%">
                        <section>
                                <header>
                                    <h3>Complaint Status</h3>
                                </header>
                                <div class="table-wrapper">
                                    <table class="default">
                                        <thead>
                                            <tr>
                                                <th>Complaint Number</th>
                                                <th>To Department</th>
                                                <th>Complaint</th>
                                                <th>Created on</th>
                                                <th>Approved on</th>
                                                <th>Under proces on</th>
                                                <th>Resolved on</th>
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>