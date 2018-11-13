<?php
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
    $DBConnect = connectToDB($hostname, $username, $password);
    if ($DBConnect) {
        if (selectDB($DBConnect,$DBName)) {
            if (createTable($DBConnect,$tableName)){
                $sql = "SELECT * FROM $tableName";
                $result =  mysqli_query($DBConnect, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "<p>There are no current candidates!</p>";
                    echo "<p><a href=\"InterviewCandidates.php\">Back to the form</a></p>";
                }
                else {
                echo "<table width='100%' border='1'>";
                echo "<tr>";
                echo "<th>Interview ID</th>";
                echo "<th>Interviewer Name</th>";
                echo "<th>Position</th>";
                echo "<th>Interview Date</th>";
                echo "<th>Candidate name</th>";
                echo "<th>Communication Abilities</th>";
                echo "<th>Professional Apperance</th>";
                echo "<th>Computer Skills</th>";
                echo "<th>Business Knowledge</th>";
                echo "<th>Comments</th>";
                echo "</tr>\n";
                
                while($row = mysqli_fetch_row($result)){
                    echo "<tr>";
                        echo "<td width='15%' style='text-align:center'>$row[0]</td>";
                for($i = 1; $i < 10; $i++){
                        echo "<td>$row[$i]</td>";
                        
                    }
                }
                    echo "</tr>";
                    echo "</table>";
                    echo "<p><a href=\"InterviewCandidates.php\">Back to the form</a></p>";
                    mysqli_free_result($result);
                }
            }
        }
        mysqli_close($DBConnect);
    }
    ?>