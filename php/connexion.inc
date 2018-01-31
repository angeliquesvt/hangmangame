<?php
	include_once("bd.inc"); //Fichier de paramétrage de la BD
	// Connexion à la base de donn�es
	try {		
	    $connexion = new PDO('mysql:host=' . HOTE . ';dbname=' . BD, USER, MDP, array( /*Connexion à la BD*/
	        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" //passe les caractèes en UTF-8
	    ));
	    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //permet dee faire ressortir les erreurs
	    $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //retourne un attribut en objet automatiquement plutôt que de le répeter dans le code
 	//permet de savoir d'où provient l'erreur http://php.net/manual/fr/class.pdoexception.php
	} catch (PDOException $e) {
	    echo 'Une erreur est survenue <br/>';
	    echo 'Erreur : ' . $e->getMessage() . '<br />';
	    die();
	}
?>
