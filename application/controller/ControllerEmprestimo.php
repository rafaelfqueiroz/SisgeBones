<?php
/**
 * Description of ControllerEmprestimo
 *
 * @author RAFAEL
 */
class ControllerEmprestimo extends CrudController{
    public function __construct() {
        $this->persistencia = new EmprestimoPersistence();
    }
    
    public function listarPendentes() {
        return $this->persistencia->listarPendentes();
    }
    
    public function listarEmprestimosUsuario() {
        $usuario = DadosSessao::getDadosSessao()->getUsuario();
        return $this->persistencia->listarEmprestimosUsuario($usuario);
    }
    
    public function listarOssosDeEmprestimo($entidade) {
        return $this->persistencia->listarOssosDeEmprestimo($entidade);
    }
    
    public function validate($entidade) { 
        Validator::validate($entidade == null,"Preencha os campos corretamente.");
        Validator::validate($entidade->getOssos() == null,"Nenhum osso foi escolhido para o empréstimo");
        Validator::validate($entidade->getUsuario() == null,"Nenhum usuario foi escolhido para o empréstimo");
        Validator::onErrorRedirectTo("../../pages/emprestimo/emprestimo-registrar.php");
    }
}

?>
