<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Emprestimo
 *
 * @author RAFAEL
 */
class Emprestimo extends AbstractEntity{
    private $dataEmprestimo;
    private $dataDevolucao;
    private $usuario;
    private $osso;
    private $administrador;
    
    public function Emprestimo() {}
    
    public function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }
    
    public function setDataEmprestimo($dataEmprestimo) {
        $this->dataEmprestimo = $dataEmprestimo;
    }
    
    public function getDataDevolução() {
        return $this->dataDevolucao;
    }
    
    public function setDataDevolução($dataDevolucao) {
        $this->dataDevolucao = $dataDevolucao;
    }
    
    public function getUsuario() {
        return $this->usuario;
    }
    
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    public function getOsso() {
        return $this->osso;
    }
    
    public function setOsso($osso) {
        $this->osso = $osso;
    }
    
    public function getAdministrador() {
        return $this->administrador;
    }
    
    public function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }
}

?>
