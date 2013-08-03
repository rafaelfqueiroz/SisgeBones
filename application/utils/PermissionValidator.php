<?php
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/model/Administrador.php';    

class PermissionValidator {
    public static function isAluno() {
        return (unserialize($_SESSION["usuario"]) instanceof Aluno);
    }
    
    public static function isProfessor() {
        return (unserialize($_SESSION["usuario"]) instanceof Professor);
    }
    
    public static function isAdministrador() {
        return (unserialize($_SESSION["usuario"]) instanceof Administrador);
    }
}
?>
