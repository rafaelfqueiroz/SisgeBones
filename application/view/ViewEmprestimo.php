<?php
    
    class ViewEmprestimo extends AbstractView {
        
        protected $emprestimoController;
        protected $list;
        
        public function __construct() {
            $this->emprestimoController = new ControllerEmprestimo();
        }
        public function printForm() {
            $admin = ($_SESSION["sUsuario"]);
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
                $view .= "<select id=\"selectUsuario\" class=\"select2\" name=\"nome\"  style=\"width:400px;\">";
                        $view .= "<option></option>";
                        foreach ($alunos as $aluno) {
                            $view .= "<option value=\"{$aluno->getId()}\">{$aluno->getNome()}</option>";
                        }
                $view .= "</select>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"selectCodigo\">Código</label>";
                $view .= "<div class=\"controls\">";
                        $view .= "<select id=\"selectOsso\" class=\"select2\" name=\"osso\" data-placeholder=\"Escolha um osso\" style=\"width:400px;\">";
                            $view .= "<option></option>";
                            foreach ($ossos as $osso) {
                                $view .= "<option value=\"{$osso->getId()}\">{$osso->getCodigo()}</option>";
                            }
                        $view .= "</select>";
                    $view .= "</div>";
            $view .= "</div>";
            $view .= "<div id=\"divOssos\" class=\"control-group\"></div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputAdministrador\">Administrador</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\" id=\"inputAdministrador\" name=\"nomeAdmin\" value=\"{$admin->getNome()}\" placeholder=\"Nome do administrador\" disabled>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputQuantidade\">Total de ossos</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputQuantidade\" name=\"quantidadeTotal\" value=\"\" placeholder=\"Total de ossos\" disabled >";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<input id=\"inputTipo\" type=\"hidden\" name=\"tipo\" value=\"3\">";
                    $view .= "<br/><br/><input type=\"hidden\" name=\"source\" value=\"registrar\" >";
                    $view .= "<input id=\"registrarEmprestimoBtn\" type=\"submit\" value=\"Registrar\" onClick=\"enableInput()\" class=\"btn btn-success\" >";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<br/><br/><div id=\"divTableTray\">";
            if (isset($_SESSION["sBandeja"])) {
                $tray = ($_SESSION["sBandeja"]);
                $view .= "<table id=\"tableTray\" class=\"table table-striped table-bordered dataTable\">";
                    $view .= "<thead>";
                        $view .= "<tr role=\"row\">";
                            $view .= "<th class=\"sorting_asc\" role=\"columnheader\">Nome</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\">Código</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\">Quantidade</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\"></th>";
                        $view .= "</tr>";
                    $view .= "</thead>";
                    $view .= "<tbody>";
                        $total = 0;
                        foreach ($tray as $itemTray) {
                            $view .= "<tr><td>{$itemTray->getNome()}</td><td>{$itemTray->getCodigo()}</td>
                            <td>{$itemTray->getQuantidade()}</td><td><a href=\"#\" onClick=\"removerDaBandeja({$itemTray->getId()})\">Retirar</a></td></tr>";
                            $total += $itemTray->getQuantidade();
                        }
                        $view .= "<tr><td></td><td></td><td></td><td id=\"totalQtdCell\"><b>Total:  {$total}</b></td></tr>";   
                    $view .= "</tbody>";
                $view .= "</table>";
            }
            $view .= "</div>";
            echo $view;
        }
        
        public function printEmprestimoDetalhes($id) {
            $emprestimo = new Emprestimo();
            $emprestimo->setId($id);
            $ossoEmprestimo = $this->emprestimoController->listarOssosDeEmprestimo($emprestimo);
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
            $view = "<h5 class=\"title\">Informações de empréstimo</h6>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelDataEmprestimo\">Data Emprestimo: </label>";
                    $view .= "<label id=\"labelDataEmprestimo\" class=\"control-label answer\">{$emprestimo->getDataEmprestimo()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelDataDevolucao\">Data Devolução: </label>";
                    $view .= "<label id=\"labelDataDevolucao\" class=\"control-label answer\">{$dataDevolucao}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelStatus\">Status: </label>";
                    $view .= "<label id=\"labelStatus\" class=\"control-label answer\">{$status}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelQuantidade\">Quantidade: </label>";
                    $view .= "<label id=\"labelQuantidade\" class=\"control-label answer\">{$emprestimo->getQuantidade()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<h5 class=\"title\">Informações dos ossos emprestados</h6>";
            foreach($ossoEmprestimo as $osso) {
                $view .= "<div class=\"control-group\">";
                    $view .= "<div class=\"controls\">";
                        $view .= "<label class=\"control-label description\">{$osso->getNome()}: </label>";
                        $view .= "<label id=\"labelStatus\" class=\"control-label answer\">{$osso->getQtdEmprestada()} osso(s).</label>";
                    $view .= "</div>";
                $view .= "</div>";
            }
            
            $view .= "<h5 class=\"title\">Informações de administrador</h6>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelNomeAdmin\">Nome: </label>";
                    $view .= "<label id=\"labelNomeAdmin\" class=\"control-label answer\">{$emprestimo->getAdministrador()->getNome()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelEmailAdmin\">Email: </label>";
                    $view .= "<label id=\"labelEmailAdmin\" class=\"control-label answer\">{$emprestimo->getAdministrador()->getEmail()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelTipoAdmin\">Tipo: </label>";
                    $view .= "<label id=\"labelTipoAdmin\" class=\"control-label answer\">{$moderador}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<h5 class=\"title\">Informações de emprestante</h6>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelNomeUsuario\">Nome: </label>";
                    $view .= "<label id=\"labelNomeUsuario\" class=\"control-label answer\">{$emprestimo->getUsuario()->getReferente()->getNome()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelMatriculaUsuario\">Matricula: </label>";
                    $view .= "<label id=\"labelMatriculaUsuario\" class=\"control-label answer\">{$emprestimo->getUsuario()->getReferente()->getMatricula()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelEmailUsuario\">Email: </label>";
                    $view .= "<label id=\"labelEmailUsuario\" class=\"control-label answer\">{$emprestimo->getUsuario()->getReferente()->getEmail()}</label>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"control-label description\" for=\"labelTipoUsuario\">Tipo: </label>";
                    $view .= "<label id=\"labelTipoUsuario\" class=\"control-label answer\">{$tipo}</label>";
                $view .= "</div>";
            $view .= "</div>";
            if (PermissionValidator::isAdministrador() && $emprestimo->getStatus() == 1) {
                $view .= "<input type=\"hidden\" name=\"idEmprestimo\" value=\"{$emprestimo->getId()}\" >";
                $view .= "<input type=\"hidden\" name=\"source\" value=\"finalizar\" >";
                $view .= "<input type=\"submit\" value=\"Finalizar Emprestimo\" class=\"btn btn-large btn-success\" >";
            }
            echo $view;
        }
        
        public function printListAsTable() {
            $this->list = $this->emprestimoController->listar();
            $view = "";
            if ($this->list != null) {
                $view .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
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
                    $view .= "</tbody>";
                $view .= "</table>";
            } else {
                $view .= "<h5>Não há empréstimos registrados</h5>";
            }
            echo $view;
        }
        
        public function printListaPendentes() {
            $this->list = $this->emprestimoController->listarPendentes();
            $view = "";
            if ($this->list != null) {
                $view .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
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
                    $view .= "</tbody>";
                $view .= "</table>";
            } else {
                $view .= "<h5>Não há empréstimos pendentes registrados</h5>";
            }
            echo $view;
        }
        
        public function printListaEmprestimosUsuario() {
            $this->list = $this->emprestimoController->listarEmprestimosUsuario();
            $view = "";
            if ($this->list != null) {
                $view .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                    $view .= "<thead>";
                        $view .= "<tr role=\"row\">";
                            $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 160px;\">Data Empréstimo</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 160px;\">Data Devolução</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 80px;\">Status</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 80px;\">Quantidade</th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 220px;\">Administrador</th>";
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
                            $view .= "<tr data-href=\"emprestimo-detalhes.php?id={$emprestimo->getId()}\" class=\"gradeA {$color}\">";     
                                $view .= "<td class=\"sorting_1\">{$emprestimo->getDataEmprestimo()}</td>";
                                $view .= "<td>{$emprestimo->getDataDevolucao()}</td>";
                                $view .= "<td>{$status}</td>";
                                $view .= "<td>{$emprestimo->getQuantidade()}</td>";
                                $view .= "<td>{$emprestimo->getAdministrador()->getNome()}</td>";
                            $view .= "</tr>";
                        }
                    }
                    $view .= "</tbody>";
                $view .= "</table>";
            } else {
                $view .= "<h5>Não há empréstimos realizados por você</h5>";
            }
            echo $view;
        }
    }

?>
