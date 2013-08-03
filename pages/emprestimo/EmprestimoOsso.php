<?php
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';

    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/OssoDao.php';
    
    include_once '../../application/model/Osso.php';
    include_once '../../application/controller/ControllerOsso.php';    
    include_once '../../application/persistence/implementacoes/PersistenceOsso.php';
    include_once '../../application/view/ViewOsso.php';

    $ossoController = new ControllerOsso();
    $list = $ossoController->listar();
    if (isset($_SESSION["bandeja"])) {
        $hash = array();
        for ($i = 0; $i < sizeof($list);$i++) {
            $hash[$list[$i]->getId()] = $i;            
        }
        $tray = unserialize($_SESSION["bandeja"]);
        foreach ($tray as $item) {
            $qtdValue = $list[$hash[$item->getId()]]->getQtdDisponivel();
            $list[$hash[$item->getId()]]->setQtdDisponivel($qtdValue - $item->getQuantidade());
        }
    }
    echo json_encode($list);
?>
