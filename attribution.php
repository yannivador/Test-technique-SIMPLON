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
                <label>Utilisateur : </label>
                <select name="utilisateur" >
                    <option value="">Jean-Bo</option>
                    <option value="">Jean-Bo2</option>
                </select>
            </p>
            <p>
                <label>Ordinateur : </label>
                <select name="ordi" >
                    <option value="">ordi-1</option>
                    <option value="">ordi-2</option>
                </select>
            </p>
            <p>
                <label>Date : </label>
                <input name="date-reserv" type="date" size="16" />
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