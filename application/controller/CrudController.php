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
        $this->persistencia->listar();
    }
    public function remover($entidade) {
        $this->persistencia->remover($entidade);
    }
    public function salvar($entidade) {
        $this->persistencia->salvar($entidade);
        
    }
}

?>
