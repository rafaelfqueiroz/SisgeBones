<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dao
 *
 * @author RAFAEL
 */
interface Dao {
   function encontrarPorId($id);
   function salvar($entidade);
   function remover($entidade);
   function atualizar($entidade);
   function listar();
}

?>
