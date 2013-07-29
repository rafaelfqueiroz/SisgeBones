<?php
/**
 * Description of ControllerEmprestimo
 *
 * @author RAFAEL
 */
class ControllerEmprestimo extends CrudController{
    public function __construct() {
        $this->persistencia = new EmprestimoPersistence();
    }
    
    public function listarPendentes() {
        return $this->persistencia->listarPendentes();
    }
}

?>
