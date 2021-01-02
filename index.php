
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include "fonction.php"; connectionbdd();
    ?>
</head>

<body>
    <?php menuco($BDD); ?>
    <div class="conteneur">
        <p>Du contenu sous le menu</p>

        <?php
        AfficheFilm($BDD);
        ?>

    </div>

</body>

</html>