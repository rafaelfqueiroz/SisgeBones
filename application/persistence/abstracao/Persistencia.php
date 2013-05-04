<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persistencia
 *
 * @author RAFAEL
 */
abstract class AbstractPersistence implements Dao{
    public function atualizar($entidade) {}

    public function encontrarPorId($id) {}

    public function listar() {}

    public function remover($entidade) {}

    public function salvar($entidade) {}
}

?>
