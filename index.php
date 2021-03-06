<?php
    session_start();

    $_SESSION['user_login'];

    if (!isset($_SESSION['user_login'])) {
        header('location:login.php');
    }

    require('class/Gestion.php');
    require('configuration.php');

    $gestion = new Gestion();

    $mysqli        = $gestion->connexionBDD();
    $utilisateurs  = $gestion->selectAllutilisateur();
    $ordinateurs   = $gestion->selectAllordinateur();
    $attributions  = $gestion->selectAllattribution();

    $choix_menu = 1;
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
            <?php require('main-header.php'); ?>
            <?php require('menu.php'); ?>
        </header>
        <section class="grid deux">
            <header class="section-header">
                <h2>Liste des utilisateurs</h2>
                <h4><a href="process/ajout_utilisateur.php">Ajouter un utilisateur</a></h4>
            </header>
            <div class="container-utilisateur">
            <?php
                if (empty($utilisateurs)) {
                    echo "Aucun utilisateur enregistrĂ©.";
                } else {
                    foreach ($utilisateurs as $utilisateur) {
                        // echo ($utilisateur['utilisateur_nom']) . '<br>';
                        echo $gestion->afficheEditeAndSuppr($utilisateur['utilisateur_nom'], $utilisateur['utilisateur_id'], 'utilisateur');
                    }
                }
            ?>
            </div>
        </section>
        <section class="grid trois">
            <header class="section-header">
                <h2>Liste des ordinateurs</h2>
                <h4><a href="process/ajout_ordinateur.php">Ajouter un ordinateur</a></h4>
            </header>
            <div class="container-ordinateur">
            <?php
                foreach ($ordinateurs as $ordinateur) {
                    // echo ($ordinateur['ordi_id']) . '<br>';
                    echo $gestion->afficheEditeAndSuppr($ordinateur['ordi_nom'], $ordinateur['ordi_id'], 'ordi');
                }
            ?>
            </div>
        </section>
        <section class="grid quatre">
            <header class="section-header">
                <h2>Liste des attributions</h2>
                <h4><a href="attribution.php">Nouvelle attribution</a></h4>
            </header>
            <div class="container-attribution">
            <?php
                foreach ($attributions as $attribution) {
                    // echo $attribution['attribution_utilisateur_id'] . '<br>';
                    // echo $attribution['attribution_ordi_id'] . '<br>';
                    // echo $attribution['attribution_date'] . '<br>';
                    // echo $attribution['attribution_horaire_debut'] . '<br>';
                    // echo $attribution['attribution_horaire_fin'] . '<br>';
                    $result      = $gestion->selectOrdiById($attribution['attribution_ordi_id']);
                    $ordi        = $result->fetch_array();
                    $result      = $gestion->selectUtilisateurById($attribution['attribution_utilisateur_id']);
                    $utilisateur = $result->fetch_array();
                    // echo $ordi['ordi_nom'];
                    // var_dump($ordinateur);
                    $ch = $gestion->afficheAttribution($utilisateur['utilisateur_nom'], $ordi['ordi_nom'], $attribution['attribution_date'], $attribution['attribution_horaire_debut'], $attribution['attribution_horaire_fin'], $attribution['attribution_id'], 'attribution' );
                    echo $ch;
                }
            ?>
            </div>
        </section>
    </div>
</body>
<?php
    $gestion->closeConnexion($mysqli);

?>
</html>