<?php
	require('database.php');
	//on appelle notre fichier de config
	$id = null;
	$tableau = null;
		if (!empty($_GET['id']))
		{
			$id = $_REQUEST['id'];
		}
		if (!empty($_GET['tableau']))
		{
			$tableau = $_REQUEST['tableau'];
		}


		if (null == $id || null == $tableau)
		{ //header("location:index.php");
		} else {
		//on lance la connection et la requete
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) .


		$sql = "";
		$liste = [];
		$titres = [];

		if($tableau == 'utilisateur'){
			$sql = "SELECT * FROM utilisateur WHERE id = ?";
			$liste = ['id', 'nomPrenom', 'pseudo', 'email', 'motDePasse', 'dateInscription'];
			$titres = ['ID', 'Nom / Prénom', 'Pseudonyme', 'Email', 'Mot de Passe', 'Date d\'inscription'];
		}
		elseif($tableau == 'achats'){
			$sql = "SELECT * FROM achats WHERE id = ?";
			$liste = ['id', 'email', 'numArticle', 'nombreAchete', 'dateAchat'];
			$titres = ['ID', 'Email', 'Numéro de l\'article', 'Nombre d\'article acheté simultanément' , 'Date de l\'achat'];
		}
		elseif($tableau == 'article'){
			$sql = "SELECT * FROM article WHERE id = ?";
			$liste = ['id', 'numArticle', 'nomArticle', 'prix'];
			$titres = ['ID', 'Numéro de l\'article', 'Nom de l\'article', 'Prix'];
		}

		$query = $pdo->prepare($sql);
		$query->execute(array($id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
		<title>Chateau de Carte - Edition</title>
	</head>

	<body>

		<div class="container">

			<div class="span10 offset1">

				<div class="row">

					<h1>Vue</h1>
					

				</div>
				

				<div class="form-horizontal" >
					<?php
						for ($i=0; $i < count($liste) ; $i++) {
								
						
					?>

					<div class="control-group">
						<label class="control-label">
							<?php
								echo $titres[$i] . " : " . $data[$liste[$i]];
							?>
						</label>

						

					</div>
					<?php
						}
					?>

				</div>
				<div class="form-actions">
					<a class="btn btn-secondary" href="index.php">Retour</a>
					</div>
				

			</div>
			


		</div>
		
		<!-- /container -->
	</body>
</html>