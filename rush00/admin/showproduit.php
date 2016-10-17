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
	$reqname = "SELECT * FROM `produit`";
	$result = mysqli_query($connect, $reqname);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
        	?>
        	<div>
        	<form method="post" action="updateproduit.php" enctype="multipart/form-data">
		        Nom du produit : <input type="text" name="nameprod" value=<?php echo $row['name'];?>  /><BR />
		        Prix du produit :<input type="text" name="prixprod" value=<?php echo $row['prix'];?> /><BR />
		        <input type="hidden" name="idprod" value=<?php echo $row['id'];?> />
		        <input type="submit" name="submit" value="Update"/><BR />
		    </form>
        	<?php
        		$reqidcat = "SELECT * FROM `prodcat` WHERE idprod='".$row['id']."'";
				$resultidcat = mysqli_query($connect, $reqidcat);
				if (mysqli_num_rows($resultidcat) > 0) {
					echo "Categorie(s):<BR>";
					while($row2 = mysqli_fetch_assoc($resultidcat)) {
						$reqnamecat = "SELECT * FROM `categ` WHERE id='".$row2['idcat']."'";
						$resultnamecat = mysqli_query($connect, $reqnamecat);
						if (mysqli_num_rows($resultnamecat) > 0) {
							while($row3 = mysqli_fetch_assoc($resultnamecat)) {
								echo "- ".$row3['name']."<BR>";
							}
							echo mysqli_error($connect);
						}
						echo mysqli_error($connect);
					}
					echo mysqli_error($connect);
				}
				else
					echo "Aucune categorie!";
        	?>
        	<form method="post" action="delproduit.php" enctype="multipart/form-data">
        		<input type="hidden" name="idprod" value=<?php echo $row['id'];?> />
        		<input type="submit" name="submit" value="X"/>
    		</form>
    		<form method="post" action="addcattoprod.php" enctype="multipart/form-data">
    			<input list="namecat" name="namecat">
				<datalist name="namecat" id="namecat">
				<?php
				$reqnamecat = "SELECT * FROM `categ`";
				$resultnamecat = mysqli_query($connect, $reqnamecat);
				if (mysqli_num_rows($resultnamecat) > 0) {
					while($row4 = mysqli_fetch_assoc($resultnamecat)) {
					?>
					<option value=<?php echo $row4['id'];?>>
					<?php echo $row4['name'];?>
					</option>
					<?php
					}
				}
				    ?>
				    
				</datalist> 

        		<input type="hidden" name="idprod" value=<?php echo $row['id'];?> />
        		<input type="submit" name="submit" value="Ajouter une categorie"/>
    		</form>
        	</div>
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