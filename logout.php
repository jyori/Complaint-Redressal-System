<?php
session_start();
$id = $_SESSION['id'];
$result = exec('session.py 2 '.$id);
if ($result == '1')
{
	session_destroy();
	header('Location: index.html');
	exit();
}
else
{
    echo ("<html>
	    <script type = 'text/javascript'>
	    alert('Some error has occured')
	    </script>
	    </html>");
}