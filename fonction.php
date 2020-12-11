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

    if (isset($_POST['valide'])){
    connection();

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
function connection(){


    /*//  Récupération de l'utilisateur et de son pass hashé
    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $req = $BDD->prepare('SELECT `id_user`, `password` FROM user WHERE `identifiant` = `identifiant`');
    $req->execute(array(
        'identifiant' => '$identifiant'));
    $resultat = $req->fetch();
    
    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['password']);
    
    if (!$resultat)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        if (!$isPasswordCorrect) {
            $_SESSION['login'] = $_POST['login'];
            echo 'Vous êtes connecté !';
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }*/
//header("Location: menuprincipal.php");
    try{
        if(isset($_POST['valide'])){
            
$MaBase = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
$ResultatDeRequeteBrut = $MaBase->query("SELECT * FROM `user` WHERE `identifiant `='".$_POST['login']."' AND `password` = '".$_POST['mdp']."'");
if($ResultatDeRequeteBrut->fetch()){
                $_SESSION["login"] = true;
            }else{
                echo "Le mot de passe ou le nom d'utilisateur est incorect";
            };
        }
    }catch(Exception $e){
        echo "J'ai eu un problème erreur :".$e->getMessage();
    }


}

function connectionbdd(){

    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');

}

function contact($nom, $prénom, $mail, $message)
{
    $BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $roquette = ("INSERT INTO `Contact`(`nom`, `prénom`, `mail`,`message`) VALUES ('$nom','$prénom','$mail','$message') ");
    $BDD->query("$roquette");
}
?>
