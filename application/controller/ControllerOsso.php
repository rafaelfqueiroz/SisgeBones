<?php

/**
 * Description of ControllerOsso
 *
 * @author RAFAEL
 */
class ControllerOsso extends CrudController {
    
    public function __construct() {
        $this->persistencia = new OssoPersistence();    
    }
    
    public function encontrarPorCodigo($codigo) {
        $resultado = $this->persistencia->encontrarPorCodigo(trim($codigo));
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {
            $uniqueValue = $resultado[0];
        }
        return $uniqueValue;
    }
}

?>
