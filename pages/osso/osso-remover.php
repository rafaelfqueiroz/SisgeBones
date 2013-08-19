<?php
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/OssoDao.php';
    include_once '../../application/model/Osso.php';
    include_once '../../application/controller/ControllerOsso.php';
    include_once '../../application/persistence/implementacoes/PersistenceOsso.php';
    
    session_start();
    
    if (empty($_SESSION["sUsuario"])):
        header("location: ../../index.php");
        exit();
    else :
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
         if (PermissionValidator::isAdministrador()) :
            if (isset($_GET["id"])) {
                $osso = new Osso();
                $osso->setId($_GET["id"]);
                $ossoController = new ControllerOsso();
                $ossoController->remover($osso);
            }
            header("location: osso-listar.php");
        else:
            header("location: professor-listar.php");
            exit();
        endif;
        
    endif;
?>
