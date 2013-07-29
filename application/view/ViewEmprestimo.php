<?php

    class ViewEmprestimo extends AbstractView {
        
        protected $emprestimoController;
        protected $list;
        
        public function __construct() {
            $this->emprestimoController = new ControllerEmprestimo();
        }
        public function printForm() {
            $admin = unserialize($_SESSION["usuario"]);
            $ossoController = new ControllerOsso();
            $ossos = $ossoController->listar();
            $alunoController = new ControllerAluno();
            $alunos = $alunoController->listarComoUsuario();    
            $view = "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<input id=\"radioAluno\" checked=\"checked\" type=\"radio\" class=\"radioEmprestimo\" name=\"tipoUsuario\" value=\"aluno\">";
                    $view .= "<label class=\"labelRadio\">Aluno</label>";
                    $view .= "<input id=\"radioProfessor\"type=\"radio\" class=\"radioEmprestimo\" name=\"tipoUsuario\" value=\"professor\">";
                    $view .= "<label class=\"labelRadio\">Professor</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputNome\">Nome emprestante</label>";
                $view .= "<div class=\"controls\">";
                $view .= "<select id=\"selectUsuario\" class=\"select2\" name=\"nome\" data-placeholder=\"Nome do emprestante\" style=\"width:400px;\">";                
                        foreach ($alunos as $aluno) {        
                            $view .= "<option value=\"{$aluno->getId()}\">{$aluno->getNome()}</option>";        
                        }
                $view .= "</select>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"selectCodigo\">Código</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<select id=\"selectCodigo\" class=\"select2\" name=\"bones[]\" data-placeholder=\"Insira códigos aqui\" multiple=\"multiple\" style=\"width:400px;\">";
                            foreach ($ossos as $osso) {
                                $view .= "<option value=\"{$osso->getId()}\">{$osso->getCodigo()}</option>";
                            }
                            $view .= "</select>";
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
                    $view .= "<input type=\"email\" id=\"inputQuantidade\" name=\"nomeAdmin\" value=\"{$admin->getNome()}\" placeholder=\"Nome do administrador\" disabled>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<input id=\"inputTipo\" type=\"hidden\" name=\"tipo\" value=\"3\">";
            $view .= "<input type=\"hidden\" name=\"source\" value=\"registrar\" >";
            $view .= "<input type=\"submit\" value=\"Registrar\" class=\"btn btn-success\" >";    
            echo $view;
        }
        
        public function printEmprestimoDetalhes($id) {
            $emprestimo = new Emprestimo();
            $emprestimo->setId($id);
            $emprestimo = $this->emprestimoController->encontrarPorId($emprestimo);
            $status = "";
            $dataDevolucao = "";
            if ($emprestimo->getStatus() == 1) {
                $status = "Pendente";
                $dataDevolucao = "O empréstimo ainda está pendente";
            } else {
                $status = "Devolvido";
                $dataDevolucao = $emprestimo->getDataDevolucao();
            }
            $moderador = "";
            if ($emprestimo->getAdministrador()->getModerador() == 1) {
                $moderador = "Administrador moderador do sistema";
            } else {
                $moderador = "Administrador geral do sistema";
            }
            $tipo = "";
            if ($emprestimo->getUsuario()->getTipo() == 2) {
                $tipo = "Professor";
            } else {
                $tipo = "Aluno";
            }
            $view = "<h6 class=\"title\">Informações de empréstimo</h6>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelDataEmprestimo\">Data Emprestimo: </label>";
                    $view .= "<label id=\"labelDataEmprestimo\" class=\"control-label\">{$emprestimo->getDataEmprestimo()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelDataDevolucao\">Data Devolução: </label>";
                    $view .= "<label id=\"labelDataDevolucao\" class=\"control-label\">{$dataDevolucao}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelStatus\">Status: </label>";
                    $view .= "<label id=\"labelStatus\" class=\"control-label\">{$status}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelQuantidade\">Quantidade: </label>";
                    $view .= "<label id=\"labelQuantidade\" class=\"control-label\">{$emprestimo->getQuantidade()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<h6 class=\"title\">Informações de administrador</h6>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelNomeAdmin\">Nome: </label>";
                    $view .= "<label id=\"labelNomeAdmin\" class=\"control-label\">{$emprestimo->getAdministrador()->getNome()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelEmailAdmin\">Email: </label>";
                    $view .= "<label id=\"labelEmailAdmin\" class=\"control-label\">{$emprestimo->getAdministrador()->getEmail()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelTipoAdmin\">Tipo: </label>";
                    $view .= "<label id=\"labelTipoAdmin\" class=\"control-label\">{$moderador}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<h6 class=\"title\">Informações de emprestante</h6>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelNomeUsuario\">Nome: </label>";
                    $view .= "<label id=\"labelNomeUsuario\" class=\"control-label\">{$emprestimo->getUsuario()->getReferente()->getNome()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelMatriculaUsuario\">Matricula: </label>";
                    $view .= "<label id=\"labelMatriculaUsuario\" class=\"control-label\">{$emprestimo->getUsuario()->getReferente()->getMatricula()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelEmailUsuario\">Email: </label>";
                    $view .= "<label id=\"labelEmailUsuario\" class=\"control-label\">{$emprestimo->getUsuario()->getReferente()->getEmail()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label\" for=\"labelTipoUsuario\">Tipo: </label>";
                    $view .= "<label id=\"labelTipoUsuario\" class=\"control-label\">{$tipo}</label>";
                $view .= "</div>";
            $view .= "</div>";
            if (PermissionValidator::isAdministrador() && $emprestimo->getStatus() == 1) {
                $view .= "<input type=\"hidden\" name=\"source\" value=\"registrar\" >";
                $view .= "<input type=\"submit\" value=\"Finalizar Emprestimo\" class=\"btn btn-large btn-success\" >";
            }
            echo $view;
        }
        
        public function printListAsTable() {
            $this->list = $this->emprestimoController->listar();            
            $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 160px;\">Data Empréstimo</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 160px;\">Data Devolução</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 80px;\">Status</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 80px;\">Quantidade</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 220px;\">Administrador</th>";                        
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 240px;\">Emprestante</th>";
                    $view .= "</tr>";
                $view .= "</thead>";
                $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                if (gettype($this->list) == "array") {
                    foreach ($this->list as $emprestimo) {
                        $status = "";
                        $color = "";
                        if ($emprestimo->getStatus() == '1') {
                            $status = "Pendente";
                            $color = "pendente";
                        }
                        else {
                            $status = "Devolvido";
                        }
                        $view .= "<tr  data-href=\"emprestimo-detalhes.php?id={$emprestimo->getId()}\" class=\"gradeA {$color}\">";     
                            $view .= "<td class=\"sorting_1\">{$emprestimo->getDataEmprestimo()}</td>";
                            $view .= "<td>{$emprestimo->getDataDevolucao()}</td>";
                            
                            $view .= "<td>{$status}</td>";
                            $view .= "<td>{$emprestimo->getQuantidade()}</td>";
                            $view .= "<td>{$emprestimo->getAdministrador()->getNome()}</td>";
                            $view .= "<td>{$emprestimo->getUsuario()->getReferente()->getNome()}</td>";
                        $view .= "</tr>";
                    }
                }
                $view .= "</tbody";
            $view .= "</table>";
            echo $view;
        }
        
        public function printListaPendentes() {
            $this->list = $this->emprestimoController->listarPendentes();            
            $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 130px;\">Data Empréstimo</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 90px;\">Quantidade</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 100px;\">Status</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 200px;\">Administrador</th>";                        
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 200px;\">Emprestante</th>";
                    $view .= "</tr>";
                $view .= "</thead>";
                
                $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                if (gettype($this->list) == "array") {
                    foreach ($this->list as $emprestimo) {
                        $view .= "<tr data-href=\"emprestimo-detalhes.php?id={$emprestimo->getId()}\" class=\"gradeA\">";
                            $view .= "<td class=\"sorting_1\">{$emprestimo->getDataEmprestimo()}</td>";
                            $view .= "<td>{$emprestimo->getQuantidade()}</td>";
                            $status = "Pendente";                            
                            $view .= "<td>{$status}</td>";
                            $view .= "<td>{$emprestimo->getAdministrador()->getNome()}</td>";
                            $view .= "<td>{$emprestimo->getUsuario()->getReferente()->getNome()}</td>";
                        $view .= "</tr>";
                    }
                }
                $view .= "</tbody";
            $view .= "</table>";
            echo $view;
        }
    }

?>
