<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<a>Here be secrets</a> <br><br>
<a>Login in to see it here!</a><br>

<?php include 'login.php'; ?>
<hr>
<?php
	if(empty($_SESSION['idusers'])){
		echo 'Need to log in to see the secrets....';
    }
    else {
		echo 'Welcome '.$_SESSION['username'].'<br>The answer is 42';
	}
?>
</body>
</html>