<?php
include_once("php/authorise.inc"); /*Vérifie la session joueur*/
include_once("php/connexion.inc"); /*Connexion BD*/
if (isset($_POST['reset'])) { /*Verifie s'il y a un POST de reset*/
    unsetSession(array( /*Stock le nom des sessions dans un tableau*/
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
    header("Location:theme.php"); /*Redirige vers theme.php*/
    exit;
}
/*Fonction qui reinitiliser les sessions*/
function unsetSession($arrays) {
    foreach ($arrays as $array) {
        unset($_SESSION[$array]);
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
            <h1>Perdu</h1>
        </header>
        <main class="perdu">
            <p> Le mot à trouver était <?php echo $_SESSION['findword']; ?> </p> <!-- Rappel le mot à trouver -->
            <img src="img/7.jpg">
            <form  method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>"> <!-- Formulaire qui renvoie l'action sur lui même -->
                <button class="index-btn" name="reset" value="0">Rejouer</button>  <!-- Si on appuis, reset les sessions et redirige sur theme.php -->
            </form>
        </main>
        <!-- Footer -->
        <footer class="footer foot-theme">
            <p>Codé par Angélique Souvant</p>
        </footer>
    </section>
    </body>
</html>
