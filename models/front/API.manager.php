<?php
require_once "models/Model.php";
// on fait appel au model
class APIManager extends Model{
    public function getDBInstrus(){
        $req ="SELECT *
         from instru i inner join bpm b on b.bpm_id = i.bpm_id 
         inner join instru_genre ig on ig.instru_id = i.instru_id
         inner join genre g on g.genre_id = ig.genre_id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        // fetch assoc evite d'avoir 2 fois les info 
        $instrus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $instrus;
    }
    public function getDBInstru($idInstru){
        $req ="SELECT *
         from instru i inner join bpm b on b.bpm_id = i.bpm_id 
         inner join instru_genre ig on ig.instru_id = i.instru_id
         inner join genre g on g.genre_id = ig.genre_id
         WHERE i.instru_id = :idInstru
         ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idInstru",$idInstru,PDO::PARAM_INT);
        $stmt->execute();
        $lignesInstru = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesInstru;
    }
    public function getDBBpm() {
        $req ="SELECT *
        from bpm 
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $bpm = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bpm;
    }
    public function getDBGenre() {
        $req ="SELECT *
        from genre
        ";
       $stmt = $this->getBdd()->prepare($req);
       $stmt->execute();
       $genre = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $stmt->closeCursor();
       return $genre;
    }
}