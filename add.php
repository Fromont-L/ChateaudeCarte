<?php
	require 'database.php';
	if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)){
	//on initialise nos messages d'erreurs;
	/*
	$idError = '';
	$nomPrenomError = '';
	$pseudoError = '';
	$motDePasseError = '';
	$emailError = '';
	$paysError = '';
	$commentError = '';
	$metierError = '';
	$urlError = '';
	*/
	//on recupère nos valeurs
	$id = htmlentities(trim($_POST['id']));
	$nomPrenom = htmlentities(trim($_POST['nomPrenom']));
	$pseudo = htmlentities(trim($_POST['pseudo']));
	$motDePasse = htmlentities(trim($_POST['motDePasse']));
	$email = htmlentities(trim($_POST['email']));
	//$dateInscription = htmlentities(trim($_POST['dateInscription']));
	//on vérifie nos champs
	/*
	$valid = true; if (empty($id)) {
		$idError = 'Please enter an ID'; $valid = false;
		} else if (!preg_match("/^[a-zA-Z ]*$/",$id)) {
			$idError = "Only letters and white space allowed";
		} if(empty($nomPrenom)){
			$nomPrenomError ='Please enter nomPrenom'; $valid= false;
	} else if (!preg_match("/^[a-zA-Z ]*$/",$id)) {
		$id = "Only letters and white space allowed";
	}
		if (empty($email)) {
			$emailError = 'Please enter Email Address'; $valid = false;
	} else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$emailError = 'Please enter a valid Email Address'; $valid = false;
	}
		if (empty($pseudo)) {
			$pseudoError = 'Please enter your pseudo'; $valid = false;
		}
		if (empty($motDePasse)) {
			$motDePasseError = 'Please enter phone'; $valid = false;
	} else if (!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#",$motDePasse))
	{
		$motDePasseError = 'Please enter a valid phone'; $valid = false;
	}
	*/
	// si les données sont présentes et bonnes, on se connecte à la base
	//if ($valid) {


	// Remplacer tous les noms et enlever les choses inutiles, puis mettre les <imput> adéquat pour chaque champ à remplir


		$pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO utilisateur (id, nomPrenom, pseudo, email, motDePasse) values(?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id, $nomPrenom, $pseudo, $email, $motDePasse));
		Database::disconnect();
		header("Location:index.php");
		//}
	}
?>
<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="CRUD du brief Chateau de Carte"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="img/png" href="img/logo_chat_tot_de_carte.png"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Chateau de Carte - Ajouter</title>
	</head>
	<body>

		<div class="container">

			<div class="row">
			<h1>Ajouter un contact</h1>
			</div>

			<form method="post" action="add.php">

				<!--ID-->
				<div class="control-group">
					<label class="control-label">N°ID</label>

					<div class="controls">
						<input name="id" type="number"  placeholder="1" value="<?php echo !empty($id)?$id:'';?>">
					</div>
				</div>
				<br/>

				<!--Nom et Prénom-->
				<div class="control-group">
					<label class="control-label">Prénom et Nom</label>

					<div class="controls">
						<input name="nomPrenom" type="text" placeholder="José Garcia" value="<?php echo !empty($nomPrenom)?$nomPrenom:''; ?>">
					</div>
				</div>
				<br/>

				<!--Pseudo-->
				<div class="control-group">
					<label class="control-label">Pseudonyme</label>

					<br />
					<div class="controls">
						<input name="pseudo" type="text" placeholder="Josédu11" value="<?php echo !empty($pseudo) ? $pseudo:'';?>">
					</div>
				</div>
				<br/>

				<!--Email-->
				<div class="control-group">
					<label class="control-label">Email Address</label>

					<div class="controls">
						<input name="email" type="email" placeholder="randomemail@gmail.com" value="<?php echo !empty($email)?$email:'';?>">
					</div>
				</div>
				<br/>

				<!--Mot de Passe-->
				<div class="control-group">
					<label class="control-label">Mot de Passe</label>
					<br />
					<div class="controls">
						<input name="motDePasse" type="password" placeholder="************" value="<?php echo !empty($motDePasse) ? $motDePasse:'';?>">
					</div>
				</div>
				<br/>

				<div class="form-actions">
					<input type="submit" class="btn btn-success" name="submit" value="Envoyer">
					<a class="btn btn-secondary" href="index.php">Retour</a>
				</div>
			</form>
		</div>
	</body>
</html>