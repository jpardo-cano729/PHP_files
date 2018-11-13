<!doctype html>

<html>

<head>
<!--
    exercise_02_08_01
    Author: Jonathan Pardo-Cano
    Date: 11.05.18
    filename: SignGuestBook.php
-->
    <title>SignGuestBook.php</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Sign Guest Book</h2>
    <?php
        // sets out variable to login in into the database
        $hostname = "localhost";
        $username = "adminer";
        $password = "which-along-25";
        $DBName = "guestbook";
        $tableName = "visitors";
        $firstname = "";
        $lastname = "";
        $formErrorCount = 0;
    
        // function for checking the result of the connection attempt
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
//                echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
            }
            else {
//                echo "<p>Could not select the \"$DBName\" database:". mysqli_error($DBConnect) . ", creating it.</p>\n";
                $sql = "CREATE DATABASE $DBName";
                if (mysqli_query($DBConnect,$sql)){
                    echo "<p>Successfully created the \"$DBName\" database.</p>\n";
                    $success = mysqli_select_db($DBConnect,$DBName);
                    if ($success) {
//                        echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
                    }
                }
                else {
//                    echo "<p>Could not create the \"$DBName\" database: " . mysqli_error($DBConnect) . "</p>\n";
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
//                echo "The <strong>$tableName</strong> table does not exist, creating table.<br>\n";
                $sql = "CREATE TABLE $tableName (countID SMALLINT
                        NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        lastname VARCHAR(40), firstname
                        VARCHAR(40))";
                $result = mysqli_query($DBConnect,$sql);
                if ($result === false) {
                    $success = false;
//                    echo "<p>Unable to create the $tablename table.</p>";
//                    echo "<p>Error code " . mysqli_errno($DBConnect) . ":" . mysqli_error($DBConnect) . "</p>";
                }
                else {
                    $success = true;
//                    echo "<p>Successfully created the $tablename table.</p>";
                }
            }
            else {
                $success = true;
//                echo "The $tableName table already exists.<br>\n";
            }
            return $success;
        }
        // checks if the user has hit the submit button in order to start process
        if(isset($_POST['submit'])){
            $firstname = stripslashes($_POST['firstName']);
            $firstname = trim($firstname);
            $lastname = stripslashes($_POST['lastName']);
            $lastname = trim($lastname);
            if(empty($firstname) || empty($lastname)) {
                echo "<p>You must enter your first and last <strong>name</strong>.</p>\n";
                ++$formErrorCount;
            }
        if($formErrorCount === 0) {
            $DBConnect = connectToDB($hostname, $username,$password);
            if ($DBConnect) {
                if (selectDB($DBConnect,$DBName)) {
                    if(createTable($DBConnect, $tableName)){
//                        echo "<p>Connection successful!</p>\n";
                        $sql = "INSERT INTO $tableName
                                VALUES(NULL, '$lastname',
                                        '$firstname')";
                        $result = mysqli_query($DBConnect, $sql);
                        if($result === false) {
                            echo "<p>Unable to execute the query.</p>";
                            echo "<p>Error code " . mysqli_errno($DBConnect) . ":" . mysqli_error($DBConnect) . "</p>";
                        }
                        else {
                            echo "<h3>Thank you for signing our guest book!</h3>";
                            $firstname = "";
                            $lastname = "";
                        }
                    }
                }
                mysqli_close($DBConnect);
            }
        }
    }
    ?>
    <form action="SignGuestBook.php" method="post">
        <p><strong>First Name:</strong><br>
        <input type="text" name="firstName" value="<?php echo $firstname; ?>"></p>
        <p><strong>Last Name:</strong><br>
        <input type="text" name="lastName" value="<?php echo $lastname; ?>"></p>
        <p><input type="submit" name="submit" value="Submit"></p>
    </form>
    <?php
    $DBConnect = connectToDB($hostname, $username, $password);
    if ($DBConnect) {
        if (selectDB($DBConnect,$DBName)) {
            if (createTable($DBConnect,$tableName)){
//                echo "<p> Connection successful!</p>\n";
                echo "<h2>Visitors Log</h2>";
                $sql = "SELECT * FROM $tableName";
                $result =  mysqli_query($DBConnect, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "<p>There are no entries in the guest book!</p>";
                }
                else {
                echo "<table width='60%' border='1'>";
                echo "<tr>";
                echo "<th>Visitor</th>";
                echo "<th>Last Name</th>";
                echo "<th>First Name</th>";
                echo "</tr>\n";
                    while($row = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        echo "<td width='10%' style='text-align:center'>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($result);
                }
            }
        }
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>