<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerAdministrador
 *
 * @author RAFAEL
 */
class ControllerAdministrador extends CrudController {
    
    public function __construct() {
        $this->persistencia = new AdministradorPersistence();
    }
    
    public function encontrarAdministradorPorIdUsuario($idUsuario) {
       $resultado = $this->persistencia->encontrarAdministradorPorIdUsuario($idUsuario);       
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
    
    public function atualizarAdministrador($entidade, $idAdministrador) {
        $this->validateAdministradorAtualizar($entidade, $idAdministrador);
        parent::atualizar($entidade);
    }
    
    public function validateAdministradorAtualizar($entidade, $idAdministrador) {
        Validator::validate($entidade == null, "Preencha os campos corretamente");
        Validator::validate($entidade->getNome() == null, "O campo nome deve ser preenchido");
        Validator::validate($entidade->getMatricula() == null, "O campo matricula deve ser preenchido");
        Validator::validate($entidade->getEmail() == null, "O campo email deve ser preenchido");
        Validator::onErrorRedirectTo("../../pages/administrador/administrador-editar.php?id={$idAdministrador}");
    }
    
    public function validate($entidade) {
        Validator::validate($entidade == null, "Preencha os campos corretamente");
        Validator::validate($entidade->getNome() == null, "O campo nome deve ser preenchido");
        Validator::validate($entidade->getMatricula() == null, "O campo matricula deve ser preenchido");
        Validator::validate($entidade->getEmail() == null, "O campo email deve ser preenchido");
        Validator::onErrorRedirectTo("../../pages/administrador/administrador-cadastrar.php");
    }
}

?>
