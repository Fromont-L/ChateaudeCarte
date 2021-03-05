<?php
	session_start();
	include('database.php');
	$DB = new Database();

	if (isset($_SESSION['id'])){
		header('location: index.php');
		exit;
	}

	if (isset($_POST)){
		extract($_POST);
		$valid = true;

		if (isset($_POST['connect'])){
			$pseudo = htmlentities(trim($pseudo));
			$motDePasse = htmlentities(trim($motDePasse));

			if (empty($pseudo)){
				$valid = false;
				$er_motDePasse = "Veuillez entrer votre mot de passe";

			}

			$req = $DB->query("SELECT * FROM utilisateur WHERE pseudo = ? AND motDePasse = ?",
			array($pseudo, $motDePasse));
			$req = $req->fetch();

			if ($req['id'] == ""){
				$valid = false;
				$er_pseudo = "Votre Pseudo ou votre Mot de Passe et incorrect";
			}

			if($req['token'] <> NULL){
				$valid = false;
				$er_pseudo = "Le compte n'a pas été validé";
			}

			if ($valid){
				$_SESSION['id'] = $req['id'];
				$_SESSION['nomPrenom'] = $req['nomPrenom'];
				$_SESSION['pseudo'] = $req['pseudo'];
				$_SESSION['email'] = $req['email'];
				$_SESSION['motDePasse'] = $req['motDePasse'];

				header('location: index.php');
				exit;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="CRUD du brief Chateau de Carte"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="img/logo_chat_tot_de_carte.png"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Chateau de Carte - Connexion</title>
	</head>

	<body>
		<div class="container">
			<h1>Espace de Connexion</h1>
			<form method="post">
				<div class="control-group">
					<label class="control-label">Pseudonyme</label>
					<div class="controls">
						<?php if (isset($er_pseudo)){ ?>
							<strong><?= $er_pseudo ?></strong>
						<?php } ?>
						<input type="text" placeholder="Josédu11" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; } ?>" required/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Mot de Passe</label>
					<div class="controls">
						<?php if (isset($er_motDePasse)){ ?>
							<strong><?= $er_motDePasse ?></strong>
						<?php } ?>
						<input type="password" placeholder="************" name="motDePasse" value="<?php if(isset($motDePasse)){ echo $motDePasse; } ?>" required/>
					</div>
				</div>
				<br/>
				<button class="btn btn-primary" type="submit" name="connect">Se connecter</button>
			</form>
		</div>

	</body>
</html>