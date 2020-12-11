<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Table</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <a href="index.php">Revenir Au Crud Medecin</a>
    <?php
    //on va récupérer l'id du Medecin via méthode Get
    //pour afficher cette page <a href="Medecin.php?idMedecin=id">Medecin N° id<a>
    // remplacer id par le vrai id de la clé primaire
    $IdMedecin = null;
    if (!isset($_GET['IdMedecin'])) {
        echo "<h1> Il n'y a pas de Medecin à afficher </h1>";
    } else {
        $IdMedecin = $_GET['IdMedecin'];
        //Récupération des données du Medecin N° IdMedecin
        // Variable utilise pour la connexion à la bdd
        $ipServerSQL = "192.168.65.132";
        $NomBase = "Clinique";
        $UserBDD = "SiteWeb";
        $PassBDD = "SiteWeb";
        $BasePDO = null;
        //Etape 2 Connexion à la bdd avec PDO si $Crud != 0;
        //PDO attend une ip de MySQL , le nom de la base , un user avec son mot de pass qui as les privilèges sur cette base
        try {
            $BasePDO = new PDO(
                "mysql:host=" . $ipServerSQL . ";dbname=" . $NomBase . ";port=3306",
                $UserBDD,
                $PassBDD
            );
            if ($BasePDO) {
                $req = "SELECT * FROM MEDECIN WHERE IdMedecin='" . $IdMedecin . "'";
                $RequetStatement = $BasePDO->query($req);
                if ($RequetStatement) {
                    $Tab = $RequetStatement->fetch();
    ?>
                    <h1>Voici la page template des données de Medecin</h1>
                    <p>Nom : <?php echo $Tab['Nom']; ?> </p>
                    <p>Prenom : <?php echo $Tab['Prenom']; ?> </p>
    <?php
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    ?>
</body>

</html>