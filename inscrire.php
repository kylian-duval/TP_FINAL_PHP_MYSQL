<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscrire.css">
    <?php include "fonction.php";
    $BDD = connectionbdd(); ?>
</head>
<?php if (isset($_SESSION['login'])) { ?>

    <body>
        <?php menuco($BDD); ?>
        <h4>vous êtes déja inscrit</h4>

    <?php } else { echo '$BDD';?>
        <div class="login-box">
            <h2>Inscription</h2>
            <form action="" method="POST">
                <div class="user-box">
                    <input type="text" name="LOGIN" required>
                    <label>Nom</label>
                </div>
                <div class="user-box">
                    <input type="password" name="MDP" required>
                    <label>Mot de passe</label>
                </div>
                <div class="user-box">
                    <input type="password" name="CONFMDP" required>
                    <label>Confirmer mot de passe</label>
                </div>
                <input class="button" type="submit" name="inscrir" value="S'inscrire">
                <a href="index.php">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Accueil
                </a>
            </form>
        </div>
    </body>
<?php

    if (isset($_POST['inscrir'])) {
        if (isset($_POST['MDP']) && isset($_POST['CONFMDP'])) {

            if ($_POST['MDP'] != $_POST['CONFMDP']) {
                echo "les deux mots de passe ne correspondent pas";
            } else {
                verifUser($BDD);
            }
        }
    }
}
?>

</html>