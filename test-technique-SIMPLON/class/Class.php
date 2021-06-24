<?php
    // 1. Connexion
    class gestion {
        
        // ------------------------------------------
        
		public function __construct() {
            // le contructeur est vide pour ce projet
		}
        
        public function connexionBDD() {
            $mysqli = new mysqli(BDD_SERVEUR, BDD_USER, BDD_MD, BDD_NAME);
        }

        public function freeResult($result) {
            $result -> free();
        }

        public function closeConnexion($mysqli) {
            $mysqli -> close();
        }
		                
	}
?>