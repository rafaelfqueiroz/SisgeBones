<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author RAFAEL
 */
interface Controller {
    
    function salvar($entidade);
    function remover($entidade);
    function atualizar($entidade);    
    function listar();
}

?>
