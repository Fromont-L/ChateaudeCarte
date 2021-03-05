<?php

	$servername = "localhost";
	$username = "fromont";
	$password = "password";
	$dbname = "Chateau_de_Carte";
	
	//Création de la connexion
	$conn = new mysqli($servername, $username, $password, $dbname);

	//Vérification de la connexion
	if ($conn->connect_error){
		die("Echec de la connexion : " . $conn->connect_error);
	}

	//Création de la base de donnée
	$sql = "DROP DATABASE Chateau_de_Carte";
	if ($conn->query($sql) === TRUE) {
		echo "Base de données supprimée avec succès ! ";
	} else {
		echo "Erreur dans la suppression de la base de données... : " . $conn->error;
	}

	$connection->close();
?>