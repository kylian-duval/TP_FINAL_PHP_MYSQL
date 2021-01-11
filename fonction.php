<link rel="stylesheet" href="menu.css">
<link rel="stylesheet" href="index.css">
<?php session_start();
$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
function menuco($BDD)
{
    if (isset($_SESSION['login'])) {

?>
        <div class='header'>
            <nav>
                <ul id="menu">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="vote.php">Film</a></li>
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
                    <li><a href="vote.php">Film</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <form action="" method="post">
                <div class="section">
                    <div class="login"><input class="enter" type="text" name="login" placeholder="entrée le login" required></div>
                    <div class="login"><input class="enter" type="password" name="mdp" placeholder="votre mot de passe" required></div>
                    <div class="login"><input class="button" type="submit" name="valide" value="Connection">
                        <input type=button onclick=window.location.href='inscrire.php' ; value="S'inscrire" class="button"></div>
                </div>
            </form>

        </div>

    <?php }


    if (isset($_POST['deco'])) {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0">';
    }


    connectionbdd();

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
}


function inscription($identifiant, $password, $BDD)
{


    $roquette = ("INSERT INTO `user`(`identifiant`, `password`, `ADMIN` ,`vote`) VALUES ('$identifiant','$password','false', 'non') ");
    $BDD->query("$roquette");
}

function verifUser($BDD)
{

    $requeteMail = $BDD->prepare("SELECT * FROM user WHERE identifiant = ?");
    $requeteMail->execute(array($_POST['LOGIN']));
    $userExist = $requeteMail->rowCount();
    if ($userExist != 1) {
        echo "<div class = 'error'>merci de votre inscription</div>";
        inscription($_POST['LOGIN'], $_POST['CONFMDP'], $BDD);
    } else {
        echo "<div class = 'error'>il y a deja un user </div>";
    }
}
function connection($BDD)
{

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
    $roquette = ("INSERT INTO `Contact`(`nom`, `prénom`, `mail`,`message`) VALUES ('$nom','$prénom','$mail','$message') ");
    $BDD->query("$roquette");
}


function AfficheFilm($BDD)
{


    $request = $BDD->query("SELECT nom, imgSource FROM film");

    while ($data = $request->fetch()) { ?>
        <table class="blueTable" border="2">
            <thead>
                <tr>
                    <th align=center> <?php echo $data['nom'] ?> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div> <img src="<?php echo $data['imgSource']; ?>"> </div>
                    </td>
                </tr>
            </tbody>
        </table>

<?php }
}

?>