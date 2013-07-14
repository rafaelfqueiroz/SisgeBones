<?php

/**
 * Description of ControllerOsso
 *
 * @author RAFAEL
 */
class ControllerUsuario extends CrudController {
    
    public function __construct() {
        $this->persistencia = new UsuarioPersistence();    
    }
    
    public function encontrarPorLogin($login) {
        $resultado = $this->persistencia->encontrarPorLogin(trim($login));
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
}

?>
