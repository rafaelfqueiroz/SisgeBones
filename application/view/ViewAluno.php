<?php 
    class ViewAluno extends AbstractView {
        protected $alunoController;
        protected $list;
        
        public function __construct() {
            $this->alunoController = new ControllerAluno();
        }
        
        public function printForm() {
            $view = "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputNome\">Nome</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputMatricula\">Matrícula</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputMatricula\" name=\"matricula\" placeholder=\"Matrícula do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputCurso\">Curso</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputCurso\" name=\"curso\" placeholder=\"Curso do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputEmail\">Email</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\" id=\"inputEmail\" name=\"email\" placeholder=\"Email do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputLogin\">Login</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputLogin\" name=\"login\" placeholder=\"Login do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"checkbox\">";
                        $view .= "<input type=\"checkbox\" name=\"eMonitor\"> Aluno como monitor";
                    $view .= "</label>";
                $view .= "</div>";
            $view .= "</div>";                        
            $view .= "<input type=\"hidden\" name=\"source\" value=\"cadastrar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Cadastrar\" >";
            echo $view;
        }
        
        public function printEditForm($id) {
            $aluno = new Aluno();
            $aluno->setId($id);
            $alunoController = new ControllerAluno();
            $aluno = $alunoController->encontrarPorId($aluno);
            $view = "<input type=\"hidden\" id=\"inputId\" name=\"id\" value=\"{$aluno->getId()}\">";
            $view .= "<input type=\"hidden\" id=\"inputIdUsuario\" name=\"idUsuario\" value=\"{$aluno->getUsuario()->getId()}\">";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputNome\">Nome</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputNome\" name=\"nome\" placeholder=\"Nome do aluno\" value=\"{$aluno->getNome()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputMatricula\">Matrícula</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputMatricula\" name=\"matricula\" placeholder=\"Matrícula do aluno\" value=\"{$aluno->getMatricula()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputCurso\">Curso</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputCurso\" name=\"curso\" placeholder=\"Curso do aluno\" value=\"{$aluno->getCurso()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputEmail\">Email</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"email\" id=\"inputEmail\" name=\"email\" placeholder=\"Email do aluno\" value=\"{$aluno->getEmail()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputLogin\">Login</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputLogin\" name=\"login\" placeholder=\"Login do aluno\" value=\"{$aluno->getUsuario()->getLogin()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do aluno\" value=\"{$aluno->getUsuario()->getSenha()}\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<label class=\"checkbox\">";
                    if ($aluno->getEMonitor() == 1) {
                        $view .= "<input type=\"checkbox\" checked=\"checked\" name=\"eMonitor\"> Aluno como monitor";
                    } else {
                        $view .= "<input type=\"checkbox\" name=\"eMonitor\"> Aluno como monitor";
                    }
                    $view .= "</label>";
                $view .= "</div>";
            $view .= "</div>";                        
            $view .= "<input type=\"hidden\" name=\"source\" value=\"editar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Atualizar\" >";
            echo $view;
        }
        
        public function printFormPlanilha() {
            $view = "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputCurso\">Curso</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"text\" id=\"inputCurso\" name=\"curso\" placeholder=\"Curso do aluno\" required>";
                $view .= "</div>";
            $view .= "</div>";
             $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputPlanilha\">Planilha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"file\" id=\"inputPlanilha\" name=\"planilha\" placeholder=\"Planilha dos alunos\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<input type=\"hidden\" name=\"source\" value=\"cadastrarPlanilha\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Cadastrar\" >";
            echo $view;
        }
        
        public function printListAsTable() {
            $this->list = $this->alunoController->listarComoUsuario();
            $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Matrícula</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\">Curso</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 142px;\">Email</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">Monitor</th>";
                        if (PermissionValidator::isAdministrador()) {
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                        }
                    $view .= "</tr>";
                $view .= "</thead>";
                $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                if (gettype($this->list) == "array") {
                    $i = true;
                    foreach ($this->list as $aluno) {
                        if ($i) {
                            $view .= "<tr class =\"gradeA odd\">";
                            $i = false;
                        } else {
                            $view .= "<tr class =\"gradeA even\">";
                            $i = true;
                        }
                            $view .= "<td class=\"sorting_1\">{$aluno->getNome()}</td>";
                            $view .= "<td>{$aluno->getMatricula()}</td>";
                            $view .= "<td>{$aluno->getCurso()}</td>";
                            $view .= "<td>{$aluno->getEmail()}</td>";
                            $view .= "<td>{$aluno->getEMonitor()}</td>";
                            if (PermissionValidator::isAdministrador()) {
                                $view .= "<td><a href=\"aluno-editar.php?id={$aluno->getId()}\">Editar</a></td>";
                                $view .= "<td><a href=\"aluno-remover.php?id={$aluno->getId()}\">Remover</a></td>";
                            }
                        $view .= "</tr>";
                    }
                }
                $view .= "</tbody";
            $view .= "</table>";
            echo $view;
        }
        
        public function printTableMonitor() {
            $this->list = $this->alunoController->listarMonitores();
            $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Nome</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Matrícula</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\">Curso</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 142px;\">Email</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">Monitor</th>";
                        if (PermissionValidator::isAdministrador()) {
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                            $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\"></th>";
                        }
                    $view .= "</tr>";
                $view .= "</thead>";
                $view .= "<tbody role=\"alert\" aria-live=\"polite\" aria-relevant=\"all\">";
                if (gettype($this->list) == "array") {
                    $i = true;
                    foreach ($this->list as $aluno) {
                        if ($i) {
                            $view .= "<tr class =\"gradeA odd\">";
                            $i = false;
                        } else {
                            $view .= "<tr class =\"gradeA even\">";
                            $i = true;
                        }
                            $view .= "<td class=\"sorting_1\">{$aluno->getNome()}</td>";
                            $view .= "<td>{$aluno->getMatricula()}</td>";
                            $view .= "<td>{$aluno->getCurso()}</td>";
                            $view .= "<td>{$aluno->getEmail()}</td>";
                            $view .= "<td>{$aluno->getEMonitor()}</td>";
                            if (PermissionValidator::isAdministrador()) {
                                $view .= "<td><a href=\"aluno-editar.php?id={$aluno->getId()}\">Editar</a></td>";
                                $view .= "<td><a href=\"aluno-remover.php?id={$aluno->getId()}\">Remover</a></td>";
                            }
                        $view .= "</tr>";
                    }
                }
                $view .= "</tbody";
            $view .= "</table>";
            echo $view;
        }
    }
?>