<!doctype html>

<html>

<head>
    <!--
    exercise_02_08_01
    Author: Jonathan Pardo-Cano
    Date: 10.30.18
    filename: NewsLetterSubscribe.php
-->
    <title>Subscribe to the News Letter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Subscribe to the News Letter</h2>
     <?php
       $hostName = "localhost";
       $userName = "adminer";
       $password = "which-along-25";
       $DBName = "newsletter2";
       $tableName = "subscribers";
       $subscriberName = "";
       $subscriberEmail = "";
       $showForm = false;
       if (isset($_POST['submit'])) {
           $formErrorCount = 0;
           if (!empty($_POST['subName'])) {
               $subscriberName = stripslashes($_POST['subName']);
               $subscriberName = trim($subscriberName);
               if (strlen($subscriberName) === 0) {
                   ++$formErrorCount;
                   echo "<p>You must include your" . " <strong>name</strong>!</p>\n";
               }
           }
           else {
               ++$formErrorCount;
               echo "<p>Form submittal error, no" .
                   " <strong>name</strong> field!</p>\n";
           }
           if (!empty($_POST['subEmail'])) {
               $subscriberEmail = stripslashes($_POST['subEmail']);
               $subscriberEmail = trim($subscriberEmail);
               if (strlen($subscriberEmail) === 0) {
                   ++$formErrorCount;
                   echo "<p>You must include your" . " <strong>email</strong>!</p>\n";
               }
           }
           else {
               ++$formErrorCount;
               echo "<p>Form submittal error, no" .
                   " <strong>email</strong> field!</p>\n";
           }
           if ($formErrorCount == 0) {
               $showForm = false;
           $DBConnect = mysqli_connect($hostName, $userName, $password);
       if (!$DBConnect) {
           echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
       }
       else {
           if (mysqli_select_db($DBConnect, $DBName)) {
               echo "<p>Successfully selected the \"$DBName\"database.</p>\n";
               $subscriberDate = date("Y-m-d");
               $sql = "INSERT INTO $tableName" .
                   " (name, email, subscribeDate)" .
                   " VALUES ('$subscriberName', " . " '$subscriberEmail', " .
                   " '$subscriberDate')";

               $result = mysqli_query($DBConnect, $sql);
               if (!$result) {
                   echo "<p>Unable to insert the values " .
                       " into the <strong>$tableName" .
                       "</strong> table.</p>\n";
               }
               else {
                 $subscriberID =
                     mysqli_insert_id($DBConnect);
                   echo "<p><strong>" .
                       htmlentities($subscriberName) .
                       "</strong>, you are now" .
                       " subscribed to our newsletter.
                       <br>";
                   echo "Your subscriber ID is" .
                       " <strong>$subscriberID</strong>" .
                       " <br>";
                   echo "Your email address is <strong>" .
                       htmlentities($subscriberEmail) .
                       "</strong>.</p>";
               }
            }
           else{
             echo "<p>Could not create the \"$DBName\"database: " . mysqli_error($DBConnect) . "</p>\n";
           }
           mysqli_close($DBConnect);
       }
           }
           else {
               $showForm = true;
           }
       }
       else {
           $showForm = true;
       }

       if ($showForm) {
       ?>
       <form action="NewsLetterSubscribe.php" method="post">
           <p><strong>Your Name:</strong>
               <br>
               <input type="text" name="subName" value="<?php echo $subscriberName; ?>">
           </p>
           <p><strong>Your Email Address:</strong>
               <br>
               <input type="email" name="subEmail" value="<?php echo $subscriberEmail; ?>">
           </p>
           <p>
               <input type="submit" name="submit" value="Submit">
           </p>
       </form>
</body>

</html>
<?php
       }
    ?>