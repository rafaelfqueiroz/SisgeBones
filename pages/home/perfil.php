<?php 
    include_once '../../application/config.php';

    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/view/AbstractView.php';
    
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/AdministradorDao.php';
    include_once '../../application/persistence/interfaces/ProfessorDao.php';
    include_once '../../application/persistence/interfaces/AlunoDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Usuario.php';
    
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/controller/ControllerProfessor.php';
    include_once '../../application/controller/ControllerAluno.php';
    include_once '../../application/controller/ControllerAdministrador.php';
    
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceAluno.php';
    include_once '../../application/persistence/implementacoes/PersistenceProfessor.php';
    include_once '../../application/persistence/implementacoes/PersistenceAdministrador.php';
    
    include_once '../../application/view/ViewUsuario.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/utils/DadosSessao.php';
    include_once '../../application/utils/CurrentDate.php';
    include_once '../../application/utils/Validator.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../../index.php");
    else :      
        include_once '../../application/view/header.view.php';
        $viewUsuario = new ViewUsuario();
        if (@$_POST["source"] == "editar") {
            $usuario = new Usuario();
            $usuario->setId(@$_POST['idUsuario']);
            $usuario->setLogin(@$_POST['login']);
            $usuario->setSenha(@$_POST['senha']);
            $usuarioController = new ControllerUsuario();
            if (PermissionValidator::isAdministrador()) { //administrador
                $usuario->setTipo(1);
                $usuarioController->atualizarPerfilUsuario($usuario, @$_POST["confirmarSenha"]);
                $adminController = new ControllerAdministrador();
                $administrador = new Administrador();
                $administrador->setId(@$_POST['id']);
                $administrador->setNome(@$_POST['nome']);
                $administrador->setMatricula(@$_POST['matricula']);  
                $administrador->setEmail(@$_POST['email']);
                $administrador->setUsuario($usuario);
                $flag = $adminController->atualizarPerfilAdministrador($administrador);
                if ($flag) {
                    $_SESSION["usuario"] = serialize($administrador);
                }
            } else if (PermissionValidator::isProfessor()) { //professor
                $usuario->setTipo(2);
                $usuarioController->atualizarPerfilUsuario($usuario, @$_POST["confirmarSenha"]);
                $professorController = new ControllerAdministrador();
                $professor = new Professor();
                $professor = new Professor();
                $professor->setId($_POST['id']);
                $professor->setNome($_POST['nome']);
                $professor->setMatricula($_POST['matricula']);
                $professor->setEmail($_POST['email']);
                $professor->setRg($_POST['rg']);
                $professor->setUsuario($usuario);
                $flag = $professorController->atualizarPerfilProfessor($professor);
                if ($flag) {
                    $_SESSION["usuario"] = serialize($professor);
                }
            } else if (PermissionValidator::isAluno()) { //aluno
                $usuario->setTipo(3);
                $usuarioController->atualizarPerfilUsuario($usuario, @$_POST["confirmarSenha"]);
                $alunoController = new ControllerAluno();
                $aluno = new Aluno();
                $aluno->setId(@$_POST['id']);
                $aluno->setNome(@$_POST['nome']);
                $aluno->setMatricula(@$_POST['matricula']);
                $aluno->setCurso(@$_POST['curso']);
                $aluno->setEmail(@$_POST['email']);
                $aluno->setAtivo(true);
                $aluno->setUsuario($usuario);
                $flag = $alunoController->atualizarPerfilAluno($aluno);
                if ($flag) {
                    $_SESSION["usuario"] = serialize($aluno);
                }
            }
        }
?>
<script>
    function showPasswordElements() {
        $(".passwordComponent").show();
        $(".cancelAlterPassword").show();
        $(".alterPassword").hide();
    }
    
    function hidePasswordElements() {
        $(".passwordComponent").hide();
        $(".cancelAlterPassword").hide();
        $(".alterPassword").show();
        $("#inputSenhaConfirmacao").val("");
        $("#inputSenha").val("");
    }
</script>
<header>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <a class="logo" href="#">Sisgebones</a>
                <?php if (!(PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0)) :  ?>
                    <ul class="breadcrumb visible-desktop">
                        <li class="home"><a href="home.php"></a><span class="divider"></span></li>
                    </ul>
                <?php endif; ?>
                <ul class="profileBar">
                    <li class="user "><img src="../../resource/img/user_avatar.png" alt=""></li>
                    <li class="profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="perfil.php"><?php echo DadosSessao::getDadosSessao()->getNome(); ?></a>
                    </li>
                    <li class="profile"><a class="dropdown-toggle" href="../login/logout.php">Logout</a></li>
                    
                    
                </ul>                               
            </div>
        </div>
    </div>
</header>

<aside>
    <br>
    <br>
    <br>
    <br>
    <ul class="sideMenu">
        <?php if (!(PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0)) :  ?>
        <li class="active">
            <a href="home.php">Início</a>
        </li>
        <?php endif; ?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../emprestimo/emprestimo-registrar.php">Empréstimo</a>            
            </li>
        <?php else : if (!(PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0)) : ?>
        <li>
            <a href="../emprestimo/emprestimo-listar.php">Empréstimo</a>            
        </li>        
        <?php endif; endif;?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../osso/osso-cadastrar-novo.php">Osso</a>
            </li>
        <?php else : if (!(PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0)) : ?>
            <li>
                <a href="../osso/osso-listar.php">Osso</a>
            </li>
        <?php endif; endif;?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../professor/professor-cadastrar.php">Professor</a>
            </li>
        <?php else : if (!(PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0)) : ?>
            <li>
                <a href="../professor/professor-listar.php">Professor</a>
            </li>
        <?php endif; endif; ?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../aluno/aluno-cadastrar.php">Aluno</a>
            </li>
        <?php else : if (!(PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0)) : ?>
            <li>
                <a href="../aluno/aluno-listar.php">Aluno</a>
            </li>
        <?php endif; endif;?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../administrador/administrador-cadastrar.php">Administrador</a>
            </li>
        <?php endif; ?>
    </ul>
</aside>

<div id="content" class="content-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h2>Perfil</h2>
            <div class="input-prepend pull-right">
                <span class="add-on"><i class="icon-calendar"></i></span>
                <input id="prependedInput" class="text-center" disabled type="text" 
                       placeholder="<?php echo CurrentDate::getCurrentDate(); ?>" value="<?php echo CurrentDate::getCurrentDate(); ?>">
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="tabbable widget">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Perfil de usuário</a></li>                    
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <form class="form-horizontal" method="post" action="perfil.php">
                        <?php $viewUsuario->printForm(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        include_once '../../application/view/footer.view.php';
    endif;
?>