<?php

/**
 * Description of ControllerOsso
 *
 * @author RAFAEL
 */
class ControllerUsuario extends CrudController {
    
    public function __construct() {
        $this->persistencia = new UsuarioPersistence();    
    }
    
    public function encontrarPorLogin($login) {
        $resultado = $this->persistencia->encontrarPorLogin(trim($login));
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {
            $uniqueValue = $resultado[0];
        }        
        return $uniqueValue;
    }
    
    public function validateToLogon($login, $senha) {
        Validator::validate($login == null || $senha == null, "Usuário ou senha inválidos.");
        Validator::onErrorRedirectTo("/sisgebones/index.php");
    }
    
    public function encontrarPorLoginESenha($login, $senha) {
        $this->validateToLogon($login, $senha);
        $senhaCript = sha1(trim($senha));
        $resultado = $this->persistencia->encontrarporLoginESenha(trim($login), $senhaCript);
        $uniqueValue = NULL;
        if (sizeof($resultado) == 1) {           
            $uniqueValue = $resultado[0];
        }
        Validator::validate($uniqueValue == null, "Usuário não cadastrado no sistema");
        Validator::onErrorRedirectTo("/sisgebones/index.php");
        return $uniqueValue;
    }
    
    public function atualizarPerfilUsuario($entidade, $confirmarSenha) {
        if ($entidade->getSenha() == null && $confirmarSenha == null) {
            $bdEntity = parent::encontrarPorId($entidade);
            $entidade->setSenha($bdEntity->getSenha());
            $confirmarSenha = $bdEntity->getSenha();
            $this->validatePerfilUsuario($entidade, $confirmarSenha);
        } else {
            $this->validatePerfilUsuario($entidade, $confirmarSenha);
            $senha = $entidade->getSenha();
            $senha = sha1($senha);
            $entidade->setSenha($senha);
        }
        $this->persistencia->atualizar($entidade);
    }
    
    public function validatePerfilUsuario($entidade, $confirmarSenha) {
        $this->validationMessage($entidade, $confirmarSenha);
        Validator::onErrorRedirectTo("../../pages/home/perfil.php");
    }
    
    public function atualizarUsuario($entidade, $confirmarSenha, $idUsuario) {
        //lembrar de inserir código para escapagem para evitar sql injection
        if ($entidade->getSenha() == null && $confirmarSenha == null) {
            $bdEntity = $this->persistencia->encontrarPorId($entidade);
            $entidade->setSenha($bdEntity->getSenha());
            $confirmarSenha = $bdEntity->getSenha();
            $this->validateUsuarioAtualizar($entidade, $confirmarSenha, $idUsuario);
        } else {
            $this->validateUsuarioAtualizar($entidade, $confirmarSenha, $idUsuario);
            $senha = $entidade->getSenha();
            $senha = sha1($senha);
            $entidade->setSenha($senha);
        }
        $this->persistencia->atualizar($entidade);
    }
    
    public function salvarUsuario($entidade, $confirmarSenha) {
        $this->validateUsuario($entidade, $confirmarSenha);
        $senha = sha1($entidade->getSenha());
        $entidade->setSenha($senha);
        return $this->persistencia->salvar($entidade);
    }
    
    public function validateUsuario($entidade, $confirmarSenha) {
        $this->validationMessage($entidade, $confirmarSenha);
        if (PermissionValidator::isAdministrador()) {
            Validator::onErrorRedirectTo("../../pages/administrador/administrador-cadastrar.php");
        } else if (PermissionValidator::isAluno()) {
            Validator::onErrorRedirectTo("../../pages/aluno/aluno-cadastrar-novo.php");
        } else if (PermissionValidator::isProfessor()) {
            Validator::onErrorRedirectTo("../../pages/professor/professor-cadastrar.php");
        }
    }
    
    public function validateUsuarioAtualizar($entidade, $confirmarSenha, $idUsuario) {
        $this->validationMessage($entidade, $confirmarSenha);
        if (PermissionValidator::isAdministrador()) {
            Validator::onErrorRedirectTo("../../pages/administrador/administrador-editar.php?id={$idUsuario}");
        } else if (PermissionValidator::isAluno()) {
            Validator::onErrorRedirectTo("../../pages/aluno/aluno-editar.php?id={$idUsuario}");
        } else if (PermissionValidator::isProfessor()) {
            Validator::onErrorRedirectTo("../../pages/professor/professor-editar.php?id={$idUsuario}");
        }
    }
    
    public function validationMessage($entidade, $confirmarSenha) {
        Validator::validate($entidade == null, "Preencha todos os campos");
        Validator::validate($entidade->getLogin() == null, "O campo login deve ser preenchido");
        Validator::validate($entidade->getSenha() != $confirmarSenha, "Os campos 'senha' e 'confirmar senha' devem ser preenchidos");
        Validator::validate($entidade->getSenha() == null, "O campo senha deve ser preenchido");
    }
}

?>
