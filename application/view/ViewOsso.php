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
        $view .= "<input type=\"hidden\" name=\"source\" value=\"cadastrar\" >";
        $view .= "<input type=\"submit\" value=\"Cadastrar\" class=\"btn btn-success\" >";       
        echo $view;
    }

    public function printListAsTable() {
        $view = "";
        echo $view;
    }
}
?>
