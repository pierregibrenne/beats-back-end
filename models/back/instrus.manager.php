<?php

require_once "models/Model.php";

class InstrusManager extends Model{
    public function getInstrus(){
        $req = "SELECT * from instru";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $instrus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $instrus;
    }

    public function deleteDBInstruGenre($idInstru){
        $req ="Delete from instru_genre where instru_id= :idInstru";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idInstru",$idInstru,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function deleteDBInstru($idInstru){
        $req ="Delete from instru where instru_id= :idInstru";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idInstru",$idInstru,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // public function compterBpm($idBpm){
    //     $req ="Select count(*) as 'nb'
    //     from bpm b inner join instru i on i.bpm_id = b.bpm_id
    //     where b.bpm_id = :idBpm";
    //     $stmt = $this->getBdd()->prepare($req);
    //     $stmt->bindValue(":idBpm",$idBpm,PDO::PARAM_INT);
    //     $stmt->execute();
    //     $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $stmt->closeCursor();
    //     return $resultat['nb'];
    // }

    // public function updateBpm($idBpm,$libelle,$description){
    //     $req ="Update bpm set bpm_libelle = :libelle, bpm_description = :description
    //     where bpm_id= :idBpm";
    //     $stmt = $this->getBdd()->prepare($req);
    //     $stmt->bindValue(":idBpm",$idBpm,PDO::PARAM_INT);
    //     $stmt->bindValue(":libelle",$libelle,PDO::PARAM_STR);
    //     $stmt->bindValue(":description",$description,PDO::PARAM_STR);
    //     $stmt->execute();
    //     $stmt->closeCursor();
    // }

    // public function createBpm($libelle,$description){
    //     $req ="Insert into bpm (bpm_libelle,bpm_description)
    //         values (:libelle,:description)
    //     ";
    //     $stmt = $this->getBdd()->prepare($req);
    //     $stmt->bindValue(":libelle",$libelle,PDO::PARAM_STR);
    //     $stmt->bindValue(":description",$description,PDO::PARAM_STR);
    //     $stmt->execute();
    //     $stmt->closeCursor();
    //     return $this->getBdd()->lastInsertId();
    // }
}