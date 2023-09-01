<?php

require_once "models/Model.php";

class GenresManager extends Model{
    public function getGenres(){
        $req = "SELECT * from genre";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $instrus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $instrus;
    }
}