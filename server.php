<?php
session_start();

// variabelen laden
$username = "";
$email    = "";
$errors = array(); 

// verbinden met de database
$db = mysqli_connect('localhost', 'root', '', 'project');

// gebruiker registreren
if (isset($_POST['reg_user'])) {
  // ontvang alle input waardes van de form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validatie: ben ervan overtuigd dat de form correct is ingevuld
  // door het toevoegen van (array_push()) error in $errors array 
  if (empty($username)) { array_push($errors, "Gebruikersnaam is verplicht"); }
  if (empty($email)) { array_push($errors, "Email is verplicht"); }
  if (empty($password_1)) { array_push($errors, "Wachtwoord is verplicht"); }
  if ($password_1 != $password_2) {
	array_push($errors, "De wachtwoorden komen niet overeen");
  }

  // Eerst de database checken om er zeker van te zijn
  // Een gebruiker bestaat niet met dezelfde gebruikersnaam en/of email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // Als de gebruiker Bestaat
    if ($user['username'] === $username) {
      array_push($errors, "Gebruikersnaam bestaat al");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email bestaat al");
    }
  }

  // Tot slot, registreer gebruiker als er geen errors zijn in de form
  if (count($errors) == 0) {
  	$password = md5($password_1);// encrypt het wachtwoord voordat het wordt opgeslagen in de database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	header('location: login.php');
  }
}

// Inloggen gebruiker
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Gebruikersnaam is verplicht");
  }
  if (empty($password)) {
  	array_push($errors, "Wachtwoord is verplicht");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Verkeerde gebruikersnaam/wachtwoord combinatie");
  	}
  }
}

?>