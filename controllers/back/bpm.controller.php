<?php
require_once "./controllers/back/Securite.class.php";
require_once "./models/back/bpm.manager.php";

class BpmController{
    private $bpmManager;

    public function __construct(){
        $this->bpmManager = new bpmManager();
    }

    public function visualisation(){
        if(Securite::verifAccessSession()){
            $bpm = $this->bpmManager->getBpm();
            require_once "views/bpmVisualisation.view.php";
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }

    public function suppression(){
        if(Securite::verifAccessSession()){
            $idBpm = (int)Securite::secureHTML($_POST['bpm_id']);
            
            if($this->BpmManager->compterBpm($idBpm) > 0){
                $_SESSION['alert'] = [
                    "message" => "Le bpm n'a pas été supprimé",
                    "type" => "alert-danger"
                ];
            } else {
                $this->BpmManager->deleteDBBpm($idBpm);
                $_SESSION['alert'] = [
                    "message" => "Le bpm est supprimée",
                    "type" => "alert-success"
                ];
            }
           
            header('Location: '.URL.'back/bpm/visualisation');
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }

    public function modification(){
        if(Securite::verifAccessSession()){
            $idBpm = (int)Securite::secureHTML($_POST['bpm_id']);
            $libelle = Securite::secureHTML($_POST['bpm_libelle']);
            $description = Securite::secureHTML($_POST['bpm_description']);
            $this->bpmManager->updateBpm($idBpm,$libelle,$description);

            $_SESSION['alert'] = [
                "message" => "Le bpm bien été modifiée",
                "type" => "alert-success"
            ];

            header('Location: '.URL.'back/bpm/visualisation');
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }

    public function creationTemplate(){
        if(Securite::verifAccessSession()){
            require_once "views/bpmCreation.view.php";
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }

    public function creationValidation(){
        if(Securite::verifAccessSession()){
            $libelle = Securite::secureHTML($_POST['bpm_libelle']);
            $description = Securite::secureHTML($_POST['bpm_description']);
            $idBpm = $this->bpmManager->createBpm($libelle,$description);

            $_SESSION['alert'] = [
                "message" => "Le bpm a bien été créée avec l'identifiant : ".$idBpm,
                "type" => "alert-success"
            ];

            header('Location: '.URL.'back/bpm/visualisation');
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }
}