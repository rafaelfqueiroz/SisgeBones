<?php

class ViewAdministrador extends AbstractView{
    protected $administradorController;
    protected $list;
    
    public function __construct() {
        $this->administradorController = new ControllerAdministrador();
    }
    
    public function printForm() {
        $view = "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputNome\">Nome</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\"id=\"inputNome\"placeholder=\"Nome do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputMatricula\">Matrícula</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\"id=\"inputMatricula\"placeholder=\"Matrícula do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";        
            $view .= "<label class=\"control-label\"for=\"inputEmail\">Email</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"email\"id=\"inputEmail\"placeholder=\"Email do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputLogin\">Login</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"email\"id=\"inputLogin\"placeholder=\"Login do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputSenha\">Senha</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"password\"id=\"inputSenha\"placeholder=\"Senha do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<button type=\"submit\"class=\"btn btn-success\">Cadastrar</button>";
        echo $view;
    }
    
    public function printListAsTable() {
        $view = "";
        echo $view;
    }
    
    public function printListModeradorAsTable() {
        $view = "";
        echo $view;
    }
}
?>