<?php
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/AlunoDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/controller/ControllerAluno.php';    
    include_once '../../application/persistence/implementacoes/PersistenceAluno.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])) {
        header("location: ../login/index.php");
        exit();
    } else {
        if (PermissionValidator::isAdministrador()) {
            if (isset($_GET["id"])) {
                $aluno = new Aluno();
                $aluno->setId($_GET["id"]);
                $alunoController = new ControllerAluno();
                $aluno = $alunoController->encontrarPorId($aluno);
                $usuarioController = new ControllerUsuario();
                $usuario = $aluno->getUsuario();
                $usuarioController->remover($usuario);
            }
        }
        header("location: aluno-listar.php");
        exit();
    }
?>
