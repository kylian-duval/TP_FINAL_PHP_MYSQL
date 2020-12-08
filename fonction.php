<link rel="stylesheet" href="css.css">
<?php session_start(); 
function menuco(){
if(isset($_SESSION['login'])) { ?>
    <nav>
        <div class='test'>
        <ul>
            <li><a href="#">Acceuil</a></li>
            <li><a href="#">Contact</a></li>
            <form action="" method="post"><li><input type="submit" name="deco" value="Déconection"/></li></form>
        </ul>
    </div>
    </nav>
<?php }else{ ?>
 <nav>
        <div class='test'>
        <ul>
            <li><a href="#">Acceuil</a></li>
            <li><a href="#">Contact</a></li>
            <form action="" method="post"> 
            <li><p><input type="text" name="login" placeholder="entrée le login"> </p><p><input type="password" name="mdp" placeholder="votre mots de passe"> </p></li>
            <li><div class="pading"><input type="submit" name="valide" value="Connection"/></div></li></form>
            <div class='inscrire'><button onclick="window.location.href = 'inscrire.php';"> S'inscrire</button></div>
        </ul>
    </div>
    </nav>   
<?php }
$nom = 'kiki';
$password = '1234';

if (isset($_POST['valide'])) {
    if ($_POST['login'] == $nom) {
        if ($_POST['mdp'] == $password) {
            $_SESSION['login'] = $_POST['login'];
        } else echo 'le mot de passe est incorrect. ';
    } else echo 'le login est inconnu. ';
    echo '<meta http-equiv="refresh" content="0">';
}


if(isset($_POST['deco'])){   
    session_destroy();
    echo '<meta http-equiv="refresh" content="0">';
    
}
} ?>