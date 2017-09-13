<?php session_start(); ?><!doctype html>
<?php 
    include 'db_con.php';
?>
<html>
	<head>
		<title>Page Title</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>
        <h1>Image Upload</h1>
        
        <a>Logged in as <?=$_SESSION['username']?></a>
        <br><br>
        <a href="viewpictures.php">view a pic!</a>
        <hr>
        <h2>Upload your pic!</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <!-- Select image to upload: -->
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <input type="text" name="title" placeholder="Image Title" id="title" required /><br>
            <input type="text" name="description" placeholder="Description of Image" id="description" required /><br>
            <input type="submit" value="Upload Image" name="submit">
        </form>
	</body>
</html>