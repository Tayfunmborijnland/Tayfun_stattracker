<!-- PHP code om verbinding te maken met localhost -->
<?php
 
// Gebruikersnaam is root
$user = 'root';
$password = '';
 
// Database name is geeksforgeeks
$database = 'multi_login';
 
// Server is localhost met
// poort nummer 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checken voor connecties
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query om data te selecteren uit de database
$sql = " SELECT * FROM userdata ORDER BY Doelpunten DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code om data te tonen in een tabel-->
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Statistieken</title>
    <!-- CSS styling voor het tabel -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head>
 
<body>
    <section>
        <h1>Statistieken</h1>
        <!-- Tabel constructie -->
        <table>
            <tr>
                <th>Teams</th>
                <th>Doelpunten</th>
                <th>Assists</th>
            </tr>
            <!-- PHP code om alle data te krijgen van elke kolom -->
            <?php
                // Loop tot het einde van de data
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- Data verkrijgen van elke
                    rij van elke kolom -->
                <td><?php echo $rows['Teams'];?></td>
                <td><?php echo $rows['Doelpunten'];?></td>
                <td><?php echo $rows['Assisten'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
 
</html>