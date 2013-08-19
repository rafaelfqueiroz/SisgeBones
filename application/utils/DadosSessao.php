<?php
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/model/Administrador.php';

    class DadosSessao {
        
        public static function getDadosSessao() {
            return ($_SESSION["sUsuario"]);
        }
    }
?>
