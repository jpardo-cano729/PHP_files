<!doctype html>

<html>

<head>
    <title>Available Opportunities</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h1>College Intership</h1>
    <h2>Available Opportunities</h2>
    <?php
    if (isset($_REQUEST['internID'])) {
        $internID = $_REQUEST['internID'];
    }
    else {
        $internID = -1;
    }
    // debug
    echo "\$internID: $internID\n";
    $errors = 0;
    $hostname = "localhost";
    $username = "adminer";
    $passwd = "which-along-25";
    $DBConnect = false;
    $DBName = "internships2";
    $TableName = 
    
    if ($errors == 0) {
        $DBConnect = mysqli_connect($hostname, $username, $passwd);
        if (!$DBConnect) {
            ++$errors;
            echo "<p>Unable to connect to the database server".
                " error code: " . mysqli_connect_error() .
                " </p>\n";
        }
        else {
            $result = mysqli_select_db($DBConnect, $DBName);
            if (!$result) {
                ++$errors;
                echo "<p>Unable to select the database".
                    " \"$DBName\" error code: " . mysqli_error($DBConnect) .
                    " </p>\n";
            }
        }
    }
    $TableName = "interns";
    if ($errors == 0) {
        $SQLstring = "SELECT * FROM $TableName" . 
            " WHERE internID='$internID'";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (!$queryResult) {
            ++$errors;
            echo "<p>Unable to execute the query, error code: " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) ."</p>\n";
        }
    }
    if ($DBConnect) {
        echo "<p>closing the database connection.</p>\n";
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>
