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
    
    public function atualizarProfessor($entidade, $idProfessor) {
        $this->validateProfessorAtualizar($entidade, $idProfessor);
        parent::atualizar($entidade);
    }
    
    public function validateProfessorAtualizar($entidade, $idProfessor) {
        Validator::validate($entidade->getNome(), "O campo nome é obrigatório");
        Validator::validate($entidade->getMatricula(), "O campo matricula é obrigatório");
        Validator::validate($entidade->getEmail(), "O campo email é obrigatório");
        Validator::validate($entidade->getRg(), "O campo rg é obrigatório");
        Validator::onErrorRedirectTo("../../pages/professor/professor-editar.php?id={$idProfessor}");
    }

    public function validate($entidade) {
        Validator::validate($entidade->getNome(), "O campo nome é obrigatório");
        Validator::validate($entidade->getMatricula(), "O campo matricula é obrigatório");
        Validator::validate($entidade->getEmail(), "O campo email é obrigatório");
        Validator::validate($entidade->getRg(), "O campo rg é obrigatório");
        Validator::onErrorRedirectTo("../../pages/professor/professor-cadastrar.php");
    }
}
?>
