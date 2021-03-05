<?php
	session_start();
	include 'database.php';
	$DB = new Database();

	if (isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}

	if (!empty($_POST)){
		extract($_POST);
		$valid = true;

		if(isset($_POST['inscription'])){
			$nomPrenom = htmlentities(trim($nomPrenom));
			$pseudo = htmlentities(trim($pseudo));
			$email = htmlentities(strtolower(trim($email)));
			$motDePasse = htmlentities(trim($motDePasse));
			$confmotDePasse = htmlentities(trim($confmotDePasse));

			if(empty($nomPrenom)){
				$valid = false;
				$er_nomPrenom = ("Le Prénom et le Nom ne peut pas être vide");
			}

			if(empty($pseudo)){
				$valid = false;
				$er_pseudo = ("Le Pseudonye ne peut pas être vide");
			}

			if(empty($email)){
				$valid = false;
				$er_email = "L'Email ne peut pas être vide";
			} elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){
				$valid = false;
				$er_email = ("L'Email n'est pas valide");
			} else {
				$req_email = $DB->query("SELECT email FROM utilisateur WHERE email = ?",
				array($email));
				$req_email = $req_email->fetch();

				if ($req_email['email'] <> ""){
					$valid = false;
					$er_email = ("Cet Email existe déjà");
				}
			}

			if(empty($motDePasse)){
				$valide = false;
				$er_motDePasse = ("Le mot de passe ne peut être vide");
			} elseif($motDePasse != $confmotDePasse){
				$valid = false;
				$er_motDePasse = ("La confirmation du mot de passe ne correspond pas");
			}

			if($valid){
				$motDePasse = ($motDePasse);
				$dateInscription = date('Y-m-d H:i:s');

				$DB->insert("INSERT INTO utilisateur (nomPrenom, pseudo, email, motDePasse, dateInscription) VALUES (?, ?, ?, ?, ?)",
					array($nomPrenom, $pseudo, $email, $motDePasse, $dateInscription));

					header('Location: login.php');
					exit;
			}
		}
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
		<title>Chateau de Carte - Inscription</title>
	</head>

	<body>
		<div class="container">
			<h1>Inscription</h1>
			<div class="row">
				<form method="post">
					<?php
						if (isset($er_nomPrenom)){
					?>
						<strong><?= $er_nomPrenom ?></strong>
					<?php
						}
					?>
					<label class="control-label">Prénom et Nom</label>
					<div class="controls">
						<input type="text" placeholder="Jean Castex" name="nomPrenom" value="<?php if(isset($nomPrenom)){ echo $nomPrenom;} ?>" required/>
						<?php
							if (isset($er_pseudo)){
						?>
							<strong><?= $er_pseudo ?></strong>
						<?php
							}
						?>
					</div>
					<br/>

					<label class="control-label">Pseudonyme</label>
					<div class="controls">
						<input type="text" placeholder="J34N C4ST3X" name="pseudo" value="<?php if (isset($pseudo)){ echo $pseudo;} ?>" required/>

						<?php
							if (isset($er_email)){
						?>
							<strong><?= $er_email ?></strong>
						<?php
							}
						?>
					</div>
					<br/>

					<label class="control-label">Email</label>
					<div class="controls">
						<input type="email" placeholder="jeancastex93@gmail.com" name="email" value="<?php if(isset($email)){ echo $email;} ?>" required/>

						<?php
							if (isset($er_motDePasse)){
						?>
							<strong><?= $er_motDePasse ?></strong>
						<?php
							}
						?>
					</div>
					<br/>

					<label class="control-label">Mot de Passe</label>
					<div class="controls">
						<input type="password" placeholder="Mot de passe" name="motDePasse" value="<?php if(isset($motDePasse)){ echo $motDePasse;} ?>" required/>
					</div>
					<br/>

					<label class="control-label">Confirmer le mot de passe</label>
					<div class="controls">
						<input type="password" placeholder="Confirmez le mot de passe" name="confmotDePasse" required/>
					</div>
					<br/>
					<button class="btn btn-success" type="submit" name="inscription">S'inscrire</button>
					<button class="btn btn-outline-info my-1" type="button" href="<?= 'login.php' ?>">J'ai déjà un compte</button>
				</form>
			</div>
		</div>
	</body>
</html>