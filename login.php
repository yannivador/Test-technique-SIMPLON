<?php
    session_start();
    require('class/Gestion.php');
    require('configuration.php');
    $gestion = new Gestion();

    $mysqli = $gestion->connexionBDD();
    
    // 0. Si l'utilisateur est déja connecté
    if (isset($_SESSION['user_login'])) {
        header('location:index.php');
    }

    // 1. Récupération des variables
    if (isset($_POST['submit_form'])) {
        $user_input_name     = $_POST['user_name'];
        $user_input_password = $_POST['user_password'];

        // echo ' ' . $user_name . ' - ' . $user_password . '<br>';

        // 2. vérification si les variables sont vides
        if (empty($user_input_name) OR empty($user_input_password)) {
            $message = '<p class="error">Veuillez remplir tous les champs</p>';
        }

        else {
        	// 3. login correspond ?
        	// $requet = 'SELECT user_login, user_password FROM user WHERE user_login = "' . $user_input_login . '"';

        	$results = $mysqli->query('SELECT user_nom, user_mdp FROM user WHERE user_nom = "' . $user_input_name . '"');
            
            foreach ($results as $result) {
                $user_name     = $result['user_nom'];
        		$user_password = $result['user_mdp'];
            }

        	if (empty($user_name)) {
        		$message = '<p class="error">Erreur d\'identification, login non reconnu</p>';		
        	}

        	else { // la requete retourne un resultat, il faut vérifier si le mdp entré est le bon

        		if ($user_input_password != $user_password) {
        			$message = '<p class="error">Erreur d\'identification, mot de passe non reconnu</p>';
        		}

        		else {
        			session_start();
        			$_SESSION['user_login'] = $user_name;
        			header('location:index.php');
        		}
        	}
        }
    }

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
    <div id="login-container" >
        <form name="form-connexion" class="form-connexion" method="POST">
            <h1>Interface de connexion</h1>
            <?php
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <p>
                <label>Nom d'utilisateur : </label>
                <input name="user_name" type="text" placeholder="Nom utilisateur" required>
            </p>
            <p>
                <label>Mot de passe : </label>
                <input name="user_password" type="password" placeholder="Mot de passe" required>
            </p>
            <p>    
                <input type="submit" name="submit_form" value="Connexion">
            </p>
        </form>
    </div>
</body>
</html>