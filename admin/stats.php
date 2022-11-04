<!-- PHP code om verbinding te kunnen maken met de database
<?php
 
// Gebruikersnaam is root
$user = 'root';
$password = '';
 
// Database naam is multi_login
$database = 'multi_login';
 
// De server is localhost met poortnummer 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checken voor connecties
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query om data vanuit de database te selecteren
$sql = " SELECT * FROM userdata ORDER BY Doelpunten DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>

<!-- HTML code om alle data in een tabel te zetten -->
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Statistieken</title>

    <!-- Css styling voor de pagina -->
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
        <!-- Tabel opzet -->
        <table>
            <tr>
                <th>Teams</th>
                <th>Doelpunten</th>
                <th>Assists</th>
            </tr>
            <!-- PHP code om data te krijgen van de tabel -->
            <?php
                // Loop tot het einde van de data
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- Data aan het verkijgen van elke rij van iedere kolom -->
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