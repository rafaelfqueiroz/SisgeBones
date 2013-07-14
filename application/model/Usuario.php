<?php

class Usuario extends AbstractEntity {
    
    private $login;
    private $senha;
    private $tipo;
    
    /*
    tipos de usuario:
        administrador = 1;
        moderador = 2;
        professor = 3;
        aluno = 4;
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
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
?>
