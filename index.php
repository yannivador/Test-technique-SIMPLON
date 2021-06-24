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
    <title>Test technique SIMPLON</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>
    <!-- <script src='main.js'></script> -->
</head>

<body>
    <div id="container">
        <header class="grid un">
            <h1>Gestion des ordinateurs</h1>
            <a href="logout">Se deconnecter</a>
        </header>
        <section class="grid deux">
            <header class="section-header">
                <h2>Liste des utilisateurs</h2>
                <a href="logout">Ajouter un utilisateur</a>
            </header>
            <?php
                foreach ($utilisateurs as $utilisateur) {
                    echo ($utilisateur['utilisateur_nom']) . '<br>';
                }
            ?>
        </section>
        <section class="grid trois">
            <header class="section-header">
                <h2>Liste des ordinateurs</h2>
                <a href="logout">Ajouter un ordinateur</a>
            </header>
            <?php
                foreach ($ordinateurs as $ordinateur) {
                    echo ($ordinateur['ordi_nom']) . '<br>';
                }
            ?>
        </section>
        <section class="grid quatre">
            <header class="section-header">
                <h2>Liste des attributions</h2>
                <a href="logout">Nouvelle attribution</a>
            </header>

        </section>
    </div>
</body>
<?php
    $gestion->closeConnexion($mysqli);

?>
</html>