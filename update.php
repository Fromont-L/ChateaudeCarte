<?php
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id']))
	{
		$id = $_REQUEST['id'];
	}
	if ( null==$id )
	{
		header("Location: index.php");
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
		//normalement on initialise nos erreurs

		//on récupère nos valeurs
		$id = $_POST['id'];
		$nomPrenom = $_POST['nomPrenom'];
		$pseudo = $_POST['pseudo'];
		$motDePasse = $_POST['motDePasse'];
		$email = $_POST['email'];
		//normalement on vérifie que les champs sont remplis
	}
	// mise à jour des donnés
	$valid = true;
	if ($valid)

	{
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "UPDATE utilisateur SET id = ?, nomPrenom = ?, pseudo = ?, email = ?, motDePasse = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id, $nomPrenom, $pseudo, $email, $motDePasse));
		Database::disconnect();
		header("Location: index.php");
	}
	else
	{
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM utilisateur WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id = $data['id'];
		$nomPrenom = $data['nomPrenom'];
		$pseudo = $data['pseudo'];
		$motDePasse = $data['motDePasse'];
		Database::disconnect();
	}
?>
	<!---------------------DEBUT DU CHEMIN A SUIVRE-------------------------->
	<?php/* require 'database.php';
	$id = null;
	if ( !empty($_GET['id']))
	{
		$id = $_REQUEST['id'];
	}
	if ( null==$id )
	{
		header("Location: index.php");
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST))
	{
	// on initialise nos erreurs
	$nameError = null; $firstnameError = null; $ageError = null; $telError = null; $emailError = null; $paysError = null; $commentError = null; $metierError = null; $urlError = null;
	// On assigne nos valeurs
	$name = $_POST['name'];
	$firstname = $_POST['firstname'];
	$age = $_POST['age'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$pays = $_POST['pays'];
	$comment = $_POST['comment'];
	$metier = $_POST['metier'];
	$url = $_POST['url'];
	// On verifie que les champs sont remplis
	$valid = true;
	if $valid
	if (empty($name))
	{
		$nameError = 'Please enter Name'; $valid = false;
	}
	if (empty($firstname))
	{
		$firstnameError = 'Please enter firstname';
		$valid = false;
	}
	if (empty($email))
	{
		$emailError = 'Please enter Email Address';
		$valid = false;
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
	$emailError = 'Please enter a valid Email Address';
	$valid = false;
	}
	if (empty($age))
	{
		$ageError = 'Please enter your age';
		$valid = false;
	}
	if (empty($tel))
	{
		$telError = 'Please enter phone';
		$valid = false;
	}
	if (!isset($pays))
	{
		$paysError = 'Please select a country';
		$valid = false;
	}
	if (empty($comment))
	{
		$commentError = 'Please enter a description';
		$valid = false;
	}
	if (!isset($metier))
	{
		$metierError = 'Please select a job';
		$valid = false;
	}
	if (empty($url))
	{
		$urlError = 'Please enter website url';
		$valid = false;
	}
	// mise à jour des donnés
	if ($valid)
	{
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "UPDATE user SET name = ?,firstname = ?,age = ?,tel = ?, email = ?, pays = ?, comment = ?, metier = ?, url = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$firstname, $age, $tel, $email,$pays,$comment, $metier, $url,$id));
		Database::disconnect();
		header("Location: index.php");
	} 
           }
           else
           {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM user where id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $name = $data['name'];
                $firstname = $data['firstname'];
                $age = $data['age'];
                $tel = $data['tel'];
                $email = $data['email'];
                $pays = $data['pays'];
                $comment = $data['comment'];
                $metier = $data['metier'];
                $url = $data['url'];
                Database::disconnect();
            }
        */
        ?>
        <!---------------FIN DU CHEMIN A SUIVRE--------------------->

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

			<form method="post" action="update.php?id=<?= $id ;?>">

				<!--ID-->
				<div class="control-group">
					<label class="control-label">N°ID</label>

					<div class="controls">
						<input name="id" type="text"  placeholder="1" value="<?php echo !empty($id)?$id:'';?>">
					</div>
				</div>
				<br/>

				<!--Nom et Prénom-->
				<div class="control-group">
					<label class="control-label">Prénom et Nom</label>

					<div class="controls">
						<input type="text" name="nomPrenom" placeholder="José Garcia" value="<?php echo !empty($nomPrenom)?$nomPrenom:''; ?>">
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
						<input name="email" type="text" placeholder="randomemail@gmail.com" value="<?php echo !empty($email)?$email:'';?>">
					</div>
				</div>
				<br/>

				<!--Mot de Passe-->
				<div class="control-group">
					<label class="control-label">Mot de Passe</label>
					<br />
					<div class="controls">
						<input name="password" type="text" placeholder="************" value="<?php echo !empty($motDePasse) ? $motDePasse:'';?>">
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