<?php
require_once "./controllers/back/Securite.class.php";
require_once "./models/back/instrus.manager.php";
require_once "./models/back/bpm.manager.php";
require_once "./models/back/genre.manager.php";


class InstrusController{
    private $instrusManager;

    public function __construct(){
        $this->instrusManager = new InstrusManager();
    }

    public function visualisation(){
        if(Securite::verifAccessSession()){
            $instrus = $this->instrusManager->getInstrus();
            require_once "views/instrusVisualisation.view.php";
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }
    public function suppression(){
        if(Securite::verifAccessSession()){
            $idInstru = (int)Securite::secureHTML($_POST['instru_id']);
            $this->InstruManager->deleteDBInstruGenre($idInstru);
            $this->InstruManager->deleteDBInstru($idInstru);
            $_SESSION['alert'] = [
                "message" => "Le bpm est supprimée",
                "type" => "alert-success"
                ];
            header('Location:'.URL.'back/instrus/visualisation');
            } else{
                throw new Exception("Vous n'avez pas le droit d'etre la ");
            }
            
    }
    public function creation(){
        if(Securite::verifAccessSession()){
            $bpmManager = new BpmManager();
            $bpm = $bpmManager->getBpm();
            $genresManager = new GenresManager();
            $genres = $genresManager->getGenres();
            require_once "views/instruCreation.view.php";
            } else{
                throw new Exception("Vous n'avez pas le droit d'etre la ");
            }
            
    }
}

