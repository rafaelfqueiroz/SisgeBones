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
}

?>
