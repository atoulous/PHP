<?PHP

header("Location: index_panier.php");
if (session_id() == "") {
	session_start();
}
include("include/db.php");
if (($_POST["idproduct"] && is_numeric($_POST['idproduct']) && (!$_SESSION["loggued_on_user"]) || ($_SESSION["loggued_on_user"] && $_SESSION["panier"])))
{
	$i = 0;
	$panier = unserialize($_SESSION['panier']);
	while ($panier[$i])
	{
		if ($panier[$i]['idproduct'] == $_POST['idproduct'])
		{
			$panier[$i]['quantite'] += 1;
			break ;
		}
		$i++;
	}
	$_SESSION['panier'] = serialize($panier);
}
else if (($_POST["idproduct"] && is_numeric($_POST['idproduct']) && $_SESSION["loggued_on_user"] !="" && !$_SESSION["panier"])){
	$connect = mysqli_connect($hostdb, $userdb, $pwdb, $namedb);
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error()."<br />");
	}
	$idprod = $_POST['idproduct'];
	$iduser = $_SESSION['loggued_on_user'];
	$quantite = "1";
	$sql="SELECT * FROM `Panier` WHERE iduser='".$_SESSION['loggued_on_user']."' AND idprod='".$idprod."'";
	if(($result = mysqli_query($connect, $sql)) != FALSE){
		if (mysqli_num_rows($result) > 0) {
			if($row = mysqli_fetch_assoc($result)) {
				$sqlinser="UPDATE `Panier` SET quantite=quantite+1 WHERE id='".$row['id']."'";
				$result = mysqli_query($connect, $sqlinser);
			}
		}
		echo mysqli_error($connect);
	}
}
?>