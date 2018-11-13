<!doctype html>

<html>
	<head>
<!--
	    exercise_02_05_01
	    Author: Jonathan Pardo-Cano
	    Date: 10.4.18
	    Filename: FileUploader.php
-->
		<title>View Files</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<body>
        <h2>File Uploader</h2>
        <?php
        $dir = ".";
        if(isset($_POST['upload'])){
            if(isset($_FILES['newFile'])){
                if(move_uploaded_file($_FILES['newFile']['tmp_name'], $dir . "/" . $_FILES['newFile']['name']) === true){
                    chmod($dir . "/" . $_FILES['newFile']['name'],0644);
                    echo "File \"" . htmlentities($_FILES['newFile']['name']) . "\"successfully uploaded.<br>\n";
                }
                else{
                    echo "There was an error uploading \"" . htmlentities($_FILES['newFile']['name']) . "\".<br>\n";
                }
                
            }
        }
       ?>
       <form action="FileUploader.php" method="post" enctype="multipart/form-data">
           <input type="hidden" name="MAX_FILE_SIZE" value="25000">
           File to Upload:
           <input type="file" name="newFile"><br>
           (25,000 byte limit)<br>
           enter ssn to generate
           <input type="submit" name="upload" value="Upload the file"><br>
       </form>
	</body>
</html>