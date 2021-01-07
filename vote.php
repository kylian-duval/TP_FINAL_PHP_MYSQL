<?php try {
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Film</title>
        <!--ajout du css pour le style -->
        <link rel="stylesheet" href="vote.css">
        <!--ajout des fonction en php + ajout de connection a le bdd-->
        <?php include 'fonction.php';
        connectionbdd(); ?>
    </head>

    <body>
        <?php //affiche le menu
        menuco($BDD); ?>
        <?php //vérifi sur le user et conecter + vérifi si le user a deja voter
        if (isset($_SESSION['login'])) {

            if ($_SESSION['vote'] == 'non') {
                $request = $BDD->query("SELECT `id_film`, `nom`, `imgSource` FROM `film`"); ?>
                <form action="" method="post">
                    <select name="idfilme" id="SelectMedecin">
                        <?php
                        while ($data = $request->fetch()) {
                            echo '<option value="' . $data["id_film"] . '">' . $data['nom'] . '</option>';
                        } ?>
                    </select>
                    <p><input type="submit" name="vote" value="voté" /></p>

                    <?php $request = $BDD->query("SELECT `id_film`, `nom`, `imgSource` FROM `film`"); ?>
                    <?php
                    while ($data = $request->fetch()) { ?>
                        <!--tableau qui affiche les film-->
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



                    <?php } ?>
                </form>
            <?php } else {


            ?>
                <h1 class="error" align=center>vous avez voter voici les résultats des votes actuelles</h1>
                <table border="2">
                    <tr align=center>
                        <td>titre du film</td>
                        <td>nombre de vote</td>
                    </tr>
                    <?php $request = $BDD->query("SELECT `nom`, `nb_vote` FROM `film`");
                    while ($data = $request->fetch()) { ?>
                        <tr>
                            <td>
                                <?php echo $data['nom']; ?>
                            </td>
                            <td>
                                <?php echo $data['nb_vote']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php }
        } else { ?>

            <h1 class='error' align='center'>il faut que vous soyer connecter pour avoir la possibilité de voter</h1>
            <h3 class='error' align='center'>voici les résultats des votes actuelles</h3>
            <table border="2">
                <tr align=center>
                    <td>titre du film</td>
                    <td>nombre de vote</td>
                </tr>
                <?php $request = $BDD->query("SELECT `nom`, `nb_vote` FROM `film`");
                while ($data = $request->fetch()) { ?>
                    <tr>
                        <td>
                            <?php echo $data['nom']; ?>
                        </td>
                        <td>
                            <?php echo $data['nb_vote']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>



        <?php } ?>

        <?php
        //trétement des vote
        if (isset($_POST['vote'])) {
            $id_user = $_SESSION['id_user'];
            $idfilm = $_POST["idfilme"];

            $BDD->query("INSERT INTO `vote`(`id_user`, `id_film`) VALUES ('$id_user','$idfilm')");
            $resulnbvote = $BDD->query("SELECT `nb_vote` FROM `film` WHERE `id_film` = $idfilm");
            $BDD->query("UPDATE `user` SET `vote`='oui' WHERE `id_user` = $id_user ");
            while ($datavote = $resulnbvote->fetch()) {
                $nb_vote = $datavote['nb_vote'];
            };
            $nb_vote = $nb_vote + 1;
            $BDD->query("UPDATE `film` SET `nb_vote`= $nb_vote WHERE `id_film` = $idfilm");
            $_SESSION['vote'] = 'oui';
            echo '<meta http-equiv="refresh" content="0">';
        } ?>



    </body>

    </html>
<?php } catch (Exception $e) {

    echo "J'ai eu un problème erreur :" . $e->getMessage();
}  ?>