<?php

/**
 * Description of ControllerOsso
 *
 * @author RAFAEL
 */
class ControllerOsso extends CrudController {
    
    public function __construct() {
        $persistence = new OssoPersistence();
    }
}

?>
