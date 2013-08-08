<?php
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/AdministradorDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/controller/ControllerAdministrador.php';    
    include_once '../../application/persistence/implementacoes/PersistenceAdministrador.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])) {
        header("location: ../../index.php");
        exit();
    } else {
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
        if (PermissionValidator::isAdministrador()) {
                if (isset($_GET["id"])) {
                    $administrador = new Administrador();
                    $administrador->setId($_GET["id"]);
                    $administradorController = new ControllerAdministrador();
                    $administrador = $administradorController->encontrarPorId($administrador);
                    $usuarioController = new ControllerUsuario();
                    $usuario = $administrador->getUsuario();
                    $usuarioController->remover($usuario);
                }
        } else {
            header("location: administrador-listar.php");
            exit();
        }  
    }
?>
