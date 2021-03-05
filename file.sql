-- Création de variables pour la date



-- Création des tables

-- Création de la table "utilisateur"

CREATE TABLE utilisateur (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nomPrenom VARCHAR(60) NOT NULL,
	pseudo VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	motDePasse VARCHAR(50) NOT NULL,
	dateInscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
	);

-- Création de la table "achats"

CREATE TABLE achats (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(30) NOT NULL,
	numArticle INT(6) NOT NULL,
	nombreAchete INT(3) NOT NULL,
	dateAchat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
	);

-- Création de la table "article"

CREATE TABLE article (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	numArticle INT(6) NOT NULL,
	nomArticle VARCHAR(70) NOT NULL,
	prix VARCHAR(10) NOT NULL
	);

-- Insertion des valeurs pour chaques tables

-- Insertion des valeurs pour la table "utilisateur"

INSERT INTO utilisateur (nomPrenom, pseudo, email, motDePasse, dateInscription) VALUES
	('Jacky Palette', 'JP420', 'jackypalette11@gmail.com', 'password', '2004-01-23');

-- Insertion des valeurs pour la table "achats"

INSERT INTO achats (email, numArticle, nombreAchete, dateAchat) VALUES
	('jackypalette11@gmail.com', '2', '2', '2004-01-24');

-- Insertion des valeurs pour la table "article"

INSERT INTO article (numArticle, nomArticle, prix) VALUES
	('1', 'Carte Pokémon', '4,99€'),
	('2', 'Carte Magic', '3,50€');

ALTER TABLE `utilisateur`
	ADD KEY (`email`);

ALTER TABLE `achats`
	ADD KEY (`numArticle`);