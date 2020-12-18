<link rel="stylesheet" href="css.css">
<?php session_start();
$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
function menuco($BDD)
{
    if (isset($_SESSION['login'])) {

?>
        <nav>
            <div class='test'>
                <ul>
                    <li><a href="index.php">Acceuil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="#">FILM</a></li>
                    <li><a href="mon_compte.php">mon compte</a></li>
                    <?php if ($_SESSION['ADMIN'] == 'true') { ?>
                        <li><a href="message.php">BOÎDE DE RECEPTION</a></li>
                        <li><a href="admin.php">ADMIN</a></li>
                    <?php } ?>
                    <form action="" method="post">
                        <!--<li><input type="submit" name="deco" value="Déconection" /></li>-->
                        <div class=""><input type="submit" name="deco" value="Déconection" /></div>
                    </form>
                </ul>
            </div>
        </nav>
    <?php } else { ?>
        <nav>
            <div class='test'>
                <ul>
                    <li><a href="index.php">Acceuil</a></li>
                    <li><a href="film.php">FILM</a></li>
                    <form action="" method="post">
                        <li>
                            <p><input type="text" name="login" placeholder="entrée le login"> </p>
                            <p><input type="password" name="mdp" placeholder="votre mots de passe"> </p>
                        </li>
                        <li>
                            <div class="pading"><input type="submit" name="valide" value="Connection" /></div>
                        </li>
                    </form>
                    <div class='inscrire'><button onclick="window.location.href = 'inscrire.php';"> S'inscrire</button></div>
                </ul>
            </div>
        </nav>
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
    //connection();
    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
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
        echo "bien connecte";
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

    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
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
                <td align= center> <?php echo $data['nom'] ?> </td>
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