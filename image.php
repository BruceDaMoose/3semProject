
<?php session_start(); ?>
<?php 
    date_default_timezone_set('Europe/Copenhagen');
    include 'db_con.php';
    $uid = $_SESSION['idusers'];
    $image_id = $_GET['image'];
?>
<!doctype html>
<html>
	<head>
		<title>Page Title</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>
        <?php
	       if(empty($_SESSION['idusers'])){
               echo 'Need to log in to see the the webpage';
        }
        else { ?>
            Logged in as <?=$_SESSION['username']?>
        
        <?php 
            $sql = 'SELECT imageurl, title, description FROM images WHERE id = ?';
            }
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i', $image_id);
            $stmt->execute();
            $stmt->bind_result($iurl, $ititle, $idesc);
            
            while ($stmt->fetch()) { ?>
                <h2><?= $ititle ?></h2>
                <img src="<?=$iurl?>" width="500px">
                <p><?= $idesc ?></p>
                <hr>
            <?php } ?>
        <?php 
            $comments = [];
            $sqlcomments = 'SELECT u.username, c.comment FROM users u , comments c WHERE c.images_id = ? AND u.userid = c.users_userid';
            $stmt = $con->prepare($sqlcomments);
            $stmt->bind_param('i', $image_id);
            $stmt->execute();
            $stmt->bind_result($uname, $ccomment);
            
            while ($stmt->fetch()) { ?>
                <div>
                    <p><?= $uname ?></p>
                    <p><?= $ccomment ?></p><br><br>
                </div>
           <?php }
        ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?image=' . $image_id ?>">
            <fieldset>
                <legend>POST A COMMENT</legend>
                <textarea name="postcomment" placeholder="post a comment"></textarea>
                <input type="submit" name="submit" value="submit">
            </fieldset>
        </form>
        <?php 
            if ($_POST['submit']){
            
            $sqlinsert = 'INSERT INTO comments (comment, users_userid, images_id) VALUES (?, ?, ?)';
            $stmt = $con->prepare($sqlinsert);
            $stmt->bind_param('sii', $_POST['postcomment'], $uid, $image_id);
            $stmt->execute();
                
            if ($stmt->affected_rows > 0) {
                echo 'comment posted';
                } else {
                echo 'try again, fuckboi';
                } 
            }
        ?>
	</body>
</html>