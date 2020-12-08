<?php 
    class film 
    {
        private $_bdd;

        public function __construct()
        {
            $this->_bdd = new PDO('mysql:host=localhost; dbname=film; charset=utf8', 'root', '');
        }

        public function displayFilm()
        {
            $request = $this->_bdd->query("SELECT * FROM film");

            while($data = $request->fetch())
            {
                echo $data['nom'];
                echo $data['img'];
            }
        }

    }
?>