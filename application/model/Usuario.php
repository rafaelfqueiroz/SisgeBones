<?php

class Usuario extends AbstractEntity {
    
    private $login;
    private $senha;
    private $tipo;
    
    /*
    tipos de usuario:
        administrador = 1;
        moderador = 2;
        professor = 3;
        aluno = 4;
    */
    public function Usuario() { }
}
?>
