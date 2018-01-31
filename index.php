<?php
    include_once("php/mire.inc"); //inclue mire.php
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
            <h1>Jeu du pendu d'Angélique Souvant</h1>
        </header>
        <!-- MAIN -->
        <main class="index-mire">
            <!-- FORMULAIRE de connexion -->
            <fieldset>
                <legend align="left"><div id="fieldtitre"> Connectez vous</div></legend> 
                <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">       <!-- Formulaire qui renvoie sur lui même -->
                    <!-- <form action="<? $_SERVER['PHP_SELF'] ?>" method="post">-->     <!-- exemple d'une deuxième méthode sans "echo" -->
                    <label><b>Login</b></label><br/>
                    <input class="index-form" type="text" placeholder="admin" name="name" required>    <!-- LOGIN -->
                    <br/>
                    <label><b>Mot de pass</b></label><br/>
                    <input class="index-form" type="password" placeholder="root" name="pass" required>  <!-- MDP  -->
                    <br/>
                    <button class="index-btn" type="submit" name="valider">Valider</button>              <!-- SUBMIT -->
                </form>
            </fieldset>
            <!-- Inclue la page score.php qui affiche les scores-->
            <section class="index-score">
                <?php include_once 'score.php'; ?>
            </section>
        </main>
         <!-- FOOTER -->
        <footer class="footer">
            <p>Codé par Angélique Souvant</p>
        </footer>

    </body>
</html>
