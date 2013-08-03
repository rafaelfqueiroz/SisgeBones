<?php
/**
 * Description of ControllerAluno
 *
 * @author RAFAEL
 */
class ControllerAluno extends CrudController{
    
    public function __construct() {
        $this->persistencia = new AlunoPersistence();
    }
    
    public function encontrarAlunoPorIdUsuario($idUsuario) {
       $resultado = $this->persistencia->encontrarAlunoPorIdUsuario($idUsuario);       
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
    public function listarMonitores() {
        return $this->persistencia->listarMonitores();
    }
}
?>
