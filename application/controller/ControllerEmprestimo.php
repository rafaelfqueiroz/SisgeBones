<?php
/**
 * Description of ControllerEmprestimo
 *
 * @author RAFAEL
 */
class ControllerEmprestimo extends CrudController{
    public function __construct() {
        $persistencia = new EmprestimoPersistence();
    }
}

?>
