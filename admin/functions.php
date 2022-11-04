<?php 
session_start();

// Verbinden met localhost
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// Variabele declareren
$username = "";
$email    = "";
$errors   = array(); 

// Registreer functie aanroepen wanneer de register_btn knop is ingedrukt
if (isset($_POST['register_btn'])) {
	register();
}

// Gebruiker registreren
function register(){
	// De variabelen aanroepen met de keyword om ze beschikbaar te maken in de functie
	global $db, $errors, $username, $email;

	// Alle input waardes verkrijgen van de form. De e() functie aanroepen
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// Form validatie: Checken of de vorm correct is ingevuld
	if (empty($username)) { 
		array_push($errors, "Gebruikersnaam is verplicht"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is verplicht"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Wachtwoord is verplicht"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "De twee wachtwoorden komen niet overeen");
	}

	// De gebruiker registreren als er geen errors in de form zitten
	if (count($errors) == 0) {
		$password = md5($password_1);//Het wachtwoord encrypten voordat het wordt opgeslagen in de database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "Nieuwe gebruiker is aangemaakt";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// Het id verkrijgen van de aangemaakte gebruiker
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // De ingelogde gebruiker in een session zetten
			header('location: index.php');				
		}
	}
}

// De user array terug vragen van de gebruikers id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// string escape
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// Gebruiker uitloggen als er op de uitlog knop is geklikt
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// De login() functie aanroepen als er op login_btn is geklikt 
if (isset($_POST['login_btn'])) {
	login();
}

// Gebruiker inloggen
function login(){
	global $db, $username, $errors;

	// Form waardes verkrijgen
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// Checken of het form correct is ingevuld
	if (empty($username)) {
		array_push($errors, "Gebruikersnaam is verplicht");
	}
	if (empty($password)) {
		array_push($errors, "Wachtwoord is verplicht");
	}

	// Proberen in te loggen als er geen errors zijn in het form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // gebruiker gevonden
			// Checken of de gebruiker een user is of normale gebruiker
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				header('location: home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;

				header('location: index.php');
			}
		}else {
			array_push($errors, "Verkeerde gebruikersnaam/wachtwoord combinatie");
		}
	}
}

// ...
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}