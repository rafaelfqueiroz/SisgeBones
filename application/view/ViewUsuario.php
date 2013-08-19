<?php
    class ViewUsuario extends AbstractView {
        protected $usuarioController;
        protected $list;
        
        public function __construct() {
            $this->usuarioConttroller = new ControllerUsuario();
        }
        
        public function printForm() {
            $user = ($_SESSION["sUsuario"]);
            if (PermissionValidator::isAdministrador()) {
                $this->formProfileAdministrador($user);
            } else if (PermissionValidator::isAluno()) {
                $this->formProfileAluno($user);
            } else if (PermissionValidator::isProfessor()) {
                $this->formProfileProfessor($user);
            }
        }
        
        public function formProfileAdministrador($administrador) {
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
            $view .= "<input type=\"hidden\" name=\"source\" value=\"editar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Salvar\" >";
            echo $view;
        }
        
        public function formProfileAluno($aluno) {
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
            $view .= "<div class=\"control-group passwordComponent\" style=\"display:none;\">";
                $view .= "<label class=\"control-label\" for=\"inputSenha\">Senha</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do aluno\">";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group passwordComponent\" style=\"display:none;\">";
                $view .= "<label class=\"control-label\"for=\"inputSenhaConfirmacao\">Senha de Confirmação</label>";
                $view .= "<div class=\"controls\">";
                    $view .= "<input type=\"password\"id=\"inputSenhaConfirmacao\" name=\"confirmarSenha\" placeholder=\"Senha de confirmação do aluno\">";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group alterPassword\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<a href=\"#\" onClick=\"showPasswordElements()\">Alterar Senha</a>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group cancelAlterPassword\" style=\"display:none;\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<a href=\"#\" onClick=\"hidePasswordElements()\">Cancelar alteração senha</a>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<input type=\"hidden\" name=\"source\" value=\"editar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Salvar\" >";
            echo $view;
        }
        
        public function formProfileProfessor($professor) {
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
                    $view .= "<input type=\"password\" id=\"inputSenha\" name=\"senha\" placeholder=\"Senha do professor\">";
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
                    $view .= "<a href=\"#\" onClick=\"showPasswordElements()\">Alterar Senha</a>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<div class=\"control-group cancelAlterPassword\" style=\"display:none;\">";
                $view .= "<div class=\"controls\">";
                    $view .= "<a href=\"#\" onClick=\"hidePasswordElements()\">Cancelar alteração senha</a>";
                $view .= "</div>";
            $view .= "</div>";
            $view .= "<input type=\"hidden\" name=\"source\" value=\"editar\">";
            $view .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Salvar\" >";
            echo $view;
        }
        public function printListAsTable() {

        }
    }
?>
