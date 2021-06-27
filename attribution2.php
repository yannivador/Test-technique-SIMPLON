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

    var_dump($_POST);

    //  Récupération des post

    if (isset($_POST['ordi'])) {
        $ordi_choisi = $_POST['ordi'];
    }

    if (isset($_POST['utilisateur'])) {
        $utilisateur_choisi = $_POST['utilisateur'];
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
    <div id="login-container">
        <form action="attribution2.php" method="POST" >
            <h1>Formulaire d'attribution</h1>
            <p><?php if (isset($utilisateur_choisi)) { echo $utilisateur_choisi;} ?></p>
            <p>Horaire disponible pour <?php if(isset($ordi_choisi)) { echo $ordi_choisi;} ?> et le <?php if (isset($date_choisi)) { echo $date_choisi;} ?> :</p>
            <p>
                <label>Début : </label>
                <input type="time" name="debut_horaire">
            </p>
            <p>
                <label>Fin : </label>
                <input type="time" name="fin-horaire">
            </p>

            <p>
                <input name="submit-form" type="submit" value="Envoyer">
            </p>
            <a href="attribution.php">Précédent</a>
            <!-- INSERT INTO `attribution` (`attribution_id`, `attribution_utilisateur_id`, `attribution_ordi_id`, `attribution_date`, `attribution_horaire_debut`, `attribution_horaire_fin`) VALUES (NULL, '4', '2', '2021-06-17', '19:00:00', '20:00:00'); -->
        </form>
    </div>
</body>
<?php
    $gestion->closeConnexion($mysqli);

?>
</html>