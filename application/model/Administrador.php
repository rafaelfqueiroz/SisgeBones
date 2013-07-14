<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author RAFAEL
 */
class Administrador extends AbstractEntity {
    private $nome;
    private $matricula;
    private $email;
    private $usuario;
    
    public function Administrador() {}
    
    public function getNome() {
        return $this->nome;
    } 
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function getMatricula() {
        return $this->matricula;
    } 
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }
    public function getEmail() {
        return $this->email;
    } 
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getUsuario() {
        return $this->usuario;
    } 
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
}

?>
