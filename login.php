<?php session_start(); ?><!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Share Your Work - Login</title>
    </head>

    <body>

        <?php
        if(filter_input(INPUT_POST, 'submit')){
	       $username = filter_input(INPUT_POST, 'username') 
		      or die('Missing/illegal username parameter');
	       $pw = filter_input(INPUT_POST, 'userpass')
		      or die('Missing/illegal userpass parameter');
	    
           require_once('db_con.php');
	       $sql = 'SELECT userid, pwhash FROM users WHERE username=?';
	       $stmt = $con->prepare($sql);
	       $stmt->bind_param('s', $username);
	       $stmt->execute();
	       $stmt->bind_result($idusers, $pwhash);
	
	       while($stmt->fetch()) { }
	
	       if (password_verify($pw, $pwhash)){
              echo 'Logged in as '.$username;
		      $_SESSION['idusers'] = $idusers;
              $_SESSION['username'] = $username;
		
	       } else {
               echo 'Illegal username/password combination';
	       }
	           echo '<hr>';
           }
	
        ?>


        <p>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <fieldset>
                    <legend>Login</legend>
                    <a href="adduser.php">Create User</a> <br>
                    <input name="username" type="text"     placeholder="Brugernavn" required />
                    <input name="userpass" type="password" placeholder="Password"   required />
                    <input name="submit" type="submit" value="Login" />
                    <a href="logout.php">Click to Logout</a>
                </fieldset>
            </form>
        </p>
    </body>
</html>