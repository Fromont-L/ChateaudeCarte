<?php
	require 'database.php';
	$id=0;
	if(!empty($_GET['id']))
		{
			$id=$_REQUEST['id'];
		} if(!empty($_POST))
		{
			$id= $_POST['id'];
			$pdo=Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM utilisateur WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			Database::disconnect();
			header("Location: index.php");
		}

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="CRUD du brief Chateau de Carte"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="img/logo_chat_tot_de_carte.png"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Chateau de Carte - Supprimer</title>
	</head>

	<body>
		<div class="container">
			<div class="span10 offset1">
				<div class="row">
				<h1>Suppression de l'utilisateur</h1>
				</div>
				<form class="form-horizontal" action="delete.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Oui</button>
						<a class="btn btn-secondary" href="index.php">Annuler</a>
					</div>
					<p>
				</form>
			</div>
		</div>
		<!-- /container -->
	</body>
</html>