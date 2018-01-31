<?php
include_once("php/authorise.inc");  //Session joueur 
//Traitement des données en post
if (isset($_POST['theme'])) {   // Vérifie s'il existe une valeur transmit en post
    session_start();            //Démarre une session s'il y a une valeur thème
    //Création de deux sessions qui prennent le nom et l'ID du thème
    $_SESSION['id_theme'] = $_POST['id_theme']; 
    $_SESSION['theme'] = $_POST['theme'];
    header("Location:pendu.php");         //Redirection vers pendu.php
    exit(); //termine le script courant
}

?>
<!DOCTYPE html>
<html lang="fr">
    <section class="choix-theme">
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="css/style.css">
            <title>Pendu</title>
        </head>	
        <body>
            <!-- HEADER -->
            <header class="entete">
                <h1>Choix du thème</h1>
            </header>
            <!-- MAIN -->
            <main>
                <section class="theme">
                    <?php
                    include_once("php/connexion.inc");      // connexion à la BD
                    $res = $connexion->query("SELECT * FROM theme");    // Requete SQL selectionne toute les colonnes dans theme
                    $lignes = $res->fetchAll();     //lit toute les lignes retourne un tableau les contenant
                    //Création du formulaire avec les thèmes cliquable et leurs commentaires
                    foreach ($lignes as $ligne) {
                        ?>   
                        <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post"> <!-- Formulaire qui revoie sur lui même -->
                            <input type="hidden" name="theme" value="<?php echo $ligne->nom ?>"> <!-- affiche un boutton caché prenant pour valeur le nom du thème utilise pour créer la session -->
                            <input type="hidden" name="id_theme" value="<?php echo $ligne->id_theme ?>"> <!-- affiche un boutton caché prenant pour valeur l'id du thème utilise pour créer la session -->
                            <input class="btn-theme" type='submit' value="<?php echo $ligne->nom ?>">   <!-- affiche un boutton qui prend la valeur du nom du thème pour pouvoir créer les deux sessions et avoir la valeur du thème en POST-->
                            <br/><?php echo $ligne->commentaire ?>   <!-- Affiche le commentaure de la ligne du tableau -->
                        </form> <br/>
                        <?php
                    }
                    $res->closeCursor();   /*ferme la requete*/
                    ?>
                </section>
            </main>
            <!-- FOOTER -->
            <footer class="footer foot-theme">
                <p>Codé par Angélique Souvant</p>
            </footer>
        </section>
    </body>
</html>
