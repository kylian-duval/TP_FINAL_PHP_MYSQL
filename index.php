<?php try {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <!--ajout du css pour le style -->
        <link rel="stylesheet" href="index.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--ajout des fonction en php + ajout de connection a le bdd-->
        <?php include "fonction.php";
        connectionbdd();
        ?>
    </head>

    <body>
    <!--affiche le menu de navigation-->
        <?php menuco($BDD); ?>
        <div class="conteneur">
        <!--fonction qui affiche tout les film-->
            <?php
            AfficheFilm($BDD);
            ?>

        </div>

    </body>

    </html>
<?php } catch (Exception $e) {

    echo "J'ai eu un problème erreur :" . $e->getMessage();
}  ?>