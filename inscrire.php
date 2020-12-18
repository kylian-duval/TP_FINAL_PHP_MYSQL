<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
    <?php include "fonction.php"; connectionbdd(); ?>
</head>

<body class="fun-color">
    <div class="bienvenu">
        <div class="centrer" id='myDIV'>
            <form action="" method="POST">
                <p>
                    <span>Nom d'utilisateur :</span>
                    <input type="text" name="LOGIN" placeholder="Nom d'utilisateur" required>
                </p>
                <p>
                    <span>Crée votre mot de passe:</span>
                    <input type="password" name="MDP" placeholder="Crée mots de passe" required>
                </p>
                <p>
                    <span>Confirmer votre mot de passe :</span>
                    <input type="password" name="CONFMDP" placeholder="confirmer votre mots de passe" required>
                </p>
                <p><input type="submit" value="S'inscrire"/> <INPUT TYPE="BUTTON" VALUE="Retour" onclick="window.location.href = 'index.php';"></p>
            </form>
        </div>
    </div>
</body>
<?php 

    if(isset($_POST['MDP']) && isset($_POST['CONFMDP']))
    {
        if ($_POST['MDP'] != $_POST['CONFMDP'])
        {
            echo "les deux mots de passe ne correspondent pas";
        }
        else
        {
            verifUser($BDD);
        }
    }
    
?>
</html>