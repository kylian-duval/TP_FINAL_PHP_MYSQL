<link rel="stylesheet" href="css.css">
<?php session_start();
function menuco()
{
    if (isset($_SESSION['login'])) { 
        
        ?>
        <nav>
            <div class='test'>
                <ul>
                    <li><a href="#">Acceuil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="film.php">FILM</a></li>
                    <li><a href="admin.php">ADMIN</a></li>
                    <form action="" method="post">
                        <!--<li><input type="submit" name="deco" value="Déconection" /></li>-->
                        <div class=""><input type="submit" name="deco" value="Déconection"/></div>
                    </form>
                </ul>
            </div>
        </nav>
    <?php } else { ?>
        <nav>
            <div class='test'>
                <ul>
                    <li><a href="#">Acceuil</a></li>
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
    $nom = 'admin';
    $password = 'admin';
    if (isset($_POST['valide'])) {
        if ($_POST['login'] == $nom) {
            if ($_POST['mdp'] == $password) {
                $_SESSION['login'] = $_POST['login'];
            } else echo 'le mot de passe est incorrect. ';
        } else echo 'le login est inconnu. ';
        echo '<meta http-equiv="refresh" content="0">';
    }

    if (isset($_POST['deco'])) {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0">';
    }
}
function inscription($identifiant, $password)
{

    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $roquette = ("INSERT INTO `user`(`identifiant`, `password`, `ADMIN`) VALUES ('$identifiant','$password','false') ");

    $BDD->query("$roquette");
}

function verifUser()
{
    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $requeteMail = $BDD->prepare("SELECT * FROM user WHERE identifiant = ?");
    $requeteMail->execute(array($_POST['LOGIN']));
    $userExist = $requeteMail->rowCount();
    if ($userExist != 1) {
        echo "bien connecte";
        inscription( $_POST['LOGIN'], $_POST['CONFMDP']); 
    }
    else
    {
        echo "il y a deja un user";
        
    }
}

?>