
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Acceuil</title>
    <link rel="stylesheet" href="css.css">
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