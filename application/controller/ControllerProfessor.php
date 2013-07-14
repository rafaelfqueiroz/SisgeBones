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
}
?>
