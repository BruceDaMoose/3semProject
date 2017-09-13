<?php session_start(); ?><!doctype html>
<?php 
    date_default_timezone_set('Europe/Copenhagen');
    include 'db_con.php';
    $uid = $_SESSION['idusers'];
?>
<html>
	<head>
		<title>Share your work</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>
        <?php include 'login.php'; ?>
        <hr>
        <?php
	    if(empty($_SESSION['idusers'])){
            echo 'Need to log in to see the the webpage';
        }
        else { ?>
            Logged in as <?=$_SESSION['username']?>
        
        <h1>Images uploaded to the system</h1>
        <?php
            $sql = 'SELECT id, username, title, imageurl, description 
                    FROM images, users 
                    WHERE users.userid = images.users_userid ORDER BY upload_date DESC';
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id, $username, $title, $url, $desc); ?>
        
            <a href="postpic.php">Click to post your own picture!</a>
        
            <?php while($stmt->fetch()){ ?>
                
                <hr><h2><?=$username?>: <?=$title?></h2>
                <a href="image.php?image=<?= $id ?>">
                    <img src="<?=$url?>" width="500px" />
                </a>
                <p><?=$desc?></p>
                
            <?php }
            ?>
        <?php }
        ?>
	</body>
</html>