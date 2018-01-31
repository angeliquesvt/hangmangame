<?php
include_once("php/authorise.inc"); /*Verifie la session joueur*/
include_once("php/connexion.inc");  /*Connexion à la BD*/
/*Rinitialisation de toute les sessions si il y a une veleur dans le post reset*/
if (isset($_POST['reset'])) {   /*Verifie s'il y a un POST de reset*/
    unsetSession(array( /*Tebleau avec le nom des sessions*/
        "findword",
        "myWord",
        "tryNumber",
        "beginDate",
        "endDate",
        "alphabet",
        "id_theme",
        "theme",
        "id_dictionnaire",
        "score",
        "alphabet"
    ));
    header("Location:theme.php"); /*Redirection vers theme.php*/
    exit;
}
if (!isset($_SESSION['endDate'])) { /*S'il n'y a pas de session de endDate*/
    $_SESSION['endDate'] = microtime(true); /*On la créer la date de fin en récupérant le temps en seconde*/
}
/*Différence entre le temps de départ et de fin*/
$difference_ms = ceil($_SESSION['endDate'] - $_SESSION['beginDate']); /* fonction ceil — Arrondit au nombre supérieur */
$score = $difference_ms * 100 - $_SESSION['tryNumber'] * 300; /*Calcul du score*/
saveScore($score, $connexion); 

/*Fonctoon pour convertir le temps en minute*/
function getTimeInMinute($time) {
    $minutes = intval($time / 60);   /*Retourne la valeur numérique entière équivalente d'une variable*/
    $seconde = $time - ($minutes * 60); /* temps moins le nombre de minutes en seconde*/
    echo $minutes . " minutes et " . $seconde . " secondes"; 
}

/*Fonction pour réinitialiser les sessions */
function unsetSession($arrays) {
    foreach ($arrays as $array) {
        unset($_SESSION[$array]);
    }
}
/*Fonction pour inserer le score dans la base de donnée*/
function saveScore($score, $connexion) {
    if (!isset($_SESSION['score']) && $score >= 1000) {
        $_SESSION['score'] = $score;
        $id_utilisateur = $_SESSION["id_joueur"];
        $id_dictionnaire = $_SESSION['id_dictionnaire'];
        $connexion->query("INSERT INTO score (id_utilisateur, score, id_dictionnaire) VALUES ({$id_utilisateur}, {$score}, {$id_dictionnaire});");/*Requete SQL: insert dans la table score, id utilisateur, le score et l'id du dictionnaire les valeurs correspondante recuperer dans les sessions */
    }
}
?>
<!DOCTYPE html>
<html lang = "fr">
    <head>
        <meta charset = "utf-8">
        <link rel = "stylesheet" href = "css/style.css">
        <title>Pendu</title>
    </head>	
    <body>
        <section class="choix-theme">
            <!-- HEADER -->      
            <header class="entete">
                <h1>Gagné</h1>
            </header>
            <main class="gagne">
                <h1>Félicitation</h1>
                <br/>
                <p>Vous avez réussi à trouver le mot <b><?php echo $_SESSION['myWord'] ?></b> <!-- Affiche le mot à trouvé -->
                <br>Le thème était:<b> <?php echo $_SESSION['theme']; ?></b>    <!-- Affiche le theme -->
                <br>Nombre d'essais:<b> <?php echo $_SESSION['tryNumber'] ?></b>   <!-- Affiche le nombre d'essais -->
                <br>Temps: <b><?php getTimeInMinute($difference_ms); ?></b>    <!-- Fonction pour recupérer et afficher le temps de jeu en minutes -->
                <br>Score: <b> <?php echo $score ?> points  <!-- Affiche le score --> </b></p>
                <br/>
                <br/>
                <form  method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>"> <!-- Formulaire pour rejouer qui renvoie l'action sur lui même -->
                    <button class="index-btn" name="reset" value="0">Rejouer</button> 
                </form>
            </main>
            <!-- Footer -->
            <footer class="footer foot-theme">
                <p>Codé par Angélique Souvant</p>
            </footer>
        </section>
    </body>
</html>