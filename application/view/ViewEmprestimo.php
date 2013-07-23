<?php

    class ViewEmprestimo extends AbstractView {
        
        protected $emprestimoController;
        protected $list;
        
        public function __construct() {
            $this->emprestimoController = new ControllerEmprestimo();
        }
        public function printForm() {
            $ossoController = new ControllerOsso();
            $ossos = $ossoController->listar();
            $view = "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputNome\">Nome emprestante</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do emprestante\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputNome\">Nome emprestante</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<select class=\"select2\" name=\"bones[]\" multiple=\"multiple\" style=\"width:400px;\">";
                            foreach ($ossos as $osso) {
                                $view .= "<option value=\"{$osso->getId()}\">{$osso->getCodigo()}</option>";
                            }
                            $view .= "</select>";
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
                    $view .= "<input type=\"number\" id=\"inputQuantidade\" min=\"1\" max=\"5\" name=\"quantidade\" placeholder=\"Quantidade de ossos\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputAdministrador\">Administrador</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\" id=\"inputQuantidade\" name=\"nomeAdmin\" placeholder=\"Nome do administrador\" disabled>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<button type=\"submit\" class=\"btn btn-success\">Cadastrar</button>"; 
            echo $view;
        }
        
        public function printListAsTable() {
            $view = "";
            echo $view;
        }
    }

?>
