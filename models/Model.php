<?php
// class abstract , jamais instanciable 
abstract class Model{
    // instance unique de pdo
    private static $pdo;
    // connexion a la bd
    private static function setBdd(){
        // on rappel notre variable static avec self , $pdo
        self ::$pdo = new PDO ("mysql:host=localhost;dbname=dbsuikerfinale;charset=utf8","root","");
        self ::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    
    }
    // verifie si il n'y a pas encore de connexion a $pdo ,si ce n'est pas le cas elle appel setBdd
    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
    public static function sendJSON($info){
        // pour pas avoir de probleme et accepter toute les demande avec *
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode($info);
    }
} 