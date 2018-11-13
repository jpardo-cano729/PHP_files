<!doctype html>

<html>
	<head>
<!--
	    exercise_02_05_01
	    Author: Jonathan Pardo-Cano
	    Date: 10.2.18
	    Filename: viewFiles2.php
-->
		<title>View Files 2</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<body>
        <h2>View Files 2</h2>
        <?php
            $dir = "../exercise_02_01_01";
            $dirEntries = scandir($dir);
            foreach ($dirEntries as $entry) {
                if (strcmp($entry, '.') !== 0 && strcmp($entry, '..') !== 0) {
                    echo "<a href=\"$dir/$entry\">$entry</a><br>\n";
                }    
            }
       ?>
	</body>
</html>