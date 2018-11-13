<!doctype html>

<html>

<head>
<!--
    exercise_02_08_01
    Author: Jonathan Pardo-Cano
    Date: 11.05.18
    filename: NewsletterSubscribers2.php
-->
    <title>Newsletter Subscribers 2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Newsletter Subscribers 2</h2>
    <?php
        $hostName = "localhost";
        $userName = "adminer";
        $password = "which-along-25";
        $DBName = "newsletter2";
        $tableName = "subscribers";
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if (!$DBConnect) {
           echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
        } else {
            if (mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>successfully selected the \"$DBName\" database.</p>\n";
                $sql = "SELECT * FROM $tableName";
                $result = mysqli_query($DBConnect, $sql);
                echo "<p>Number of rows in" . " <strong>$tableName</strong>: " . mysqli_num_rows($result) . ".</p>\n";
                echo "<table width='100%' border='1'>";
                echo "<tr>";
                echo "<th>Subcriber ID</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Subcribe Date</th>";
                echo "<th>Confirm Date</th>";
                echo "</tr>\n";
                
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    foreach($row as $field){
                        echo "<td>{$field}</td>";
                    }
                    echo "</tr>\n";
                    
                }
                echo "</table>\n";
                mysqli_free_result($result);
            }
            mysqli_close($DBConnect);
        }
    ?>
</body>

</html>
