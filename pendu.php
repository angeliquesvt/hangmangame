<?php
include_once("php/authorise.inc"); // Vérifie la session joueur  
include_once("php/connexion.inc");  // Connexion à la BD

if (!isset($_SESSION['findWord'])) {        //S'il n'existe pas de session avec un mot à trouver
    getRandomWordByTheme($_SESSION['id_theme'], $connexion);    //Execute la fonction qui renvoie un mot aléatoire
}
if (isset($_POST['character'])) { //S'il y a un post de character dans les formulaires de lettre
    $character = $_POST['character'];   //on attribut dans une variable la lettre
    showLetterInWord($character, 0); //Execute la fonction permettant de verifier l'existance du caractère
    if ($_SESSION['tryNumber'] == 8) { /*Si le nombre d'essais est égale à 8*/
        header("Location:perdu.php"); /*Redirige vers perdu.php */
        exit;
    }
    is_win(); /*On execute la fonction pour vérifier si le joueur à gagner à chaque chois de lettre*/
}
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
/*Fonction pour réinitialiser les sessions */
function unsetSession($arrays) {
    foreach ($arrays as $array) {
        unset($_SESSION[$array]);
    }
}

/**
 * Fonction qui génère un mot aléatoire
 */
function getRandomWordByTheme($id_theme, $connexion) {
    $response = $connexion->query("SELECT * FROM dictionnaire WHERE id_theme =" . $id_theme); //Requete SQL: Select toute les colonnes dans la table dictionnaire ou l'ID du theme est correcpond au paramètre id_theme
    $words = $response->fetchAll(); //Récupère lignes dans un tableau
    $random = rand(0, count($words) - 1);   //Fonction aléatoire (-1 car commence à 0), compte de 0 jusqu'au nombre de ligne
    if (!isset($_SESSION['findword'])) { //S'il n'existe pas de session de mot a trouver
    /*Initialise les sessions*/
        $_SESSION["id_dictionnaire"] = $words[$random]->id_dictionnaire; //Session qui prend l'id du mot dans la BD
        $_SESSION["findword"] = strtoupper($words[$random]->mot);       //Session qui recupère le mot associé à l'ID récupérer dans la BD (qui sera le mot a trouver) et le met en majuscule
        $_SESSION['myWord'] = str_repeat('*', strlen($_SESSION["findword"])); //transforme les caractères de la chaine dans findword en étoile
        $_SESSION['tryNumber'] = 0; //session du nombre d'essais initialiser à 0
        $_SESSION['beginDate'] = microtime(true); //Session qui recupère le temps en seconde
        $_SESSION['alphabet'] = array();    //session qui initialise un tableau
    }
}
// fonction qui recupere tous les boutons et qui les desactives s'ils sont utilisés
function getCharacter() { //recupere tout les boutons
    $alphabets = range('A', 'Z'); //fonction qui créer un tableau contenant un intervalle d'éléments
    foreach ($alphabets as $alphabet) {
        $disable = in_array($alphabet, $_SESSION['alphabet']); //Indique si une valeur appartient à un tableau
        if ($disable) {     //si la la valeur est dans le tableau
            $disable = "disabled";  //on "disable" le bouton du formulaire
        } else {
            $disable = "";  //snn on ne met rien
        }
        ?>
        <!-- Formulaire pour les boutons des lettres -->
        <form style="display:inline-block;" method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>">
            <button class="btn-pendu" name="character" value="<?php echo $alphabet ?>" <?php echo $disable ?>><?php echo $alphabet ?></button>
        </form>
        <?php
    }
}

/*Fonction pour remplacer les etoiles par la lettre correspondante*/
function showLetterInWord($character, $offset = 0) {
    $word = strpos($_SESSION["findword"], $character, $offset); //Cherche la position de la première occurrence dans une chaîne paramettre: la chaine ou l'on cherhce, offset permet de compter a partir de la lettre indiqué

    /*si on part de la premiere lettre et qu'il n'y a pas le mot dans la chaine*/
    if ($offset == 0 && $word === FALSE) { //Si la lettre n'est pas dans la chaine (car l'offset est a 0)
        $_SESSION['tryNumber'] ++;  //incrémente le nb d'essai
    }
    if ($word === false) {  //s'il n'y a pas ou plus le mot
        $_SESSION['alphabet'][] = $character; //on met le charactere dans le tableau de la session alphabet
        return;
    } else {
        $_SESSION['myWord'][$word] = $character; /*Remplace l'etoile par le caractere à la position du mot*/
        showLetterInWord($character, $word + 1); //execute la fonction showletter en changeant l'offset pour verifer si la lettre est doublé
    }
}

/*Fonction gagné*/
function is_win() {
    $is_win = strpos($_SESSION["myWord"], "*");
    if ($is_win === false) { /*S'il n'y a plus d'étoile dans la chaine myword*/
        header("Location:gagne.php"); /*Refirige vers gagne.php*/
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <title>Pendu</title>
    </head>	
    <body>
        <!-- HEADER -->
        <header class="entete">
            <h1>Thème : <?php echo $_SESSION['theme']; ?></h1>
        </header>
        <!-- MAIN -->
        <main>
            <!-- regles du jeu -->
            <section class="pendu regle-pendu">
               <p> L'objectif du jeu est de découvrir un mot en devinant les lettres le composant.
                <br/> Cliquez sur une des lettres. Si la lettre est dans le mot, la lettre sera dévoilée. Si la lettre existe plusieurs fois dans le mot, elle sera dévoilée aussi!
                <br/> Si la lettre n'existe pas dans le mot, alors vous perdrez une vie. Vous avez 7 essais, bonne chance !
                <form  method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>"> <!-- Formulaire pour rejouer qui renvoie l'action sur lui même -->
                    <button class="btn-pendu" name="reset" value="0">Changer de thème</button> 
                </form>
               </p>
            </section>
            <!-- le jeu -->
            <section class="pendu jeu-pendu">
                <br />
                Trouvez le mot : <?php echo $_SESSION['myWord']; ?> <!-- Le mot à trouver sous forme d'étoile -->
                <br/>
                <br/>
                <?php
                    getCharacter(); /*Fonction pour afficher les boutons*/
                    include_once("php/connexion.inc"); //connexion à la BD
                ?>
                <br/>
                <br/>
                <p class="try"> <b>Plus que <?php echo 7 - $_SESSION['tryNumber'] ?> vies</b></p> <!-- 7 moins le nombre d'essais effectuer: Affichage du nombre d'essais restant -->
                <br />
                <br />
                <?php if( $_SESSION['tryNumber'] >= 1){?> <!-- à chaque erreur, quand le nombre d'essais augmente-->
                <img src="img/<?php echo ($_SESSION['tryNumber'] -1)  ?>.jpg"> <!-- On affiche l'image du numéro dans la session trynumber - 1 (car commence à 0 le numéro des images) -->
                <?php } ?>
            </section>
        </main>
    </section>
    </body>
</html>
