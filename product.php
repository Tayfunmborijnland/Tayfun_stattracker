<!DOCTYPE html>
<html>
<body>

<?php
session_start();

// variabelen laden
$username = "";
$email    = "";
$errors = array(); 

// verbinden met de database
$db = mysqli_connect('localhost', 'root', '', 'project');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}



$sql = "SELECT id, username, email, img FROM users";
$result = $db->query($sql);


if ($result->num_rows > 0) {
    // de output van de data van elke rij
    while($row = $result->fetch_assoc()) {
        print "<br> id: ". $row["id"]. "<br> - Name: ". $row["username"]. "<br> - Email: " . $row["email"] . "<br>";
      print "<img src=\"".$row["img"]."\">";
     
    }
} else {
    print "0 results";
}



$db->close();   
        ?> 



</body>
</html>