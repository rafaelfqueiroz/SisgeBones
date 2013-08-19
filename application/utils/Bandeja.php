<?php 
    session_start();
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Osso.php';
    $tray = NULL;
    
    if ($_POST["action"] == "adicionar") {        
        if (isset($_SESSION["sBandeja"])) {
            $tray = ($_SESSION["sBandeja"]);            
        } else {
            $tray = array();
            $_SESSION["sContador"] = array();
        }
        
        $item = json_decode($_POST["item"]);
        $osso = new Osso();
        $osso->setId($item->id);
        $osso->setNome($item->nome);
        $osso->setCodigo($item->codigo);
        $osso->setQuantidade($item->quantidade);
        $osso->setQtdDisponivel($item->qtdDisponivel);    

//        $qtdEmprestimo = $_POST["qtdOsso"];
//        $osso->setQuantidade($qtdEmprestimo);
//        if (isset($tray[$osso->getId()])) {
//            $soma = $tray[$osso->getId()]->getQuantidade() + $osso->getQuantidade();
//            $tray[$osso->getId()]->setQuantidade($soma);
//        } else {
            $tray[$osso->getId()] = $osso;
            if (isset($_SESSION["sContador"][$osso->getId()])) {
                $_SESSION["sContador"][$osso->getId()] += $_POST["qtdOsso"];
            } else {
                $_SESSION["sContador"][$osso->getId()] = $_POST["qtdOsso"];
            }
//        }
    } else if ($_POST["action"] == "remover") {
        $tray = ($_SESSION["sBandeja"]);
        $idOsso = json_decode($_POST["item"]);
        unset($tray[$idOsso]);
        unset($_SESSION["sContador"][$idOsso]);
    }
    $_SESSION["sBandeja"] = ($tray);
    $textTray = "";
    $total = 0;
    foreach ($tray as $itemTray) {
        $qtdEmprestimo = $_SESSION["sContador"][$itemTray->getId()];
        $textTray .= "<tr><td>{$itemTray->getNome()}</td><td>{$itemTray->getCodigo()}</td>
        <td>{$qtdEmprestimo}</td><td><a href=\"#\" onClick=\"removerDaBandeja({$itemTray->getId()}, {$qtdEmprestimo})\">Retirar</a></td></tr>";
        $total += $qtdEmprestimo;
    }
    $textTray .= "<tr><td></td><td></td><td></td><td id=\"totalQtdCell\"><b>Total:  {$total}</b></td></tr>";    
    echo $textTray;
?>
