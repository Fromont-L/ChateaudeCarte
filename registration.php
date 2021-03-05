<?php
	session_start();
	include 'database.php';
	
    if (isset($_SESSION['id'])){
        header('Location: index.php'); 
        exit;
    }
 
    // Si la variable "$_Post" contient des informations alors on les traitres
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;
 
        // On se place sur le bon formulaire grâce au "name" de la balise "input"
        if (isset($_POST['inscription'])){
            $nomPrenom  = htmlentities(trim($nomPrenom)); // On récupère le nomPrenom
            $pseudo = htmlentities(trim($pseudo)); // on récupère le prénomPrenom
            $email = htmlentities(strtolower(trim($email))); // On récupère le email
            $motDePasse = trim($motDePasse); // On récupère le mot de passe 
            $confmotDePasse = trim($confmotDePasse); //  On récupère la confirmation du mot de passe
 
            //  Vérification du nomPrenom
            if(empty($nomPrenom)){
                $valid = false;
                $er_nomPrenom = ("Le Prénom et le Nom ne peut pas être vide");
            }       
 
            //  Vérification du prénomPrenom
            if(empty($pseudo)){
                $valid = false;
                $er_pseudo = ("Le Pseudonyme ne peut pas être vide");
            }       
 
            // Vérification du email
            if(empty($email)){
                $valid = false;
                $er_email = ("L'Email ne peut pas être vide");
 
                // On vérifit que le email est dans le bon format
            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){
                $valid = false;
                $er_email = ("L'Email n'est pas valide");
 
            }else{
                // On vérifit que l'adresse email est disponible
                $req_email = $DB->query("SELECT email FROM utilisateur WHERE email = ?",
                    array($email));
 
                $req_email = $req_email->fetch();
 
                if ($req_email['email'] <> ""){
                    $valid = false;
                    $er_email = ("Cet Email existe déjà");
                }
            }
 
            // Vérification du mot de passe
            if(empty($motDePasse)) {
                $valid = false;
                $er_motDePasse = ("Le mot de passe ne peut pas être vide");
 
            }elseif($motDePasse != $confmotDePasse){
                $valid = false;
                $er_motDePasse = ("La confirmation du mot de passe ne correspond pas");
            }
 
            // Si toutes les conditions sont remplies alors on fait le traitement
            if($valid){
 
                $motDePasse = crypt($motDePasse, "$6$rounds=5000$macleapersonnaliseretagardersecret$");
                $dateInscription = date('Y-m-d H:i:s');
 
                // On insert nos données dans la table utilisateur
                $DB->insert("INSERT INTO utilisateur (nomPrenom, pseudo, email, motDePasse, dateInscription) VALUES 
                    (?, ?, ?, ?, ?)", 
                    array($nomPrenom, $pseudo, $email, $motDePasse, $dateInscription));
 
                header('Location: index.php');
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
        <h1>Inscription</h1>
        <form method="post">
            <?php
                // S'il y a une erreur sur le nomPrenom alors on affiche
                if (isset($er_nomPrenom)){
                ?>
                    <div><?= $er_nomPrenom ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Prénom Nom" name="nomPrenom" value="<?php if(isset($nomPrenom)){ echo $nomPrenom; }?>" required>   
            <?php
                if (isset($er_pseudo)){
                ?>
                    <div><?= $er_pseudo ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Exemple123" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>" required>   
            <?php
                if (isset($er_email)){
                ?>
                    <div><?= $er_email ?></div>
                <?php   
                }
            ?>
            <input type="email" placeholder="Adresse email" name="email" value="<?php if(isset($email)){ echo $email; }?>" required>
            <?php
                if (isset($er_motDePasse)){
                ?>
                    <div><?= $er_motDePasse ?></div>
                <?php   
                }
            ?>
            <input type="password" placeholder="Mot de passe" name="motDePasse" value="<?php if(isset($motDePasse)){ echo $motDePasse; }?>" required>
            <input type="password" placeholder="Confirmer le mot de passe" name="confmotDePasse" required>
            <button type="submit" name="inscription">Envoyer</button>
        </form>
    </body>
</html>