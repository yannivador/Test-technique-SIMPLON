<?php
    session_start();

    $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location: ../login.php');
    }

    $choix_menu = 2;
    
    require('../class/Gestion.php');
    require('../configuration.php');

    $gestion = new Gestion();
    $mysqli  = $gestion->connexionBDD();

    // récupération  variables
    if (isset($_POST['submit_form'])) {
        $utilisateur_nom   = $_POST['utilisateur_nom'];

        // varification de si les varialbes sont vides
        if (empty($utilisateur_nom)) {
            $message = '<p class="error">Vous devez saisir le nom d\'un utilisateur</p>';
        }

        else {
            // Vérifie si la ville existe dans la base
            $result = $mysqli->query('SELECT count(utilisateur_nom) FROM utilisateur WHERE utilisateur_nom = "' . $utilisateur_nom . '"');

            $row = $result->fetch_array();

            if ($row[0] > 0) {
                $message = '<p class="error">Ce nom est déjà enregistrée</p>';
            }

            else {
                // requete insert
                $req = 'INSERT INTO utilisateur (utilisateur_nom) VALUES ("' . $utilisateur_nom . '")';
                if ($mysqli->query($req)) {

                    $message = '<p class="message">L\'ajout de l\'utilisateur ' . $utilisateur_nom . ' est effectué. <br><a href="../index.php">Retour a la page d\'accueil</a> </p>';
                }

                else {
                    $message = '<p class="error">L\'ajout de l\'utilisateur ' . $utilisateur_nom . ' n\'est pas effectué. </p>';	
                }
            }
            
                
        }

        
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ajouter un utilisateur</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/styles.css'>
</head>

<body>
    <div id="container">
        <header class="grid un">
            <?php require('../main-header.php'); ?>
            <?php require('../menu.php'); ?>
        </header>
        <div id="login-container">
            <h1>Ajouter un utilisateur</h1>
            <?php if (isset($message) ) { echo $message; } ?>
            <form method="POST">
                <p>Nom de l'utilisateur :  <input type="text" name="utilisateur_nom" /></p>
                
                <p><input type="submit" name="submit_form" value="valider"></p>
            </form>
        </div>
    </div>
</body>
</html>