<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractEntity
 *
 * @author RAFAEL
 */
abstract class AbstractEntity {
    protected $id;
    public function __get($var) {
        return $this->$var;
    }
    public function __set($var,$value) {
        $this->$var = $value;
    }
}

?>
