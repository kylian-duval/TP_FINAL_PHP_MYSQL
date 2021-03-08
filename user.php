<?php 
    class user
    {
        private $_email;
        private $_mdp;
        private $_mdpConfirm;
        private $_nom;
        private $_prenom;

        public function __construct($email, $mdp, $mdpConfirm, $nom, $prenom)
        {
            $this->_email = $email;
            $this->_mdp = $mdp;
            $this->_mdpConfirm = $mdpConfirm;
            $this->_nom = $nom;
            $this->_prenom = $prenom;
        }

        public function verifUserConnect()
        {
            if (filter_var($this->_email, FILTER_VALIDATE_EMAIL))
            {
                if (!empty($this->_mdp))
                {
                    $bdd = new PDO('mysql:host=localhost; dbname=film; charset=utf8', 'root', '');
                    $request = $bdd->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
                    $request->execute(array($this->_email, $this->_mdp));
                    $userExist = $request->rowCount();

                    if ($userExist == 1)
                    {
                        $data = $request->fetch();
                        session_start();
                        $_SESSION['logged'] = true;
                        $_SESSION['id'] = $data['id_user'];
                        $_SESSION['droits'] = $data['droit'];
                        return "succesConnect";
                    }
                    else
                    {
                        return "userDoesntExist";
                    }
                }
                else
                {
                    return "noPassword";
                }
            }
            else
            {
                return "invalidMail";
            }
        }

        public function registUser()
        {
            if (filter_var($this->_email, FILTER_VALIDATE_EMAIL)) {
                if(!empty($this->_mdp)){
                    if(!empty($this->_nom) && !empty($this->_prenom)){
                        if($this->_mdp == $this->_mdpConfirm){
                            $bdd = new PDO('mysql:host=localhost; dbname=film; charset=utf8', 'root', '');
                            $requeteMail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
                            $requeteMail->execute(array($this->_email));
                            $userExist = $requeteMail->rowCount();
                            if($userExist == 1){ 
                                return "mailUsed";
                            }
                            else{
                                $requeteInscription = $bdd->query("INSERT INTO `user`(`id_user`, `nom`, `prenom`, `email`, `droit`, `password`) VALUES (NULL,'".$this->_nom."','".$this->_prenom."','".$this->_email."','USER','".$this->_mdp."')");
                                return "succesRegister";
                            }
                        }
                        else{
                            return "mdpDifferents";
                        }
                    }
                    else{
                        return "nomPrenomVide";
                    }
                }
                else{
                    return "mdpVide";
                }
            }
            else{
                return "mailInvalide";
            }
        }
        public function conactat () {






        }

        public function errorGestion($erreur)
        {
            if($erreur == "userDoesntExist")
            {
                echo "<p class='red-text'>E-mail ou mot de passe incorrect</p>";
            }
            if($erreur == "noPassword")
            {
                echo "<p class='red-text'>Merci de remplir le champ mot de passe</p>";
            }
            if($erreur == "invalidMail")
            {
                echo "<p class='red-text'>L'adresse e-mail est invalide</p>";
            }
            if($erreur == "succesConnect")
            {
                echo "<p class='green-text'>Connecté!</p>";
            }
            if($erreur == "mdpDifferents"){
                echo "<p class='red-text'>Les deux mots de passes ne correspondent pas</p>";
            }
            if($erreur == "mailInvalide"){
                echo "<p class='red-text'>L'adresse e-mail est incorrecte</p>";
            }
            if($erreur == "mdpVide"){
                echo "<p class='red-text'>Merci de remplir le champ mot de passe</p>";
            }
            if($erreur == "nomPrenomVide"){
                echo "<p class='red-text'>Merci de remplir les champs nom et prenom</p>";
            }
            if($erreur == "mailUsed"){
                echo "<p class='red-text'>Adresse e-mail déjà utilisée</p>";
            }
            if($erreur == "succesRegister"){
                echo "<p class='green-text'>Vous êtes inscris!</p>";
            }
        }
    }
