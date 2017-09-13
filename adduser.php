<!doctype html>
<?php 
    include 'db_con.php'; 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Untitled Document</title>
    </head>

    <body>
        <?php
            if(filter_input(INPUT_POST, 'submit')){
	           $username = filter_input(INPUT_POST, 'username') 
		          or die('Missing/illegal username parameter');
	           
                $pw = filter_input(INPUT_POST, 'userpass')
		          or die('Missing/illegal userpass parameter');
	           
                $pw = password_hash($pw, PASSWORD_DEFAULT);
	
             //	echo 'Opretter bruger<br>'.$un.' : '.$pw;
	
	        // require_once('db_con.php');
	           $sql = 'INSERT INTO users (username, pwhash) VALUES (?, ?)';
	           $stmt = $con->prepare($sql);
	           $stmt->bind_param('ss', $username, $pw);
	           $stmt->execute();
	
	         if($stmt->affected_rows > 0){
		          echo 'user '.$username.' created';
	         } else {
		     echo 'could not create user - does he exist???';
	         }
	
        }
        ?>
    
        <p>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	           <fieldset>
    	       <legend>Tilføj ny bruger</legend>
    	       <input name="username" type="text" placeholder="Brugernavn" required />
    	       <input name="userpass" type="password" placeholder="Password"   required />
    	       <input name="submit" type="submit" value="Tilføj bruger" />
	           </fieldset>
            </form>
            <a href="index.php">Return to site</a>
        </p>
    </body>
</html>