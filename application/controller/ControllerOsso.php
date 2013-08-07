<?php

/**
 * Description of ControllerOsso
 *
 * @author RAFAEL
 */
class ControllerOsso extends CrudController {
    
    public function __construct() {
        $this->persistencia = new OssoPersistence();    
    }
    
    public function encontrarPorCodigo($codigo) {
        $resultado = $this->persistencia->encontrarPorCodigo(trim($codigo));
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {
            $uniqueValue = $resultado[0];
        }
        return $uniqueValue;
    }
    
    public function atualizarOsso($entidade, $idOsso) {
        $this->validateOssoAtualizar($entidade, $idOsso);
        $this->persistencia->atualizar($entidade);
    }
    
    public function validateOssoAtualizar($entidade, $idOsso) {
        Validator::validate($entidade == null, "Preencha todos os campos");
        Validator::validate($entidade->getCodigo() == null, "O campo código é necessário");
        Validator::validate($entidade->getNome() == null, "O campo nome é necessário");
        Validator::validate($entidade->getQuantidade() == null, "O campo quantidade é necessário");
        Validator::onErrorRedirectTo("../../pages/osso/osso-editar.php?id={$idOsso}");
    }


    public function validate($entidade) {
        Validator::validate($entidade == null, "Preencha todos os campos");
        Validator::validate($entidade->getCodigo() == null, "O campo código é necessário");
        Validator::validate($entidade->getNome() == null, "O campo nome é necessário");
        Validator::validate($entidade->getQuantidade() == null, "O campo quantidade é necessário");
        Validator::onErrorRedirectTo("../../pages/osso/osso-cadastrar-novo.php");
    }
}

?>
