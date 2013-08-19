<?php
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/ProfessorDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/controller/ControllerProfessor.php';    
    include_once '../../application/persistence/implementacoes/PersistenceProfessor.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    
    session_start();
    
    if (empty($_SESSION["sUsuario"])) {
        header("location: ../../index.php");
        exit();
    } else {
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
        if (PermissionValidator::isAdministrador()) {
                if (isset($_GET["id"])) {
                    $professor = new Professor();
                    $professor->setId($_GET["id"]);                    
                    $professorController = new ControllerProfessor();
                    $professor = $professorController->encontrarPorId($professor);
                    
                    $usuarioController = new ControllerUsuario();
                    $usuario = $professor->getUsuario();
                    $usuarioController->remover($usuario);
                }
        }
        header("location: professor-listar.php");
        exit();
    }
?>
