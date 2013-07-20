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
interface UsuarioDao extends Dao{
    function encontrarPorLogin($login);
    function encontrarPorLoginESenha($login, $senha);
}

?>
