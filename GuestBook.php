<!doctype html>

<html>
<!--
   Exercise02_06_01
   
    Author: Jonathan Pardo-Cano
    Date: 10.25.18

    GuestBook.php
-->

<head>
    <title>GuestBook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!--  HTML form  -->
    <h1>Registered Users</h1>
    <?php
    if (isset($_GET['action'])) {
        if(file_exists("Guests.txt") && filesize("Guests.txt") != 0){
            $userArray = file("Guests.txt");
            switch ($_GET['action']) {
                case 'Delete First':
                    array_shift($userArray);
                    break;
                case 'Delete Last':
                    array_pop($userArray);
                    break;
                case 'Sort Ascending':
                    sort($userArray);
                    break;
                case 'Sort Descending':
                    rsort($userArray);
                    break;
                case 'Delete User':
                      array_splice($userArray, $_GET['user'],1);
                    break;
            }
            if (count($userArray) > 0) {
                $newUser = implode($userArray);
                $fileHandle = fopen("Guests.txt", "wb");
                if (!$fileHandle) {
                    echo "There was an error Updating the User file.\n";
                }
                else {
                    fwrite($fileHandle, $newUser);
                    fclose($fileHandle);
                }
            }
            else {
                unlink("Guests.txt");
            }
        }
    }
    if (!file_exists("Guests.txt") || filesize("Guests.txt") == 0) {
        echo "<p>There are no Users Registered.</p>\n";
    }
    else {
        $userArray = file("Guests.txt");
        echo "<table style=\"background-color: azure\" border=\"1px solid black\" width=\"100%\">\n";
        $count = count($userArray);
        for ($i = 0; $i < $count; $i++) {
            $currUser = explode("~",$userArray[$i]);
            $keyUserArray[$currUser[0]] = $currUser[1];
        }
        $index = 1;
        $key = key($keyUserArray);
       foreach ($keyUserArray as $user){
            $currUser = explode("~",$user);
            echo "<tr>\n";
            echo "<td width=\"5%\" style=\" text-align:center; font-weight:bold\">" . $index . "</td>\n";
            echo"<td width=\"85%\"><span style=\"font-weight:bold\">Name: </span>" . htmlentities($key) . "<br>\n";
            echo"<span style=\"font-weight:bold\">Email: </span>" . htmlentities($currUser[0]) . "<br>\n";
            echo "<td width=\"10%\" style=\"text-align:center\">" . "<a href='GuestBook.php?" . "action=Delete%20User&" . "user=" . ($index - 1) . "'>" . "Delete User</a></td>\n";
            echo "</tr>\n";
           ++$index;
           next($keyUserArray);
           $key = key($keyUserArray);
        }
        echo"</table><br>";
    }
    
    ?>
    <hr>
    <p style="text-align:center;text-decoration:none">
        <button><a href="PostGuest.php">Register a new user</a></button> 
        <button><a href="GuestBook.php?action=Sort%20Ascending">Sort Users A-Z</a></button>
        <button><a href="GuestBook.php?action=Sort%20Descending">Sort User Z-A</a></button>
        <button><a href="GuestBook.php?action=Delete%20First">Delete First User</a></button>
        <button><a href="GuestBook.php?action=Delete%20Last">Delete Last User</a></button>
    </p>
</body>

</html>
