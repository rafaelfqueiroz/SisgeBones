<?php
/**
 * Description of ControllerAluno
 *
 * @author RAFAEL
 */
class ControllerAluno extends CrudController{
    
    public function __construct() {
        $persistence = new AlunoPersistence();
    }
}
?>
