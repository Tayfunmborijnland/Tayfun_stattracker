<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inlogpagina</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Inloggen</h2>
	</div>
	<form method="post" action="admin/login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Gebruikersnaam</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Wachtwoord</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Inloggen</button>
		</div>
		<p>
			Al een gebruiker ? <a href="register.php">Registreren</a>
		</p>
	</form>
</body>
</html>