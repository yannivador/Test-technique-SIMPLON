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
        </form>
    </div>
</body>
<?php
    $gestion->closeConnexion($mysqli);

?>
</html>