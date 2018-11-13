<!doctype html>

<html>

<head>
<!--
    exercise_02_08_04
    Author: Jonathan Pardo-Cano
    Date: 11.06.18
    filename: InterviewCandidates.php
-->
    <title>SignGuestBook.php</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Interview Candidates</h2>
    <?php
        // sets out variable to login in into the database
        $hostname = "localhost";
        $username = "adminer";
        $password = "which-along-25";
        $DBName = "interviews";
        $tableName = "candidates";
        $interviewerName = "";
        $position = "";
        $date = "";
        $candidateName = "";
        $abilities = "";
        $appearance = "";
        $skills = "";
        $knowledge = "";
        $comments = "";
        $formErrorCount = 0;
    
        function connectToDB($hostname,$username,$password){
            $DBConnect = mysqli_connect($hostname, $username, $password);
            if(!$DBConnect) {
                echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
            }
            return $DBConnect;
        }
        
        // function for either creating our Database or selecting it
        function selectDB($DBConnect,$DBName) {
            $success = mysqli_select_db($DBConnect,$DBName);
            if ($success) {
            }
            else {
                $sql = "CREATE DATABASE $DBName";
                if (mysqli_query($DBConnect,$sql)){
                    $success = mysqli_select_db($DBConnect,$DBName);
                    if ($success) {
                    }
                }
                else {
                }
            }
            return $success;
        }
    
        // function to create the table if there isn't one already
        function createTable($DBConnect, $tableName) {
            $success = false;
            $sql = "SHOW TABLES LIKE '$tableName'";
            $result = mysqli_query($DBConnect,$sql);
            if (mysqli_num_rows($result) === 0){
                $sql = "CREATE TABLE $tableName (countID SMALLINT
                        NOT NULL AUTO_INCREMENT PRIMARY KEY,interviewername VARCHAR(40), position VARCHAR(40), interviewdate DATE, candidatename TEXT,communication TEXT, apperance TEXT, skills TEXT, businessKnowledge TEXT, comments TEXT)";
                $result = mysqli_query($DBConnect,$sql);
                if ($result === false) {
                    $success = false;
                }
                else {
                    $success = true;
                }
            }
            else {
                $success = true;
            }
            return $success;
        }
        // checks if the user has hit the submit button in order to start process
        if(isset($_POST['submit'])){
            if(empty($interviewerName)|| empty($position)||empty($date) ||empty($candidateName) || empty($abilities)|| empty($appearance)||empty($skills)||empty($knowledge)||empty($comments)){
                echo "<p>You must enter <strong>ALL</strong> fields.</p>\n";
                ++$formErrorCount;
            }
            else {
            $interviewerName = stripslashes($_POST['name']);
            $position = stripslashes($_POST['position']);
            $date = stripslashes($_POST['date']);
            $candidateName = stripslashes($_POST['cName']);
            $abilities = stripslashes($_POST['abilities']);
            $appearance = stripslashes($_POST['apperance']);
            $skills = stripslashes($_POST['computerSkills']);
            $knowledge = stripslashes($_POST['knowledge']);
            $comments = stripslashes($_POST['comments']);
            
                
        if($formErrorCount === 0) {
            $DBConnect = connectToDB($hostname, $username,$password);
            if ($DBConnect) {
                if (selectDB($DBConnect,$DBName)) {
                    if(createTable($DBConnect, $tableName)){
                        $sql = "INSERT INTO $tableName
                                VALUES(NULL, '$interviewerName', '$position','$date','$candidateName','$abilities','$appearance','$skills','$knowledge','$comments')";
                        $result = mysqli_query($DBConnect, $sql);
                        if($result === false) {
                            echo "<p>Unable to execute the query.</p>";
                            echo "<p>Error code " . mysqli_errno($DBConnect) . ":" . mysqli_error($DBConnect) . "</p>";
                        }
                        else {
                            echo "<h3>Thank you for applying to our company!</h3>";
                            $interviewerName = "";
                            $position = "";
                            $date = "";
                            $candidateName = "";
                            $abilities = "";
                            $apperance = "";
                            $skills = "";
                            $knowledge = "";
                            $comments = "";
                        }
                    }
                }
                mysqli_close($DBConnect);
            }
        }
    }
}
    ?>
   <form action="InterviewCandidates.php" method="post">
       <table width="100%">
       <tr>
        <td style="vertical-align:top">
        <p>
        <strong>Interviewer Name:</strong><br>
        <input type="text" name="name" value="<?php echo $interviewerName; ?>">
        </p>
        <p>
        <strong>Interviewer Position:</strong><br>
        <input type="text" name="position" value="<?php echo $position; ?>">
        </p>
        <p>
        <strong>Interview Date:</strong><br>
        <input type="date" name="date" value="<?php echo $date; ?>">
        </p>
        <p>
        <strong>Candidate Name:</strong><br>
        <input type="text" name="cName" value="<?php echo $candidateName; ?>">
        </p>
        <p>Communication Abilities<br><textarea name="abilities" cols="30" rows="10" value="<?php echo $abilities ?>"></textarea></p>
        <p>Professional Apperance<br><textarea name="apperance"  cols="30" rows="10" value="<?php echo $appearance ?>"></textarea></p>
        </td>
        <td>
        <p>Computer Skills<br><textarea name="computerSkills" cols="30" rows="10" value="<?php echo $skills ?>"></textarea></p>
        <p>Business Knowledge<br><textarea name="knowledge" cols="30" rows="10" value="<?php echo $knowledge ?>"></textarea></p>
        <p>Interviewer Comments<br><textarea name="comments" cols="30" rows="10" value="<?php echo $comments ?>"></textarea></p>
        <p><input type="submit" name="submit" value="Submit"></p>
        <p><a href="DisplayTable.php">Click here to view table</a></p>
        </td>
           
       </tr>
        
        
    </table>
    </form>
<!--
     
-->
</body>

</html>
