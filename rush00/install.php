<?php 
include("include/db.php");
$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);

if (!$connect){
	echo "Connection failed<br />";
	echo "Try to create DB<br />";
	$connect = mysqli_connect($hostdb, $userdb, $pwdb);
	$sql = "CREATE DATABASE IF NOT EXISTS `minishop`";
	if (mysqli_query($connect, $sql)) {
    	echo "Database created successfully<br />";
	} 
	else {
    	echo "Error creating database: " . mysqli_error($connect)."<br />";
	}
	mysqli_close($connect);
	echo "Try to connect <br />";
	$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
	if (!$connect) {
    	die("Connection failed: " . mysqli_connect_error()."<br />");
	}
}
if($connect)
{
	$ctableuser = "CREATE TABLE IF NOT EXISTS `user` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`email` VARCHAR(255),
	`nom` VARCHAR(100),
	`prenom` VARCHAR(100),
	`password` VARCHAR(128),
	`adminlevel` INT(1),
	`numero` VARCHAR(10),
	`adresse` TEXT,
	`codepostal` INT(5),
	`ville` VARCHAR(45)
	)";
	if (mysqli_query($connect, $ctableuser)) {
    	echo "Table user created successfully<br />";
	} 
	else {
    	echo "Error creating table: " . mysqli_error($connect)."<br />";
	}
	$ctableproduit = "CREATE TABLE IF NOT EXISTS `produit`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` TEXT,
	`prix` DECIMAL(10,2)
	)";
	if (mysqli_query($connect, $ctableproduit)) {
    	echo "Table produit created successfully<br />";
	} 
	else {
    	echo "Error creating table: " . mysqli_error($connect)."<br />";
	}
	$ctablecateg = "CREATE TABLE IF NOT EXISTS `categ`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` TEXT
	)";
	if (mysqli_query($connect, $ctablecateg)) {
    	echo "Table categ created successfully<br />";
	} 
	else {
    	echo "Error creating table: " . mysqli_error($connect)."<br />";
	}
	$ctablecategprod = "CREATE TABLE IF NOT EXISTS `prodcat`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`idcat` INT NOT NULL,
	`idprod` INT NOT NULL
	)";
	if (mysqli_query($connect, $ctablecategprod)) {
    	echo "Table prodcat created successfully<br />";
	} 
	else {
    	echo "Error creating table: " . mysqli_error($connect)."<br />";
	}
	$ctableuser = "CREATE TABLE IF NOT EXISTS `panier`(
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`idprod` INT NOT NULL,
	`iduser` INT NOT NULL,
	`quantite` INT NOT NULL
	)";
	if (mysqli_query($connect, $ctableuser)) {
    	echo "Table user created successfully<br />";
	} 
	else {
    	echo "Error creating table: " . mysqli_error($connect)."<br />";
	}
	mysqli_close($connect);
}
?>
<a href="index.php"> Aller à index.php</a>