<?php
/**
 * Description of ControllerProfessor
 *
 * @author RAFAEL
 */
class ControllerProfessor extends CrudController {
    
    public function __construct() {
        $this->persistencia = new ProfessorPersistence();
    }
    
    public function encontrarProfessorPorIdUsuario($idUsuario) {
       $resultado = $this->persistencia->encontrarProfessorPorIdUsuario($idUsuario);       
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
}
?>
