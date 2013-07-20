<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerAdministrador
 *
 * @author RAFAEL
 */
class ControllerAdministrador extends CrudController {
    
    public function __construct() {
        $this->persistencia = new AdministradorPersistence();
    }
    
    public function encontrarAdministradorPorIdUsuario($idUsuario) {
       $resultado = $this->persistencia->encontrarAdministradorPorIdUsuario($idUsuario);       
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
}

?>
