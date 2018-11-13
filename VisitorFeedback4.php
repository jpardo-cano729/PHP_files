<!doctype html>

<html>
	<head>
<!--
	    exercise_02_05_01
	    Author: Jonathan Pardo-Cano
	    Date: 10.2.18
	    Filename: VisitorFeedback3.php
-->
		<title>Visitor Feedback 4</title>
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
                    $fileHandle = fopen($dir . "/" . $fileName,"rb");
                    if ($fileHandle === false) {
                        echo "There was an error reading file \"$fileName\".<br>\n";
                    }
                    else {
                        $from = fgets($fileHandle);
                        echo "From: " . htmlentities($from) . "<br>\n";
                        $email  = fgets($fileHandle);
                        echo "Email address: " . htmlentities($email) . "<br>\n";
                        $date = fgets($fileHandle);
                        echo "Date: " . htmlentities($date) . "<br>\n";
                        while (!feof($fileHandle)) {
                            $comment = fgets($fileHandle);
                            if (!feof($fileHandle)) {
                                echo htmlentities($comment) . "<br>\n";    
                            }
                            else{
                                echo htmlentities($comment) . "\n";
                            }
            
                        }
                        echo "<hr>\n";   
                        fclose($fileHandle);
                    }
                }
            }
        }
       ?>
	</body>
</html>