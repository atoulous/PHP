<?php
if (session_id() == ""){ 
	session_start();
}
include("../include/db.php");
if (isset($_SESSION['ERROR'])){
	echo $_SESSION['ERROR'];
	unset($_SESSION['ERROR']);
}
if (isset($_SESSION['adminlevel']) && isset($_SESSION['login']) && $_SESSION['adminlevel'] == "1" && $_SESSION['login'] !=""){
	$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error()."<br />");
	}
	$reqname = "SELECT * FROM `categ`";
	$result = mysqli_query($connect, $reqname);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
        	?>
        	<div>
        	<form method="post" action="updatecategorie.php" enctype="multipart/form-data">
		        Nom de la categorie : <input type="text" name="namecateg" value=<?php echo $row['name'];?>  />
		        <input type="hidden" name="idcateg" value=<?php echo $row['id'];?> />
		        <input type="submit" name="submit" value="Update"/>
		    </form>
        	<form method="post" action="delcategorie.php" enctype="multipart/form-data">
        		<input type="hidden" name="idcateg" value=<?php echo $row['id'];?> />
        		<input type="submit" name="submit" value="X"/>
    		</form>
        	<?php
    	}
	} 
	else {
		echo "Aucun produit !<BR />";
	}
}
else{
	echo "Restricted Area";
}
?>