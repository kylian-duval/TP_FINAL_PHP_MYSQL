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
    <?php menuco($BDD); ?>
    <div class="bienvenu">
        <table align=center border="10" class="centrercontatact" id="myDIV">
            <form action="" method="post">
                <tr>
                    <th>
                        <form action="" method="post">
                            <span>Nom:</span>
                            <input type="text" id="Nom" name="Nom" required>
                            <span>Prénom:</span>
                            <input type="text" id="Prénom" name="Prénom" required>
                            <p><span>Adresse mail:</span>
                                <input type="email" id="formulaire.txt" name="mail" required ></p>
                    </th>

                </tr>
                <tr>
                    <th>
                        <div><span>votre messege:</span></div>
                        <div><textarea id="msg" name="user_message" type="text" style="height:80px;" id="formulaire.txt" name="formulaire.txt" required minlength="0" maxlength="1000" size="1000"></textarea></div>
                        <div class="boutonenoyer"><input type="submit" name="envoyer" value="envoyer" /></div>
                    </th>
                </tr>
            </form>
        </table>
    </div>
</body>
<?php        
if(isset($_POST['envoyer'])){

    contact($_POST['Nom'], $_POST['Prénom'],$_POST['mail'], $_POST['user_message'], $BDD);
}


?>
</html>