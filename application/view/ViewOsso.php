<?php

class ViewOsso extends AbstractView {
    
    protected $ossoController;
    protected $list;
    
    public function __construct() {
        $this->ossoController = new ControllerOsso();        
    }
    public function printForm() {
        $view = "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputNome\">Nome</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do osso\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputCodigo\">Código</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\" id=\"inputCodigo\" name=\"codigo\" placeholder=\"Código do osso\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputQuantidade\">Quantidade</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"number\" id=\"inputQuantidade\" name=\"quantidade\" placeholder=\"Quantidade do osso\" min=\"0\" max=\"50\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<input type=\"hidden\" name=\"osso-novo\" value=\"cadastrar\" >";
        $view .= "<input type=\"submit\" value=\"Cadastrar\" class=\"btn btn-success\" >";       
        echo $view;
    }
    
    public function printFormOsso() {
        $ossoController = new ControllerOsso();
        $ossos = $ossoController->listar();
        $view = "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"selectCodigo\">Código</label>";
                $view .= "<div class=\"controls\">";
                        $view .= "<select id=\"selectOsso\" class=\"select2\" name=\"codigo\" data-placeholder=\"Escolha um osso\" style=\"width:400px;\">";
                            $view .= "<option></option>";
                            foreach ($ossos as $osso) {
                                $view .= "<option value=\"{$osso->getId()}\">{$osso->getCodigo()}</option>";
                            }
                        $view .= "</select>";
                    $view .= "</div>";
            $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"quantidadeOsso\">Quantidade</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input id=\"quantidadeOsso\" type=\"number\" name=\"quantidade\" min=\"1\" max=\"10\" placeholder=\"Quantidade de ossos\">";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<input type=\"hidden\" name=\"osso-existente\" value=\"inserir\">";
        $view .= "<input type=\"submit\" value=\"Adicionar\" class=\"btn btn-success\">";                                       
        
        echo $view;
    }
    
    public function printEditForm($id) {        
        $osso = new Osso();
        $osso->setId($id);
        $osso = $this->ossoController->encontrarPorId($osso);
        $view = "<input type=\"hidden\" id=\"inputId\" name=\"id\" value=\"{$osso->getId()}\" required>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputNome\">Nome</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do osso\" value=\"{$osso->getNome()}\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputCodigo\">Código</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\" id=\"inputCodigo\" name=\"codigo\" placeholder=\"Código do osso\" value=\"{$osso->getCodigo()}\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputQuantidade\">Quantidade</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"number\" id=\"inputQuantidade\" name=\"quantidade\" placeholder=\"Quantidade do osso\" min=\"0\" max=\"50\" value=\"{$osso->getQuantidade()}\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<input type=\"hidden\" name=\"osso-novo\" value=\"editar\" >";
        $view .= "<input type=\"submit\" value=\"Atualizar\" class=\"btn btn-success\" >";       
        echo $view;
    }
    
    public function printListAsTable() {
        $this->list = $this->ossoController->listar();
        $view = "";
        if ($this->list != null) {
            $view .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                    $view .= "<thead>";
                        $view .= "<tr role=\"row\">";
                            $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Código</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\">Quantidade</th>";
                            if (PermissionValidator::isAdministrador()) {
                                $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\"></th>";
                                $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\"></th>";
                            }
                        $view .= "</tr>";
                    $view .= "</thead>";
                    $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                    if (gettype($this->list) == "array") {
                    $i = true;
                        foreach ($this->list as $osso) {
                            if ($i) {
                                $view .= "<tr class =\"gradeA odd\">";
                                $i = false;
                            } else {
                                $view .= "<tr class =\"gradeA even\">";
                                $i = true;
                            }
                                $view .= "<td class=\"sorting_1\">{$osso->getNome()}</td>";
                                $view .= "<td>{$osso->getCodigo()}</td>";
                                $view .= "<td>{$osso->getQuantidade()}</td>";
                                if (PermissionValidator::isAdministrador()) {
                                    $view .= "<td><a href=\"osso-editar.php?id={$osso->getId()}\">Editar</a></td>";
                                    $view .= "<td><a href=\"osso-remover.php?id={$osso->getId()}\">Remover</a></td>";
                                }
                            $view .= "</tr>";
                        } 
                    }
                    $view .= "</tbody>";
                $view .= "</table>";
        } else {
            $view .= "<h5>Não há ossos cadastrados</h5>";
        }
        echo $view;
    }
}
?>
