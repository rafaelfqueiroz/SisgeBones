<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author RAFAEL
 */
interface AdministradorDao extends Dao {
    function encontrarAdministradorPorIdUsuario($idUsuario);
    function listarComoUsuario();
}

?>
