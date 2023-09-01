<?php
require_once "models/front/API.manager.php";
require_once "models/Model.php";

class APIController{
   
    private $apiManager;
    // on instancie l'apimanager a l'interieur de nos APIController
    public function __construct(){
        $this->apiManager = new APIManager();
    }

    public function getInstrus(){
        // variable qui prend les info que le manager récupère 
        $instrus = $this->apiManager->getDBInstrus();
        $tabResultat =$this->formatDataLignesInstrus($instrus);
        Model::sendJSON($tabResultat);
    }
    public function getInstru($idInstru){
        
        $lignesInstru = $this->apiManager->getDBInstru($idInstru);
        $tabResultat =$this->formatDataLignesInstrus($lignesInstru);
        Model::sendJSON($tabResultat);

        
    }
    private function formatDataLignesInstrus($lignes){
        // on fait un tableau, on parcours les lignes
        $tab = [];
        foreach($lignes as $ligne){
            // permet de tester si l'instru est déja ajouter dans le tableau et de ne pas regenerer une nouvelle ligne
            // on la complete avec tous genre qu'on parcours dans le foreach
            if(!array_key_exists($ligne['instru_id'],$tab)){
            $tab[$ligne['instru_id']]= [
                "id" => $ligne['instru_id'],
                "nom" => $ligne['instru_nom'],
                "description" => $ligne['instru_description'],
                "image" => URL."public/images/". $ligne['instru_image'],
                "son" => URL."public/audio/".$ligne['instru_son'],
                "bpm" => [
                    "idBpm" => $ligne['bpm_id'],
                    "libelleBpm"=>$ligne['bpm_libelle'],
                    "descritpionBpm"=>$ligne['bpm_description']
                ]
            ];
        }
            $tab[$ligne['instru_id']]['genre'][] = [
                "idGenre" => $ligne['genre_id'],
                "libelleGenre" => $ligne['genre_libelle']
            ];
        }
        

        return $tab;
    }
    public function getGenre(){
        $genre = $this->apiManager->getDBGenre();
        Model::sendJSON($genre); 
    }
    public function getBPM(){
        $bpm = $this->apiManager->getDBBpm();
        // on met les info en json pour que ce sois plus facile a manipuler 
        Model::sendJSON($bpm);
        
    }
    public function sendMessage(){
        // j'accepte toute les demandes , je peux changer juste pour mon site a la place du*
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
        $obj = json_decode(file_get_contents('php://input'));
        
        $messageRetour = [
            'from' => $obj->email,
            'to' => "pierre.gibrenne@protonmail.com"
        ];
        header("Content-Type: application/json");

        echo json_encode($messageRetour);
    }
}