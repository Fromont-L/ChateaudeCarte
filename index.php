<?php
	//Démarrage de la session
	session_start();

	//Inclure la connexion à la base
	include 'database.php';

	$pdo = Database::connect();

	//Déclaration des variables
	$sql = 'SELECT * FROM `utilisateur`';
	$sql2 = 'SELECT * FROM `achats`';
	$sql3 = 'SELECT * FROM `article`';
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
		<title>Chateau de Carte</title>
	</head>
	<body>

		<div class="container">
			<div class="row">
				<h1>CRUD Chateau de Carte</h1>
			</div>
			<div class="row">
				<a href="add.php" class="btn btn-success">Ajouter un utilisateur</a>
				<a href="logout.php" class="btn btn-danger">Déconnexion</a>
				<div class="table-responsive">
					<h2>Tableau des utilisateurs</h2>
					<table class="table table-hover table-bordered">
						<!--Nom colonnes des utilisateurs-->
						<thead>
							<th>ID</th>
							<th>Nom/Prénom</th>
							<th>Pseudonyme</th>
							<th>Email</th>
							<th>Mot de Passe</th>
							<th>Date d'inscription</th>
							<th>Options</th>
						</thead>
						<tbody>
						<?php
							//Formulation de la requête $sql
							foreach ($pdo->query($sql) as $row) {
						?>
							<tr>
								<td><?= $row['id']?></td>
								<td><?= $row['nomPrenom']?></td>
								<td><?= $row['pseudo']?></td>
								<td><?= $row['email']?></td>
								<td><?= $row['motDePasse']?></td>
								<td><?= $row['dateInscription']?></td>
								<td>
									<a class="btn btn-info btn-sm" href="<?= 'edit.php?id=' . $row['id'] . '&tableau=utilisateur' ?>">Voir</a>
									<a class="btn btn-warning btn-sm" href="<?= 'update.php?id=' . $row['id'] ?>">Update</a>
									<a class="btn btn-danger btn-sm" href="<?= 'delete.php?id=' . $row['id'] ?>">Delete</a>
								</td>
							</tr>
						</tbody>
						<?php
							}
						?>
					
					</table>
					<h2>Tableau des achats</h2>
					<table class="table table-hover table-bordered">

						<!--Nom colonnes des achats-->
						<thead>
							<th>ID</th>
							<th>Email</th>
							<th>N° Article</th>
							<th>Quantité acheté</th>
							<th>Date d'achat</th>
							<th>Options</th>
						</thead>
						<tbody>
						<?php
							//Formulation de la requête $sql2
							foreach ($pdo->query($sql2) as $row2) {
						?>
							<tr>
								<td><?= $row2['id']?></td>
								<td><?= $row2['email']?></td>
								<td><?= $row2['numArticle']?></td>
								<td><?= $row2['nombreAchete']?></td>
								<td><?= $row2['dateAchat']?></td>
								<td>
									<a class="btn btn-info btn-sm" href="<?= 'edit.php?id=' . $row2['id'] . '&tableau=achats' ?>">Voir</a>
									<a class="btn btn-warning btn-sm" href="<?= 'update.php?id=' . $row2['id'] ?>">Update</a>
									<a class="btn btn-danger btn-sm" href="<?= 'delete.php?id=' . $row2['id'] ?>">Delete</a>
								</td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
					<h2>Tableau des articles</h2>
					<table class="table table-hover table-bordered">

						<!--Nom colonnes des articles-->
						<thead>
							<th>ID</th>
							<th>N° Article</th>
							<th>Nom de l'Article</th>
							<th>Prix</th>
							<th>Options</th>
						</thead>
						<tbody>
						<?php
							//Formulation de la requête $sql3
							foreach ($pdo->query($sql3) as $row3) {
						?>
							<tr>
								<td><?= $row3['id']?></td>
								<td><?= $row3['numArticle']?></td>
								<td><?= $row3['nomArticle']?></td>
								<td><?= $row3['prix']?></td>
								<td>
									<a class="btn btn-info btn-sm" href="<?= 'edit.php?id=' . $row3['id'] . '&tableau=article' ?>">Voir</a>
									<a class="btn btn-warning btn-sm" href="<?= 'update.php?id=' . $row3['id'] ?>">Update</a>
									<a class="btn btn-danger btn-sm" href="<?= 'delete.php?id=' . $row3['id'] ?>">Delete</a>
								</td>
							</tr>
							<?php
								}
								//on se deconnecte de la base
								Database::disconnect();
							;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>