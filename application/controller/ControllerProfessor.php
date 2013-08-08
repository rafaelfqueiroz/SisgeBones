<?php
/**
 * Description of ControllerProfessor
 *
 * @author RAFAEL
 */
class ControllerProfessor extends CrudController {
    
    public function __construct() {
        $this->persistencia = new ProfessorPersistence();
    }
    
    public function encontrarProfessorPorIdUsuario($idUsuario) {
       $resultado = $this->persistencia->encontrarProfessorPorIdUsuario($idUsuario);       
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }
        return $uniqueValue;
    }
    
    public function atualizarPerfilProfessor($entidade) {
        $this->validatePerfilProfessor($entidade);
        return parent::atualizar($entidade);
    }
    
    public function validatePerfilProfessor($entidade) {
        $this->validateProfessorAtualizar($entidade);
        Validator::onErrorRedirectTo("../../pages/home/perfil.php");
    }
    
    public function atualizarProfessor($entidade) {
        $this->validateProfessorAtualizar($entidade);
        return parent::atualizar($entidade);
    }
    
    public function validateProfessorAtualizar($entidade) {
        $this->validationMessage($entidade);
        Validator::onErrorRedirectTo("../../pages/professor/professor-editar.php?id={$entidade->getId()}");
    }

    public function validate($entidade) {
        $this->validationMessage($entidade);
        Validator::onErrorRedirectTo("../../pages/professor/professor-cadastrar.php");
    }
    
    public function validationMessage($entidade) {
        Validator::validate($entidade->getNome() == null, "O campo nome é obrigatório");
        Validator::validate($entidade->getMatricula() == null, "O campo matricula é obrigatório");
        Validator::validate($entidade->getEmail() == null, "O campo email é obrigatório");
        Validator::validate($entidade->getRg() == null, "O campo rg é obrigatório");
    }
}
?>
