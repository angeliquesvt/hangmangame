<?php
include_once("php/connexion.inc"); /*Connexion à la base de données*/
$res = $connexion->query("SELECT s.score, u.login  FROM score s INNER JOIN utilisateur u ON s.id_utilisateur = u.id_utilisateur ORDER BY s.score DESC LIMIT 15"); /*Requete  SQL pour récupérer les login et les scores associées dans la BD*/
/*Je fais: un select de login et score de la table score, join à la table utilisateur U ou l'Id utilisation est liée à l'utilisateur de la table utilisateur ordonnée par ordre décroissant avec une limit de 15 champs */
$lignes = $res->fetchAll(); /* Retourne un tableau contenant toutes les lignes*/
?>

<h3 id="introduction-score">Top 15 des meilleurs scores !</h3>
<!-- ENTETE du tableau -->
<table class="table-score">
    <thead>
        <tr>
            <td>
               <p> <b>Joueur</b></p>
            </td>
            <td>
               <p><b> Score</b></p>
            </td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lignes as $ligne){ ?> <!-- Pour chaque ligne récuperer dans la base et leur résultats -->
        <tr>
            <td> <!-- colonne  1 -->
                <?php  echo $ligne->login ?>   <!-- Associer le résultat dans la ligne du login -->
            </td>
            <td> <!-- colonne 2 -->
                <?php  echo $ligne->score ?>    <!-- Associer le résultat de la ligne du score -->
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>