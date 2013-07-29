<?php

class Usuario extends AbstractEntity {
    
    private $login;
    private $senha;
    private $tipo;
    private $referente;
    
    /*
    tipos de usuario:
        administrador = 1; { moderador = true }
        professor = 2;
        aluno = 3 { monitor = true }
    */
    public function Usuario() { }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function getReferente() {
        return $this->referente;
    }
    
    public function setReferente($referente) {
        $this->referente = $referente;
    }
    
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
?>
