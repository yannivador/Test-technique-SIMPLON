<?php
    session_start();

    $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location:login.php');
    }

    require('class/Gestion.php');
    require('configuration.php');

    $gestion = new Gestion();

    $mysqli       = $gestion->connexionBDD();
    $utilisateurs = $gestion->selectAllutilisateur();
    $ordinateurs  = $gestion->selectAllordinateur();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Attribution</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>
    <!-- <script src='main.js'></script> -->
</head>

<body>
    <div id="login-container">
        <form action="attribution2.php" method="POST" >
            <h1>Formulaire d'attribution</h1>
            <p>
                <label>Utilisateur : </label>
                <select name="utilisateur" >
                    <?php
                         if (empty($utilisateurs)) {
                            echo '<option value="">Aucun utilisateur enregistré</option>';
                        } else {
                            foreach ($utilisateurs as $utilisateur) {
                                echo '<option value="' .$utilisateur['utilisateur_nom']. '">' .$utilisateur['utilisateur_nom']. '</option>';
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label>Ordinateur : </label>
                <select name="ordi" >
                    <?php
                         if (empty($ordinateurs)) {
                            echo '<option value="">Aucun ordinateur enregistré</option>';
                        } else {
                            foreach ($ordinateurs as $ordinateur) {
                                echo '<option value="' .$ordinateur['ordi_nom']. '">' .$ordinateur['ordi_nom']. '</option>';
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label>Date : </label>
                <input name="date_choisi" type="date" size="16" />
            </p>

            <p>
                <input name="submit-form" type="submit" value="Suivant">
            </p>
        </form>
    </div>
</body>
<?php
    $gestion->closeConnexion($mysqli);

?>
</html>