<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Osso
 *
 * @author RAFAEL
 */
class Osso extends AbstractEntity{
    private $nome;
    private $quantidade;
    private $codigo;
    
    public function Osso() {}
    
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getQuantidade(){
        return $this->quantidade;
    }
    
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
}

?>
