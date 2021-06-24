<?php
    session_start();

    $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location: ../login.php');
    }

    require('../class/Gestion.php');
    require('../configuration.php');

    $gestion = new Gestion();
    $mysqli  = $gestion->connexionBDD();

    // récupération  variables
    if (isset($_POST['submit_form'])) {
        $ordi_nom   = $_POST['ordi_nom'];

        // varification de si les varialbes sont vides
        if (empty($ordi_nom)) {
            $message = '<p class="error">Vous devez saisir le nom d\'un ordi</p>';
        }

        else {
            // Vérifie si la ville existe dans la base
            $result = $mysqli->query('SELECT count(ordi_nom) FROM ordi WHERE ordi_nom = "' . $ordi_nom . '"');

            $row = $result->fetch_array();

            if ($row[0] > 0) {
                $message = '<p class="error">Ce nom est déjà enregistrée</p>';
            }

            else {
                // requete insert
                $req = 'INSERT INTO ordi (ordi_nom) VALUES ("' . $ordi_nom . '")';
                if ($mysqli->query($req)) {

                    $message = '<p class="message">L\'ajout de l\'ordi ' . $ordi_nom . ' est effectué. <br><a href="../index.php">Retour a la page d\'accueil</a> </p>';
                }

                else {
                    $message = '<p class="error">L\'ajout de l\'ordi ' . $ordi_nom . ' n\'est pas effectué. </p>';	
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
    <title>Ajouter un ordi</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>
</head>

<body>
    <div>
        <h1>Ajouter un ordi</h1>
        <?php if (isset($message) ) { echo $message; } ?>
        <form method="POST">
            <p>Nom de l'ordi :  <input type="text" name="ordi_nom" /></p>
            
            <p><input type="submit" name="submit_form" value="valider"></p>
        </form>
    </div>
</body>
</html>