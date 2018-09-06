<?php



session_start();
$_SESSION['id'] = '';
/*define('DOMAIN_FQDN', 'ongc.ongcgroup.co.in');
//define('LDAP_SERVER', '10.205.48.225:389/DC=ONGC,DC=ONGCGROUP,DC=co,DC=in');
session_start();
    session_unset();
if (isset($_POST['submit']))
{
    $user = strip_tags($_POST['username']) .'@'. DOMAIN_FQDN;
    $pass = stripslashes($_POST['password']);

    $ldaphost = 'LDAP://10.205.48.225';
    $ldapport = 389;

$conn = ldap_connect($ldaphost, $ldapport);
$bind = @ldap_bind($conn, $user, $pass);
echo $bind;*/
$bind = True;

if ($bind && isset($_POST['name']))
{
        echo($_POST['name']);
    #echo gettype($conn)
        #$username = explode('@', $user);
        $session_details = exec('session.py 1 '.$_POST['name'].' 1');
        list($session_id, $val, $role) = explode("#",$session_details);
        #echo ('session.py 1'.$_POST['name'].' 1');
        #$session_details = explode('#', $session_details);
        $_SESSION['id'] = $session_id;
        $_SESSION['role'] = $role;
        echo $session_id;
        #ldap_close($conn);
        if ($val == '1')
        {
        	header('Location: profile.php');
        	exit();
		}
		else
		{
			header('Location: signup.php');
        	exit();

		}
}
        
else
{
    
}
#ldap_close($conn);

#echo $_SESSION['user'];

?>


<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery Library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>Login</title>
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

                    <a class="navbar-brand" href="index.html" style="color: #ffffff">
                        Oil and Natural Gas Corporation
                    </a>
                </div>
                <div class = "collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="login.php">Login</a></li> 
                    </ul>
                </div>
            </div> 	 
        </nav>
			
		
		<!-- Main -->
			<div id="main">
				<div class="box alt container">
				<section>
                    <header>
                        <h3>Complaint System Login</h3>
                    </header>
                    <form method="post" action="login.php">
                        <div class="row">
                            <div class="col-6 col-12-mobilep">
                                <label for="name">CPF Number</label>
                                <input class="text" type="text" name="name" id="name" value="" placeholder="Enter your CPF Number" />
                            </div>
                            <div class="col-6 col-12-mobilep">
                                <label for="email">Password</label>
                                <input class="text" type="password" name="email" id="email" value="" placeholder="Password" />
                            </div>
                            <div class="col-12">
                                <ul class="actions special">
                                    <li><input type="submit" value="Login" /></li>
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