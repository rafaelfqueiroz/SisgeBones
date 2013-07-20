<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author RAFAEL
 */

class Aluno extends AbstractEntity {        
    private $nome;
    private $matricula;
    private $curso;
    private $email;
    private $eMonitor;
    private $usuario;
    private $ativo;
    
    public function Aluno() {}
    
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
    
    public function getCurso() {
        return $this->curso;
    }
    
    public function setCurso($curso) {
        $this->curso = $curso;
    }
    
    public function getEmail() {
        return $this->email;
    } 
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getEMonitor() {
        return $this->eMonitor;
    } 
    public function setEMonitor($eMonitor) {
        $this->eMonitor = $eMonitor;
    }
    
    public function getUsuario() {
        return $this->usuario;
    } 
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    public function getAtivo() {
        return $this->ativo;
    } 
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
}

?>
