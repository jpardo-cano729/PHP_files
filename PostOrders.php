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
       $itemsArray = ["milk","eggs","cheese","chips","Carne Asada"];
       if (isset($_POST['submit'])) {
        $milk = "milk:" . $_POST['milk'];
        $eggs = $_POST['eggs'];
        $cheese = $_POST['cheese'];
        $chips = $_POST['chips'];
        $carne = $_POST['carne'];
           
        $userRecord = "$milk~$eggs~$cheese~$chips~$carne\n";
        $fileHandle = fopen("Orders.txt", "ab");
        if (!$fileHandle) {
            echo "There was an error saving your Information!\n";
        } 
        else {
            fwrite($fileHandle,$userRecord);
            fclose($fileHandle);
            echo "Your Order has been saved.\n";
            }
       }
       
         

    ?>
        <!--  HTML form  -->
        <h1 style="text-align:center">Post Orders</h1>     
        <hr>
        <form action="PostOrders.php" method="post">
           
            <span style="font-weight: bold">
            <p>
                Milk
                <br>
                <input type="number" min="0" max="5" name="milk">
            </p>
            
            <hr>
            </span>
            <br>
            
            <span style="font-weight: bold">
            <p>
                Eggs
                <br>
                <input type="number" min="0" max="5" name="eggs">
            </p>
            
            <hr>
            </span>
            <br>
            
            <span style="font-weight: bold">
            <p>
                Cheese
                <br>
                <input type="number" min="0" max="5" name="cheese">
            </p>
            
            <hr>
            </span>
            <br>
            
            <span style="font-weight: bold">
            <p>
                Chips
                <br>
                <input type="number" min="0" max="5" name="chips">
            </p>
            
            <hr>
            </span>
            <br>
            
            <span style="font-weight: bold">
            <p>
                Carne Asada(lbs)
                <br>
                <input type="number" min="0" max="5" name="carne">
            </p>
            
            <hr>
            </span>
            <br>
            
           
            <input type="reset" name="reset" value="Reset Form">
            <input type="submit" name="submit" value="Register">
            <p>
            <a href="OnlineOrders.php">View Orders</a>
        </p>
        </form>
        <hr>

</body>

</html>
