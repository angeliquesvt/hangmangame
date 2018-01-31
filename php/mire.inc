 <?php
// Verifie s'il y a eu un submit
if (isset($_POST['valider'])) {
    $msg = "";
    $val = 0;

    /*LOGIN*/
    // Verifie qu'il y a champs name et si le champs n'est pas vide
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name']; //Récupère le champs dans la variable name
        $val++;                 //Incrémente val
    } else {
        $msg = "Saisissez votre nom et le mot de pass <br/>\n";   //Sinon message d'erreur
    }
    // Vérifie le champs de mot de pass et s'il n'est pas vide
    if (isset($_POST['pass']) && !empty($_POST['pass'])) {
        $pass = $_POST['pass'];     //Enregistre dans une varaible la valeur du champs
        $val++;                     //Incrémente val
    } else {
        $msg = "Saisissez votre nom <br/> \n";   //Sinon message d'erreur
    }
    // Si val à bien été incrémenter de 2
    if ($val == 2) {
        include_once("connexion.inc");  //connexion à la base de donnée
        $str = "SELECT * from utilisateur WHERE login='" . $name . "'"; //Requete SQL: selectionne toute les colonnes de la table utilisateur où le login équivaut au contenu de la variable name
        $res = $connexion->query($str); //Execute la requete
        /**
         * FETCH => 1 ligne
         * FETCHALL => 1 ligne et + 
         */
        $ligne = $res->fetch(); //Récupère la ligne dans la variable ligne
        if (($pass == $ligne->password)) { //compare le mot de pass à celui de la ligne récupérer
            session_start();        //démarre une session
            $_SESSION['joueur'] = $ligne->login;       //Session joueur qui prend le nom du login récupéré
            $_SESSION['id_joueur'] = $ligne->id_utilisateur;    //Session ID joueur qui reprend l'ID de l'utilisateur dans la BD           
            header("Location:theme.php"); //redirige vers theme.php
            exit(); // termine le script courant
        } else {    // affiche un message d'erreur et reste sur page
            $msg = "Erreur de nom ou mot de pass <br/>\n";
            echo($msg);
        }
        $res->closeCursor(); //ferme la requete
    }
}
?>
