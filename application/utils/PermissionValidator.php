<?php
    $uri = $_SERVER["PHP_SELF"];
    if ($uri == "/sisgebones/index.php") {
        include_once 'application/model/AbstractEntity.php';
        include_once 'application/model/Aluno.php';
        include_once 'application/model/Professor.php';
        include_once 'application/model/Administrador.php';
    } else {
        include_once '../../application/model/AbstractEntity.php';
        include_once '../../application/model/Aluno.php';
        include_once '../../application/model/Professor.php';
        include_once '../../application/model/Administrador.php';    
    }

class PermissionValidator {
    public static function isAluno() {
        return (($_SESSION["sUsuario"]) instanceof Aluno);
    }
    
    public static function isProfessor() {
        return (($_SESSION["sUsuario"]) instanceof Professor);
    }
    
    public static function isAdministrador() {
        return (($_SESSION["sUsuario"]) instanceof Administrador);
    }
}
?>
