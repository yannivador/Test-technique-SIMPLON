<?php
    session_start();

    $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location:login.php');
    }

    require('../class/Gestion.php');
    require('../configuration.php');

    $gestion = new Gestion();
    $mysqli  = $gestion->connexionBDD();

    if (isset($_GET['id']) AND isset($_GET['cible'])) {
        // echo $_GET['id'];
        $id    = $_GET['id'];
        $cible =  $_GET['cible'];

        $req = 'DELETE FROM ' .$cible. ' WHERE ' .$cible. '_id = ' .$id;

        // echo $req;

        if ($mysqli->query($req)) {
            $message = '<p class="message">La donné a bien été supprimée dans la base.<br></p>';
            $message .= '<a href="../index.php">Retour page administration</a>';
            echo $message;
            
        }
        else {
            $message = '<p class="error">Erreur de la suppression</p>';
            echo $message;
        }
    }
		

?>

