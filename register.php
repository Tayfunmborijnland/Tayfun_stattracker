<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registreerpagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
	<h2>Registreren</h2>
</div>
<form method="post" action="register.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<label>Gebruikersnaam</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Wachtwoord</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Wachtwoord verifieren</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Registreren</button>
	</div>
	<p>
		Al een gebruiker ? <a href="login.php">Inloggen</a>
	</p>
</form>
</body>
</html>