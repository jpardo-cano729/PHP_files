<!doctype html>

<html>
	<head>
<!--
	    exercise_02_05_01
	    Author: Jonathan Pardo-Cano
	    Date: 10.17.18
	    Filename: TheGame.php
-->
		<title>View Files</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
		<link rel="stylesheet" href="styles.css">
	</head>

	<body>
        

       <h1 style="text-align: center;">The Game</h1>
       <form action="TheGame.php" method="post">
           Your Username: <br> <input type="text" name="username" required><br>
           Your Password: <br> <input type="password" name="password" required><br>
           Your Full name: <br> <input type="text" name="name" required><br>
           Your E-mail: <br> <input id="email" type="email" name="email" required><br>
           Your age: <br> <input type="number" name="age" required><br>
           Your Playername: <br> <input type="text" name="playername" required><br>
           Comments: <br> <textarea name="comment" cols="35" rows="5"></textarea><br>
           <input type="submit" name="save" value="Submit your Registration"><br>
       </form>
       <hr>
    <?php 
         $fileName = "TheGamers.txt";
        // checks for the "TheGamers.txt" file in the current directory that it exits if it doesn't 
        // it will be created
            if(!file_exists($fileName)){
                fopen($fileName, 'w') or die('Cannot open file:  '.$fileName);
                chmod($fileName,0757);
                fclose($fileHandle);
            }
            else{
                //after checking if the file exists it will then check for when the user clicks submit 
                if (isset($_POST['save'])) {
                    if (empty($_POST['playername'])) {
                        echo "Please enter your Player name\n";
                    }
                    else {
                        // this will eliminate any harmful code that could possibly be submitted to our form
                        $saveString = stripslashes($_POST['username']) . ":";
                        $saveString .= stripslashes(md5($_POST['password'])) . ":";
                        $saveString .= stripslashes($_POST['name']) . ":";
                        $saveString .= stripslashes($_POST['email']) . ":";
                        $saveString .= stripslashes($_POST['age']) . ":";
                        $saveString .= stripslashes($_POST['playername']) . ":";
                        $saveString .= stripslashes($_POST['comment']) . "&";
                        $fileHandle = fopen($fileName,"a");
                        if ($fileHandle === false) {
                            echo "There was an error reading file \"$fileName\".<br>\n";
                        }
                        else {
                            fwrite($fileHandle,$saveString);  
                            registeredUsers($fileName,$fileHandle);
                            }
                            fclose($fileHandle); 
                        }

                    }

                }
        // Function will retreive the data from the txt file and trim the ending character to manage the strings
        // Also formats the users into a table 
        function registeredUsers($fileName,$fileHandle) {
            echo "<table><th>Registered Users</th>";
              $playerName = file_get_contents($fileName);
              $trimmed = rtrim($playerName,"&");
              $playerName = explode("&",$trimmed);
              foreach ($playerName as $names){
                  $user = explode(":",$names);
                  echo "<tr><td>$user[5]</td></tr>";
              }
            echo "</table>";
        }
        
    ?>
    </body>
</html>