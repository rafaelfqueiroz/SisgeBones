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
                    $view .= "<input type=\"email\" id=\"inputLogin\" name=\"login\" placeholder=\"Login do aluno\" required>";
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
            $view .= "<button type=\"submit\" class=\"btn btn-success\">Cadastrar</button>";
            echo $view;
        }
        
        public function printListAsTable() {
            $view = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"table table-striped table-bordered dataTable\" id=\"example\" aria-describedby=\"example_info\">";
                $view .= "<thead>";
                    $view .= "<tr role=\"row\">";
                        $view .= "<th class=\"sorting_asc\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-sort=\"ascending\" aria-label=\"Rendering engine: activate to sort column descending\" style=\"width: 167px;\">Rendering engine</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Browser: activate to sort column ascending\" style=\"width: 232px;\">Browser</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Platform(s): activate to sort column ascending\" style=\"width: 214px;\">Platform(s)</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"Engine version: activate to sort column ascending\" style=\"width: 142px;\">Engine version</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">CSS grade</th>";
                        $view .= "<th class=\"sorting\" role=\"columnheader\" tabindex=\"0\" aria-controls=\"example\" rowspan=\"1\" colspan=\"1\" aria-label=\"CSS grade: activate to sort column ascending\" style=\"width: 99px;\">CSS grade</th>";
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
                            $view .= "<td class=\"sorting_1\">{$aluno->nome}</td>";
                            $view .= "<td>{$aluno->matricula}</td>";
                            $view .= "<td>{$aluno->curso}</td>";
                            $view .= "<td>{$aluno->email}</td>";
                            $view .= "<td>{$aluno->eMonitor}</td>";
                            $view .= "<td>{$aluno->login}</td>";                            
                        $view .= "</tr>";
                    }
                }
                $view .= "</tbody";
            $view .= "</table>";
            echo $view;
        }
        
        public function printTableMonitor() {
            $view = "";
            echo $view;
        }
    }
?>