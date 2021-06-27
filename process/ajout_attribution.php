<?php 
    // session_start();

    // $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location:login.php');
    }

    // require('../class/Gestion.php');
    // require('../configuration.php');

    $gestion = new Gestion();
    $mysqli  = $gestion->connexionBDD();

    if (isset($_POST['submit_form'])) {
        $debut_horaire = $_POST['debut_horaire'];
        $fin_horaire   = $_POST['fin_horaire'];
        $utilisateur   = $_POST['utilisateur_choisi'];
        $ordi          = $_POST['ordi_choisi'];
        $date_choisi   = $_POST['date_choisi'];
        // var_dump($_POST);

        if (empty($debut_horaire) OR empty($fin_horaire)) {
            $message = '<p>Tous les champs n\'ont pas été remplis</p>';
        } else {
            $req = 'INSERT INTO attribution (attribution_id, attribution_utilisateur_id, attribution_ordi_id, attribution_date, attribution_horaire_debut, attribution_horaire_fin) VALUES (NULL, "' .$utilisateur. '", "' .$ordi. '", "' .$date_choisi. '", "' .$debut_horaire. '", "' .$fin_horaire. '");';
            if ($mysqli->query($req)) {

                $message = '<p class="message">Ajout attribution effectué. <br><a href="index.php">Retour a la page d\'accueil</a> </p>';
            }

            else {
                $message = '<p class="error">Erreur dans l\'ajout de l\'attribution. </p>';	
            }
        }
    }

?>