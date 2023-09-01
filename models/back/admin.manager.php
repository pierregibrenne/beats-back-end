<?php

require_once "./models/Model.php";

class AdminManager extends Model{
    private function getPasswordUser($login){
        $req= 'SELECT * FROM administrateur WHERE login = :login';
        // connexion a la bd en premier
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        // j'execute
        $stmt->execute();
        // je recup l'info , juste une ligne donc fetch et fecth assoc pour pas l'avoir plusieurs fois 
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $admin['password'];
    }
// function pour verifier 
    public function isConnexionValid($login,$password){
        $passwordBD = $this->getPasswordUser($login);
        // return un bool qui verifie le password envoyer par le form avec le password BD
        return password_verify($password,$passwordBD);
    }
}

?>