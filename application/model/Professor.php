<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Professor
 *
 * @author RAFAEL
 */
class Professor extends AbstractEntity{
    
    private $nome;
    private $matricula;
    private $email;
    private $rg;
    private $usuario;
    
    public function Professor() {}
    
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
    
    public function getRg() {
        return $this->rg;
    }
    
    public function setRg($rg) {
        $this->rg = $rg;
    }
    
    public function getUsuario() {
        return $this->usuario;
    }
    
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
}
?>
