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
                    $view .= "<input type=\"email\" id=\"inputLogin\" name=\"login\" placeholder=\"Login do professor\" required>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group\">";
                $view .= "<label class=\"control-label\" for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do professor\" required>";
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