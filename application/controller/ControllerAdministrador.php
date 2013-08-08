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
    
    public function atualizarPerfilAdministrador($entidade) {
        $this->validatePerfilAdministrador($entidade);
        return parent::atualizar($entidade);
    }
    
    public function validatePerfilAdministrador($entidade) {
        $this->validationMessage($entidade);
        Validator::onErrorRedirectTo("../../pages/home/perfil.php");
    }
    
    public function atualizarAdministrador($entidade, $idAdministrador) {
        $this->validateAdministradorAtualizar($entidade, $idAdministrador);
        return parent::atualizar($entidade);
    }
    
    public function validateAdministradorAtualizar($entidade) {
        $this->validationMessage($entidade);
        Validator::onErrorRedirectTo("../../pages/administrador/administrador-editar.php?id={$entidade->getId()}");
    }
    
    public function validate($entidade) {
        $this->validationMessage($entidade);
        Validator::onErrorRedirectTo("../../pages/administrador/administrador-cadastrar.php");
    }
    
    public function validationMessage($entidade) {
        Validator::validate($entidade == null, "Preencha os campos corretamente");
        Validator::validate($entidade->getNome() == null, "O campo nome deve ser preenchido");
        Validator::validate($entidade->getMatricula() == null, "O campo matricula deve ser preenchido");
        Validator::validate($entidade->getEmail() == null, "O campo email deve ser preenchido");
    }
}

?>
