
<link rel="stylesheet" href="menu.css">
<?php session_start();
$BDD = new PDO('mysql:host=localhost; dbname=film; charset=utf8', 'root', '');
function menuco($BDD)
{
    if (isset($_SESSION['login'])) {

?>
        <div class='header'>
            <nav>
                <ul id="menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="film.php">Film</a></li>
                    <li><a href="mon_compte.php">Compte</a></li>
                
                <?php if ($_SESSION['ADMIN'] == 'true') { ?>
                    
                        <li><a href="message.php">Boite Reception</a></li>
                        <li><a href="admin.php">Admin</a></li>
                    </ul>
            </nav>
        <?php } ?>
        <div class="deconnection">
            <form action="" method="post">
                <input class="button" type="submit" name="deco" value="Déconnection">
            </form>
            </div>
        </div>
    <?php } else { ?>

        <div class='header'>
            <nav>
                <ul id="menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="vote.php">Vote</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <form action="" method="post">
                <div class="login"><input class="enter" type="text" name="login" placeholder="entrée le login" required></div>
                <div class="login"><input class="enter" type="password" name="mdp" placeholder="votre mot de passe" required></div>
                <div class="login"><input class="button" type="submit" name="valide" value="Connection">
                <input type=button onclick=window.location.href='inscrire.php'; value="S'inscrire" class="button"></div>
            </form>

        </div>

    <?php }
    /*$nom = 'admin';
    $password = 'admin';
    if (isset($_POST['valide'])) {
        if ($_POST['login'] == $nom) {
            if ($_POST['mdp'] == $password) {
                $_SESSION['login'] = $_POST['login'];
            } else echo 'le mot de passe est incorrect. ';
        } else echo 'le login est inconnu. ';
        echo '<meta http-equiv="refresh" content="0">';
    }*/

    if (isset($_POST['deco'])) {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0">';
    }

    //if (isset($_POST['valide'])) {
    connectionbdd();
    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    if (isset($_POST['valide'])) {
        if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
            $requser = $BDD->prepare("SELECT * FROM user WHERE identifiant = ? AND password = ?");
            $requser->execute(array($_POST['login'], $_POST['mdp']));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $userexist = $requser->fetch();
                $_SESSION['id_user'] = $userexist['id_user'];
                $_SESSION['login'] = $userexist['identifiant'];
                $_SESSION['mdp'] = $userexist['password'];
                $_SESSION['ADMIN'] = $userexist['ADMIN'];
                $_SESSION['vote'] = $userexist['vote'];
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Mauvais mail ou mot de passe !";
            }
        } else {
            echo "Tous les champs doivent être complétés !";
        }
    }
    //}
}


function inscription($identifiant, $password, $BDD)
{

    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $roquette = ("INSERT INTO `user`(`identifiant`, `password`, `ADMIN`) VALUES ('$identifiant','$password','false') ");

    $BDD->query("$roquette");
}

function verifUser($BDD)
{
    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $requeteMail = $BDD->prepare("SELECT * FROM user WHERE identifiant = ?");
    $requeteMail->execute(array($_POST['LOGIN']));
    $userExist = $requeteMail->rowCount();
    if ($userExist != 1) {
        echo "bien connecter";
        inscription($_POST['LOGIN'], $_POST['CONFMDP'], $BDD);
    } else {
        echo "il y a deja un user";
    }
}
function connection($BDD)
{
    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    if (isset($_POST['valide'])) {
        if (!empty($_POST['login']) and !empty($_POST['mdp'])) {
            $requser = $BDD->prepare("SELECT * FROM user WHERE identifiant = ? AND password = ?");
            $requser->execute(array($_POST['login'], $_POST['mdp']));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $userexist = $requser->fetch();
                $_SESSION['login'] = $userexist['identifiant'];
                $_SESSION['mdp'] = $userexist['password'];
                $_SESSION['admin'] = $userexist['ADMIN'];
                $admin = $_SESSION['admin'];
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Mauvais mail ou mot de passe !";
            }
        } else {
            echo "Tous les champs doivent être complétés !";
        }
    }
}

function connectionbdd()
{

    $BDD = new PDO('mysql:host=localhost; dbname=film; charset=utf8', 'root', '');
    return $BDD;
}

function contact($nom, $prénom, $mail, $message, $BDD)
{
    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $roquette = ("INSERT INTO `Contact`(`nom`, `prénom`, `mail`,`message`) VALUES ('$nom','$prénom','$mail','$message') ");
    $BDD->query("$roquette");
}

/*function afficheUser()
{
    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $request = $BDD->query("SELECT * FROM `user` WHERE 1");
   ?>
    <form action="" method="post">

    <?php
    while ($data = $request->fetch()) {
        echo '<tr>';
        echo "<td>" . $data['id_user'] . "</td>";
        echo "<td>" . $data['identifiant'] . "</td>";
        echo "<td>" . $data['password'] . "</td>"; ?>
        <td><input type="checkbox" id="Med_<?php $data['id_user'] ?>" name="id_users[]" value="<?php $data['id_user'] ?>"></td>
<?php
    //TTRAITEMENT SUPPRESSION
    if (isset($_POST['supp'])) {

        //NE PAS METTRE []
        foreach ($_POST["id_users"] as $check) {
            if (!isset($checkoptions)) {
                $checkoptions = $check;
            } else {
                $checkoptions .= "," . $check;
            }
        }

        echo  "DELETE FROM `User` WHERE Id IN(" . $checkoptions . ")";
    }

    ?>
    <input type="submit" name="supp" value="suppre ca" />
</form>

<?php
}*/
function AfficheFilm($BDD)
{

    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $request = $BDD->query("SELECT nom, imgSource FROM film");

    while ($data = $request->fetch()) { ?>
        <table border="2">
            <tr>
                <td align=center> <?php echo $data['nom'] ?> </td>
            </tr>
            <tr>
                <td>
                    <div> <img src="<?php echo $data['imgSource']; ?>"> </div>
                </td>
            </tr>
        </table>

<?php }
}
//echo "<p>" . $data['nom'] . "</p>";
//echo "<img src = " . $data['imgSource'] . ">";
?>