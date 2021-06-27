<?php

    class Gestion {
        
        // ------------------------------------------
        
		public function __construct() {
            // le contructeur est vide pour ce projet
		}
        
        public function connexionBDD() {
            $mysqli = new mysqli(BDD_SERVEUR, BDD_USER, BDD_MDP, BDD_NAME);
            return $mysqli;
        }

        public function freeResult($result) {
            $result -> free();
        }

        public function closeConnexion($mysqli) {
            $mysqli -> close();
        }

        // --------------------------------------------

        public function selectAllusers($mysqli) {
            $mysqli = $this->connexionBDD();
            $req    = 'SELECT * FROM user';
            $result = $mysqli->query($req);
            return $result;
        }

        public function selectAllutilisateur() {
            $mysqli = $this->connexionBDD();
            $req = 'SELECT * FROM utilisateur';
            $result = $mysqli->query($req);
            return $result;
        }

        public function selectAllordinateur() {
            $mysqli = $this->connexionBDD();
            $req = 'SELECT * FROM ordi';
            $result = $mysqli->query($req);
            return $result;
        }

        public function selectAllattribution() {
            $mysqli = $this->connexionBDD();
            $req = 'SELECT * FROM attribution';
            $result = $mysqli->query($req);
            return $result;
        }

        public function selectOrdiById($id) {
            $mysqli = $this->connexionBDD();
            $req = 'SELECT * FROM ordi WHERE ordi_id = ' . $id;
            $result = $mysqli->query($req);
            // echo $req;
            return $result;
        }

        public function selectUtilisateurById($id) {
            $mysqli = $this->connexionBDD();
            $req = 'SELECT * FROM utilisateur WHERE utilisateur_id = ' . $id;
            $result = $mysqli->query($req);
            // echo $req;
            return $result;
        }

        public function afficheEditeAndSuppr($objet, $id, $table) {
            $modif = '<a href="process/edition.php?id=' . $id . '&cible=' .$table. '">[modifier]</a>';
            $suppr = '<a href="process/suppression.php?id=' . $id . '&cible=' .$table. '">[supprimer]</a>';
            // echo $lien;
            $chaine = $objet . ' - ' . $modif  . ' - ' . $suppr . ' <br> ';
            return $chaine;
        }

        public function afficheAttribution($utilisateur, $ordinateur, $date, $debut_horaire, $fin_horaire, $id, $table) {
            $ch = '<div class="item-attribution">Utilisateur : ' .$utilisateur . '<br>'; 
            $ch .= 'Ordinateur : ' .$ordinateur . '<br>'; 
            $ch .= 'Date : ' .$date . '<br>';
            $ch .= 'Horaire : ' .$debut_horaire. ' - ' .$fin_horaire . '<br>';
            $ch .= '<a href="process/suppression.php?id=' . $id . '&cible=' .$table. '">[supprimer]</a></div>';
            return $ch;
        }
		                
	}
?>