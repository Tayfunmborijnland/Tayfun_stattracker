<?php 
	include('functions.php');

if (!isLoggedIn()) {
	$_SESSION['msg'] = "Je moet eerst inloggen";
	header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Gebruiker-Home-Pagina</h2>
	</div>
	<div class="content">
		<!-- notificatie bericht -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						unset($_SESSION['success']);
					?> 
				</h3> 
			</div>
		<?php endif ?>
		<!-- Informatie van de ingelogde gebruiker -->
		<div class="profile_info">
		

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">Uitloggen</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
	
	<div id="stats" style="margin-top: -220px; display: block; margin-left: 5px;">
		<a href="stats.php"><p>Statistieken</p></a>
				</div>

</body>
</html>