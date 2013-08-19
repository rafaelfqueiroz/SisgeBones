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
            $view .= "<label class=\"control-label\"for=\"inputSenhaConfirmacao\">Senha de Confirmação</label>";
            $view .= "<div class=\"controls\">";
                $view .= "<input type=\"password\"id=\"inputSenhaConfirmacao\" name=\"confirmarSenha\" placeholder=\"Senha de confirmação do administrador\" required>";
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
    
    public function printEditForm($id) {
            $administrador = new Administrador();
            $administrador->setId($id);
            $administradorController = new ControllerAdministrador();
            $administrador = $administradorController->encontrarPorId($administrador);            
            $view = "<input type=\"hidden\" id=\"inputId\" name=\"id\" value=\"{$administrador->getId()}\">";
            $view .= "<input type=\"hidden\" id=\"inputIdUsuario\" name=\"idUsuario\" value=\"{$administrador->getUsuario()->getId()}\">";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\"for=\"inputNome\">Nome</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\"id=\"inputNome\" name=\"nome\" placeholder=\"Nome do administrador\" value=\"{$administrador->getNome()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\"for=\"inputMatricula\">Matrícula</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\"id=\"inputMatricula\" name=\"matricula\" placeholder=\"Matrícula do administrador\" value=\"{$administrador->getMatricula()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";        
                $view .= "<label class=\"control-label\"for=\"inputEmail\">Email</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\"id=\"inputEmail\" name=\"email\"placeholder=\"Email do administrador\" value=\"{$administrador->getEmail()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\"for=\"inputLogin\">Login</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\"id=\"inputLogin\" name=\"login\" placeholder=\"Login do administrador\" value=\"{$administrador->getUsuario()->getLogin()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group passwordComponent\" style=\"display:none;\">";
                $view .= "<label class=\"control-label\"for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\"id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do administrador\">";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group passwordComponent\" style=\"display:none;\">";
                $view .= "<label class=\"control-label\"for=\"inputSenhaConfirmacao\">Senha de Confirmação</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\"id=\"inputSenhaConfirmacao\" name=\"confirmarSenha\" placeholder=\"Senha de confirmação do administrador\">";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group alterPassword\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<a href=\"#\" onClick=\"showPasswordElements()\">Alterar senha</a>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group cancelAlterPassword\" style=\"display:none;\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<a href=\"#\" onClick=\"hidePasswordElements()\">Cancelar alteração senha</a>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"checkbox\">";
                        if ($administrador->getModerador() == 1) {
                            $view .= "<input type=\"checkbox\" checked=\"checked\" name=\"moderador\">Cadastrar como moderador";
                        } else {
                            $view .= "<input type=\"checkbox\" name=\"moderador\">Cadastrar como moderador";
                        }                        
                    $view .= "</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<input type=\"hidden\" name=\"source\" value=\"editar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Atualizar\" >";
            echo $view;
        }
    
    public function printListAsTable() {
        $admin = ($_SESSION["sUsuario"]);
        $this->list = $this->administradorController->listarComoUsuario();
        $view = "";
        if ($this->list != null) {
            $view .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                    $view .= "<thead>";
                        $view .= "<tr role=\"row\">";
                            $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Matrícula</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 142px;\">Email</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">Moderador</th>";
                            if (PermissionValidator::isAdministrador() && $admin->getModerador() == 0) {
                                $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                                $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                            }
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
                                if ($administrador->getModerador() == 1) {
                                    $view .= "<td>Sim</td>";
                                } else if ($administrador->getModerador() == 0) {
                                    $view .= "<td>Não</td>";
                                }
                                if (PermissionValidator::isAdministrador() && $admin->getModerador() == 0) {
                                    $view .= "<td><a href=\"administrador-editar.php?id={$administrador->getId()}\">Editar</a></td>";  
                                    $view .= "<td><a href=\"administrador-remover.php?id={$administrador->getId()}\">Remover</a></td>";
                                }
                            $view .= "</tr>";
                        }
                    }
                    $view .= "</tbody>";
                $view .= "</table>";
            } else {
                $view .= "<h5>Não há administradores cadastrados</h5>";
            }
            echo $view;
    }
    
    
    
    public function printListModeradorAsTable() {
        $view = "";
        echo $view;
    }
}
?>