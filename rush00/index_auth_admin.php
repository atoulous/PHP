<?php
include ("include/db.php");
session_start();
$motdepass = "getfullpower";
?>

<html>
	<head>
		<title>La Boutique Admin</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="home.css"/>
	</head>
	<body id="home">
		<div id="container">
			<header>
				<h1>La Boutique</h1>
			</header>
			<ul id="nav">
				<li><a href="index.php">Acceuil</a></li></ul>
			<div id="sidebar">
				<ul id="sidebarnav">
				</ul>
			</div>
			<div id="content">
				<h2>Se connecter en administrateur</h2>
				<form action="index_auth_admin.php" method="POST">
					Mot de passe: <input type="text" name="passwd" value="">
					<br><br>
					<input type="submit" name="submit" value="OK"></form>
<?php
				$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
				if (!$connect) {
					die("Connection failed: " . mysqli_connect_error()."<br />");
				}
				if (isset($_POST['passwd']) && $_POST['passwd'] == $motdepass){
					$reqname = "SELECT id, adminlevel FROM `user`";
					$result = mysqli_query($connect, $reqname);
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							if ($row['id'] == $_SESSION['loggued_on_user'])
								$id = $row['id'];
							break;
						}
					}
					$reqname2 = "UPDATE user SET adminlevel='1' WHERE id ='$id'";
					if (mysqli_query($connect, $reqname2)){
						$_SESSION["SUCCES"] = "Modification reussi";
						echo '<script language="Javascript">document.location.replace("index.php");</script>';
				}
				}
				mysqli_close($connect);
				?>
		</div>
	</body>
</html>
