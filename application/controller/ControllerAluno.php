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
    
    public function atualizarAluno($entidade, $idAluno) {
        $this->validateAtualizarAluno($entidade, $idAluno);
        parent::atualizar($entidade);
    }
    
    public function validateAtualizarAluno($entidade, $idAluno) {
        Validator::validate($entidade->getNome(), "O campo nome é obrigatório");
        Validator::validate($entidade->getMatricula(), "O campo matricula é obrigatório");
        Validator::validate($entidade->getEmail(), "O campo email é obrigatório");
        Validator::validate($entidade->getCurso(), "O campo curso é obrigatório");
        Validator::onErrorRedirectTo("../../pages/aluno/aluno-cadastrar.php?id={$idAluno}");
    }
    
    public function validate($entidade) {
        Validator::validate($entidade->getNome(), "O campo nome é obrigatório");
        Validator::validate($entidade->getMatricula(), "O campo matricula é obrigatório");
        Validator::validate($entidade->getEmail(), "O campo email é obrigatório");
        Validator::validate($entidade->getCurso(), "O campo curso é obrigatório");
        Validator::onErrorRedirectTo("../../pages/aluno/aluno-cadastrar.php");
    }
    public function listarMonitores() {
        return $this->persistencia->listarMonitores();
    }
}
?>
