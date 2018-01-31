<?php
        session_start(); /*Démarre la session*/
	if(!isset($_SESSION['joueur'])){	/*Verifie que la session n'existe pas*/
		header("Location:index.php");	/*si elle n'existe pas il redige vers la page index.html */
		exit();	/*termine le script courant*/
	}
?>
