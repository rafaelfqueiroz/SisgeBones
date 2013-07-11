<?php
/**
 * Description of ControllerProfessor
 *
 * @author RAFAEL
 */
class ControllerProfessor extends CrudController {
    
    public function __construct() {
        $persistencia = new ProfessorPersistence();
    }
}
?>
