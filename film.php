<?php 
    class film 
    {
        private $_bdd;

        public function __construct()
        {
            $this->_bdd = new PDO('mysql:host=192.168.65.227; dbname=film; charset=utf8', 'kiki', 'kiki');
        }

        public function displayFilm()
        {
            $request = $this->_bdd->query("SELECT nom, imgSource FROM film");

            while($data = $request->fetch())
            {
                echo "<p>".$data['nom']."</p>";
                echo "<img src = ".$data['imgSource'].">";
                
            }
        }

    }
?>