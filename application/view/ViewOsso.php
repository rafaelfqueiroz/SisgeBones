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
        $view .= "<input type=\"submit\" value=\"cadastrar\" class=\"btn btn-success\" >";       
        echo $view;
    }
    
    public function printFormOsso() {
        $view = "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"codigoOsso\">Código</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input id=\"codigoOsso\" type=\"text\" name=\"codigoOsso\" placeholder=\"Código do osso existente\" required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"quantidadeOsso\">Quantidade</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input id=\"quantidadeOsso\" type=\"number\" name=\"quantidadeOsso\" min=\"1\" max=\"10\" placeholder=\"Quantidade de ossos\">";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<input type=\"hidden\" name=\"osso-existente\" value=\"inserir\">";
        $view .= "<input type=\"submit\" value=\"Adicionar\" class=\"btn btn-success\">";                                       
        
        echo $view;
    }
    public function printListAsTable() {
        $this->list = $this->ossoController->listar();        
        $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Código</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\">Quantidade</th>";                        
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
                        $view .= "</tr>";
                    } 
                }
                $view .= "</tbody";
            $view .= "</table>";
        echo $view;
    }
}
?>
