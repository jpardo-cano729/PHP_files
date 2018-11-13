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
        
        <?php
        $dir = "./comments";
        if (is_dir($dir)) {
            if (isset($_POST['save'])) {
                if (empty($_POST['name'])) {
                    echo "Unknown visitor\n";
                }
                else{
                    $safeString = stripslashes($_POST['name']) . "\n";
                    $safeString .= stripslashes($_POST['email']) . "\n";
                    $safeString .= date('r') . "\n";
                    $safeString .= stripslashes($_POST['comment']) . "\n";
                    echo "\$safeString: $safeString<br>";
                    $currentTime = microtime();
                    echo "\$currentTime: $currentTime<br>";
                    $timeArray = explode(" ",$currentTime);
                    echo var_dump($timeArray) . "<br>";
                    $timeStamp = (float)$timeArray[1] + (float)$timeArray[0];
                    echo "\$timeStamp: $timeStamp<br>";
                    $saveFileName = "$dir/Comment.$timeStamp.Txt";
                    echo "\$saveFileName: $saveFileName<br>";
                    if (file_put_contents($saveFileName,$safeString) > 0) {
                        echo "File \"" . htmlentities($saveFileName) . "\"has successfully saved.<br>\n";      
                    }
                    else{
                        echo "There was an error writing \"" . htmlentities($saveFileName) . "\".<br>\n";
                    }
                }
            }
        }
        else{
            mkdir($dir);
            chmod($dir, 0767);
        }
        ?>
       <h2>View Files</h2>
       <form action="VisitorComments.php" method="post">
           Your name: <input type="text" name="name"><br>
           Your E-mail: <input type="email" name="email"><br>
           <textarea name="comment" cols="100" rows="6"></textarea><br>
           <input type="submit" name="save" value="Submit your comment">
       </form>
	</body>
</html>
