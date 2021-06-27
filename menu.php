
<?php 
    if ($choix_menu == 1) {
?>
    <nav class="menu">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="process/ajout_utilisateur.php">Nouvel utilisateur</a></li>
        <li><a href="process/ajout_ordinateur.php">Nouvel ordinateur</a></li>
        <li><a href="attribution.php">Nouvelle attribution</a></li>
    </nav>
<?php
    }
    elseif ($choix_menu == 2) {
?>
    <nav class="menu">
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="ajout_utilisateur.php">Nouvel utilisateur</a></li>
        <li><a href="ajout_ordinateur.php">Nouvel ordinateur</a></li>
        <li><a href="../attribution.php">Nouvelle attribution</a></li>
    </nav>
<?php
    }
?>