<!doctype html>

<html>
	<head>
<!--
	    exercise_02_05_01
	    Author: Jonathan Pardo-Cano
	    Date: 10.2.18
	    Filename: viewFiles.php
-->
		<title>View Files</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<body>
        <h2>View Files</h2>
        <?php
            $dir = "../exercise_02_01_01";
            $openDir = openDir($dir); //gets the file stored in the $dir variable and puts it into $openDir
            while($curFile = readdir($openDir)) {
                if (strcmp($curFile, '.') !== 0 && strcmp($curFile, '..')) {
                    echo "<a href=\"$dir/$curFile\">$curFile</a><br>\n";
                }
            }
            closedir($openDir);
       ?>
	</body>
</html>