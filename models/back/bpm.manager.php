<?php

require_once "models/Model.php";

class BpmManager extends Model{
    public function getBpm(){
        $req = "SELECT * from bpm";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $bpm = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bpm;
    }

    public function deleteDBfamille($idBpm){
        $req ="Delete from bpm where bpm_id= :idBpm";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idBpm",$idBpm,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function compterBpm($idBpm){
        $req ="Select count(*) as 'nb'
        from bpm b inner join instru i on i.bpm_id = b.bpm_id
        where b.bpm_id = :idBpm";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idBpm",$idBpm,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['nb'];
    }

    public function updateBpm($idBpm,$libelle,$description){
        $req ="Update bpm set bpm_libelle = :libelle, bpm_description = :description
        where bpm_id= :idBpm";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idBpm",$idBpm,PDO::PARAM_INT);
        $stmt->bindValue(":libelle",$libelle,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function createBpm($libelle,$description){
        $req ="Insert into bpm (bpm_libelle,bpm_description)
            values (:libelle,:description)
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":libelle",$libelle,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return $this->getBdd()->lastInsertId();
    }
}