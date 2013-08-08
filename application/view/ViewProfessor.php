<?php
    class ViewProfessor extends AbstractView {
        
        protected $professorController;
        protected $list;
        
        public function __construct() {
            $this->professorController = new ControllerProfessor();
        }
        public function printForm() {
            $view = "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputNome\">Nome</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputMatricula\">Matrícula</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputMatricula\" name=\"matricula\" placeholder=\"Matrícula do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputMatricula\">RG</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputRG\" name=\"rg\" placeholder=\"RG do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputEmail\">Email</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\" id=\"inputEmail\" name=\"email\" placeholder=\"Email do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputLogin\">Login</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputLogin\" name=\"login\" placeholder=\"Login do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\"for=\"inputSenhaConfirmacao\">Senha de Confirmação</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\"id=\"inputSenhaConfirmacao\" name=\"confirmarSenha\" placeholder=\"Senha de confirmação do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<input type=\"hidden\" name=\"source\" value=\"cadastrar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Cadastrar\" >";
            echo $view;
        }
        public function printEditForm($id) {
            $professor = new Professor();
            $professor->setId($id);
            $professorController = new ControllerProfessor();
            $professor = $professorController->encontrarPorId($professor);
            $view = "<input type=\"hidden\" id=\"inputId\" name=\"id\" value=\"{$professor->getId()}\">";
            $view .= "<input type=\"hidden\" id=\"inputIdUsuario\" name=\"idUsuario\" value=\"{$professor->getUsuario()->getId()}\">";
            $view .= "<div class=\"control-group\">";
            $view .= "<label class=\"control-label\" for=\"inputNome\">Nome</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do professor\" value=\"{$professor->getNome()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputMatricula\">Matrícula</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputMatricula\" name=\"matricula\" placeholder=\"Matrícula do professor\" value=\"{$professor->getMatricula()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputMatricula\">RG</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputRG\" name=\"rg\" placeholder=\"RG do professor\" value=\"{$professor->getRg()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputEmail\">Email</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\" id=\"inputEmail\" name=\"email\" placeholder=\"Email do professor\" value=\"{$professor->getEmail()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputLogin\">Login</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputLogin\" name=\"login\" placeholder=\"Login do professor\" value=\"{$professor->getUsuario()->getLogin()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group passwordComponent\" style=\"display:none;\">";
                $view .= "<label class=\"control-label\" for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do professor\" >";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group passwordComponent\" style=\"display:none;\">";
                $view .= "<label class=\"control-label\"for=\"inputSenhaConfirmacao\">Senha de Confirmação</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\"id=\"inputSenhaConfirmacao\" name=\"confirmarSenha\" placeholder=\"Senha de confirmação do professor\">";
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
            $view .= "<input type=\"hidden\" name=\"source\" value=\"editar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Atualizar\" >";
            echo $view;
        }
        
        public function printListAsTable() {
            $this->list = $this->professorController->listarComoUsuario();
            $view = "";
            if ($this->list != null) {
                $view .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                    $view .= "<thead>";
                        $view .= "<tr role=\"row\">";
                            $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Matrícula</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\">Email</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 142px;\">RG</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">Login</th>";
                            if (PermissionValidator::isAdministrador()) {
                                $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                                $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                            }
                        $view .= "</tr>";
                    $view .= "</thead>";
                    $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                    if (gettype($this->list) == "array") {
                        $i = true;
                        foreach ($this->list as $professor) {
                            if ($i) {
                                $view .= "<tr class =\"gradeA odd\">";
                                $i = false;
                            } else {
                                $view .= "<tr class =\"gradeA even\">";
                                $i = true;
                            }
                                $view .= "<td class=\"sorting_1\">{$professor->getNome()}</td>";
                                $view .= "<td>{$professor->getMatricula()}</td>";
                                $view .= "<td>{$professor->getEmail()}</td>";
                                $view .= "<td>{$professor->getRg()}</td>";
                                $view .= "<td>{$professor->getUsuario()->getLogin()}</td>";
                                if (PermissionValidator::isAdministrador()) {
                                    $view .= "<td><a href=\"professor-editar.php?id={$professor->getId()}\">Editar</a></td>";
                                    $view .= "<td><a href=\"professor-remover.php?id={$professor->getId()}\">Remover</a></td>";
                                }
                            $view .= "</tr>";
                        }
                    }
                    $view .= "</tbody";
                $view .= "</table>";
            } else {
                $view .= "<h5>Não há professores cadastrados</h5>";
            }
            echo $view;
        }
    }
?>