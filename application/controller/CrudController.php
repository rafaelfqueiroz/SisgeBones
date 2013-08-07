<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrudController
 *
 * @author RAFAEL
 */
abstract class CrudController implements Controller {
    
    protected $persistencia;
    
    public function atualizar($entidade) {
        //lembrar de inserir código para escapagem para evitar sql injection        
        $this->persistencia->atualizar($entidade);
    }
    public function listar() {        
        return $this->persistencia->listar();
    }
    
    public function listarComoUsuario() {
        return $this->persistencia->listarComoUsuario();
    }
    public function remover($entidade) {
        $this->persistencia->remover($entidade);
    }
    public function salvar($entidade) {
        $this->validate($entidade);
        return $this->persistencia->salvar($entidade);              
    }
    public function encontrarPorId($entidade) {
        $resultado = $this->persistencia->encontrarPorId($entidade);
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        
        return $uniqueValue;        
    }
    
    public function validate($entidade) {
        
    }
}

?>
