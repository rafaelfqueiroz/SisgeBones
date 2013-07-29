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
    private $quantidade;
    private $status;
    private $ossos;
    private $usuario;
    private $administrador;
    
    public function Emprestimo() {}
    
    public function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }
    
    public function setDataEmprestimo($dataEmprestimo) {
        $this->dataEmprestimo = $dataEmprestimo;
    }
    
    public function getDataDevolucao() {
        return $this->dataDevolucao;
    }
    
    public function setDataDevolucao($dataDevolucao) {
        $this->dataDevolucao = $dataDevolucao;
    }
    
    public function  getQuantidade() {
        return $this->quantidade;
    }
    
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    
    public function  getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function  getOssos() {
        return $this->ossos;
    }
    
    public function setOssos($ossos) {
        $this->ossos = $ossos;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    public function getAdministrador() {
        return $this->administrador;
    }
    
    public function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }
}

?>
