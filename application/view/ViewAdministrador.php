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
                $view .= "<input type=\"text\"id=\"inputNome\" name=\"nome\" placeholder=\"Nome do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputMatricula\">Matrícula</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\"id=\"inputMatricula\" name=\"matricula\" placeholder=\"Matrícula do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";        
            $view .= "<label class=\"control-label\"for=\"inputEmail\">Email</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"email\"id=\"inputEmail\" name=\"email\"placeholder=\"Email do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputLogin\">Login</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"text\"id=\"inputLogin\" name=\"login\" placeholder=\"Login do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\"for=\"inputSenha\">Senha</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"password\"id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do administrador\"required>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<div class=\"control-group\">";
            $view .= "<div class=\"controls\">";
                $view .= "<label class=\"checkbox\">";
                    $view .= "<input type=\"checkbox\" name=\"moderador\">Cadastrar como moderador";
                $view .= "</label>";
            $view .= "</div>";
        $view .= "</div>";
        $view .= "<input type=\"hidden\" name=\"source\" value=\"cadastrar\">";
        $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Cadastrar\" >";
        echo $view;
    }
    
    public function printListAsTable() {
        $this->list = $this->administradorController->listarComoUsuario();
        $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Matrícula</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 142px;\">Email</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">Moderador</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">Login</th>";
                    $view .= "</tr>";
                $view .= "</thead>";
                $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                if (gettype($this->list) == "array") {
                    $i = true;
                    foreach ($this->list as $administrador) {
                        if ($i) {
                            $view .= "<tr class =\"gradeA odd\">";
                            $i = false;
                        } else {
                            $view .= "<tr class =\"gradeA even\">";
                            $i = true;
                        }
                            $view .= "<td class=\"sorting_1\">{$administrador->getNome()}</td>";
                            $view .= "<td>{$administrador->getMatricula()}</td>";                            
                            $view .= "<td>{$administrador->getEmail()}</td>";
                            $view .= "<td>{$administrador->getModerador()}</td>"; 
                            $view .= "<td>{$administrador->getUsuario()->getLogin()}</td>";                            
                        $view .= "</tr>";
                    }
                }
                $view .= "</tbody";
            $view .= "</table>";
            echo $view;
    }
    
    public function printListModeradorAsTable() {
        $view = "";
        echo $view;
    }
}
?>