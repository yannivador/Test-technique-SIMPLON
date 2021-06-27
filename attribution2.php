<?php
    session_start();

    $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location:login.php');
    }

    $choix_menu = 1;

    require('class/Gestion.php');
    require('configuration.php');

    $gestion = new Gestion();

    $mysqli  = $gestion->connexionBDD();

    include('process/ajout_attribution.php');

    // var_dump($_POST);

    //  Récupération des post

    if (isset($_POST['ordi'])) {
        $ordi_choisi = $_POST['ordi'];
    }

    if (isset($_POST['utilisateur_choisi'])) {
        $utilisateur_choisi = $_POST['utilisateur_choisi'];
    }

    if (isset($_POST['date_choisi'])) {
        $date_choisi = $_POST['date_choisi'];
    }


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
    <div id="container">    
        <header class="grid un">
            <?php require('main-header.php'); ?>
            <?php require('menu.php'); ?>
        </header>
        <div id="login-container" >
            <form action="attribution2.php" method="POST" >
                <h1>Formulaire d'attribution</h1>
                <span>Etape 2/2</span>
                <input name="utilisateur_choisi" type="hidden" value="<?php if (isset($utilisateur_choisi)) { echo $utilisateur_choisi;} ?>">
                <input name="ordi_choisi" type="hidden" value="<?php if (isset($ordi_choisi)) { echo $ordi_choisi;} ?>">
                <input name="date_choisi" type="hidden" value="<?php if (isset($date_choisi)) { echo $date_choisi;} ?>">
                <p>
                    <label>Début : </label>
                    <input type="time" name="debut_horaire">
                </p>
                <p>
                    <label>Fin : </label>
                    <input type="time" name="fin_horaire">
                </p>

                <p>
                    <input name="submit_form" type="submit" value="Envoyer">
                </p>
                <a href="attribution.php">Précédent</a>
            </form>
            <p style="background-color: green;"><?php if (isset($message)) { echo $message;} ?></p>
        </div>
    </div>
</body>
<?php
    $gestion->closeConnexion($mysqli);

?>
</html>