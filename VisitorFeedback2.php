<!doctype html>

<html>
	<head>
<!--
	    exercise_02_05_01
	    Author: Jonathan Pardo-Cano
	    Date: 10.2.18
	    Filename: VisitorFeedback2.php
-->
		<title>Visitor Feedback 2</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<body>
        <h2>Visitor Feedback</h2>
        <?php
            $dir = "./comments";
        if(is_dir($dir)){
            $commentFiles = scandir($dir);
            foreach ($commentFiles as $fileName) {
                if ($fileName !== "." && $fileName !== "..") {
                    echo "From <strong>$fileName</strong><br>";
                    $comment = file_get_contents($dir . "/" . $fileName);
                    echo $comment;
                    echo "<hr>\n";
                }
            }
        }
       ?>
	</body>
</html>