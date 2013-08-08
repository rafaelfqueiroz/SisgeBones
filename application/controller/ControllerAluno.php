<?php
/**
 * Description of ControllerAluno
 *
 * @author RAFAEL
 */
class ControllerAluno extends CrudController{
    
    public function __construct() {
        $this->persistencia = new AlunoPersistence();
    }
    
    public function encontrarAlunoPorIdUsuario($idUsuario) {
       $resultado = $this->persistencia->encontrarAlunoPorIdUsuario($idUsuario);       
        
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {            
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
    
    public function atualizarAluno($entidade) {
        $this->validateAtualizarAluno($entidade);
        parent::atualizar($entidade);
    }
    
    public function atualizarPerfilAluno($entidade) {
        $this->validatePerfilAluno($entidade);
        return parent::atualizar($entidade);
    }
    
    public function validatePerfilAluno($entidade) {
        $this->validationMesage($entidade);
        Validator::onErrorRedirectTo("../../pages/home/perfil.php");
    }
    
    public function validateAtualizarAluno($entidade) {
        $this->validationMesage($entidade);
        Validator::onErrorRedirectTo("../../pages/aluno/aluno-cadastrar.php?id={$entidade->getId()}");
    }
    
    public function validate($entidade) {
        $this->validationMesage($entidade);
        Validator::onErrorRedirectTo("../../pages/aluno/aluno-cadastrar.php");
    }
    
    public function validatePorPlanilha($entidade) {
        Validator::validate($entidade->getCurso() == null, "O campo curso deve ser preenchido");
        Validator::onErrorRedirectTo("../../pages/aluno/aluno-cadastrar-planilha.php");
    }
    public function salvarPorPlanilha($entidade) {
        $this->validatePorPlanilha($entidade);
        return $this->persistencia->salvar($entidade);
    }
    public function listarMonitores() {
        return $this->persistencia->listarMonitores();
    }
    
    public function validationMesage($entidade) {
        Validator::validate($entidade->getNome() == null, "O campo nome é obrigatório");
        Validator::validate($entidade->getMatricula() == null, "O campo matricula é obrigatório");
        Validator::validate($entidade->getEmail() == null, "O campo email é obrigatório");
        Validator::validate($entidade->getCurso() == null, "O campo curso é obrigatório");
    }
}
?>
