<!doctype html>

<html>
<!--
   Exercise02_06_01
   
    Author: Jonathan Pardo-Cano
    Date: 10.25.18

    PostGuest.php
-->

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
       if (isset($_POST['submit'])) {
        $name = stripslashes($_POST['name']);
        $email = stripslashes($_POST['email']);
        $name = str_replace("~","-", $name);
        $email = str_replace("~","-", $email);
        $existingSubjects = array();
        if (file_exists("Guests.txt") && filesize("Guests.txt") > 0) {
            $userArray = file("Guests.txt");
            $count = count($userArray);
            for($i = 0; $i < $count; $i++){
                $currUser = explode("~",$userArray[$i]);
                $existingSubjects[] = $currUser[0];
            }
        }
        if (in_array($name, $existingSubjects)) {
            echo "<p>The user <em>\"$name\"</em> you entered already exists!<br>\n";
            echo "Please enter a new user name and try again.<br>\n";
            $name = "";
        }
        else{
        $userRecord = "$name~$email\n";
        $fileHandle = fopen("Guests.txt", "ab");
        if (!$fileHandle) {
            echo "There was an error saving your Information!\n";
        } 
        else {
            fwrite($fileHandle,$userRecord);
            fclose($fileHandle);
            echo "Your Information has been saved.\n";
            $name = "";
            $email = "";
            }
        }
            
    }
    else {
        $name = "";
        $email = "";
    } 

    ?>
        <!--  HTML form  -->
        <h1 style="text-align:center">Register Users</h1>
        <hr>
        <form action="PostGuest.php" method="post">
            <span style="font-weight: bold">Name: <input type="text" name="name"></span><br>
            <span style="font-weight: bold">E-Mail: <input type="email" name="email"></span><br>
            <input type="reset" name="reset" value="Reset Form">
            <input type="submit" name="submit" value="Register">
        </form>
        <hr>
        <p style="text-align:center">
            <button><a href="GuestBook.php">View Users</a></button>
        </p>

</body>

</html>
