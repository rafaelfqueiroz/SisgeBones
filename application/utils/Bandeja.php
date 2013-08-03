<?php 
    session_start();
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Osso.php';
    $tray = NULL;
    
    if ($_POST["action"] == "adicionar") {        
        if (isset($_SESSION["bandeja"])) {
            $tray = unserialize($_SESSION["bandeja"]);
        } else {
            $tray = array();
        }
        
        $item = json_decode($_POST["item"]);
        $osso = new Osso();
        $osso->setId($item->id);
        $osso->setNome($item->nome);
        $osso->setCodigo($item->codigo);
        $osso->setQuantidade($item->quantidade);
        $osso->setQtdDisponivel($item->qtdDisponivel);    

        $qtdEmprestimo = $_POST["qtdOsso"];
        $osso->setQuantidade($qtdEmprestimo);
        if (array_key_exists($osso->getId(), $tray)) {
            $soma = $tray[$osso->getId()]->getQuantidade() + $osso->getQuantidade();
            $tray[$osso->getId()]->setQuantidade($soma);
        } else {
            $tray[$osso->getId()] = $osso;
        }
    } else if ($_POST["action"] == "remover") {
        $tray = unserialize($_SESSION["bandeja"]);
        $idOsso = json_decode($_POST["item"]);
        unset($tray[$idOsso]);
    }
    $_SESSION["bandeja"] = serialize($tray);
    $textTray = "";
    $total = 0;
    foreach ($tray as $itemTray) {
        $textTray .= "<tr><td>{$itemTray->getNome()}</td><td>{$itemTray->getCodigo()}</td>
        <td>{$itemTray->getQuantidade()}</td><td><a href=\"#\" onClick=\"removerDaBandeja({$itemTray->getId()}, {$itemTray->getQuantidade()})\">Retirar</a></td></tr>";
        $total += $itemTray->getQuantidade();
    }
    $textTray .= "<tr><td></td><td></td><td></td><td id=\"totalQtdCell\"><b>Total:  {$total}</b></td></tr>";    
    echo $textTray;
?>
