<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
    <?php include "fonction.php" ?>
</head>

<body class="fun-color">
    <div class="bienvenu">
        <div class="centrer" id='myDIV'>
            <form action="" method="post">
                <p>
                    <span>Nom d'utilisateur :</span>
                    <input type="text" name="login" placeholder="Nom d'utilisateur">
                </p>
                <p>
                    <span>Crée votre mot de passe:</span>
                    <input type="password" name="MDP" placeholder="Crée mots de passe">
                </p>
                <p>
                    <span>Confirmer votre mot de passe :</span>
                    <input type="password" name="CONFMDP" placeholder="confirmer votre mots de passe">
                </p>
                <p><input type="submit" value="S'inscrire"/> <INPUT TYPE="BUTTON" VALUE=" Retour " onclick="window.location.href = 'index.php';"></p>
            </form>
        </div>
    </div>
</body>

</html>