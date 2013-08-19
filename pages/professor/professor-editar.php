<?php 
    
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';
        
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/ProfessorDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/controller/ControllerProfessor.php';    
    include_once '../../application/persistence/implementacoes/PersistenceProfessor.php';
    include_once '../../application/view/ViewProfessor.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    include_once '../../application/utils/DadosSessao.php';
    include_once '../../application/utils/CurrentDate.php';
    include_once '../../application/utils/Validator.php';
    
    session_start();
    
    if (empty($_SESSION["sUsuario"])):
        header("location: ../../index.php");
        exit();
    else :
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
        if (PermissionValidator::isAdministrador()) :
            include_once '../../application/view/header.view.php';
            $viewProfessor = new ViewProfessor();
            if (@$_POST['source'] == "editar") {
                $professor = new Professor();
                $professor->setId($_POST['id']);
                $professor->setNome($_POST['nome']);
                $professor->setMatricula($_POST['matricula']);
                $professor->setEmail($_POST['email']);
                $professor->setRg($_POST['rg']);

                $usuario = new Usuario();
                $usuario->setId($_POST['idUsuario']);
                $usuario->setLogin($_POST['login']);
                $usuario->setSenha($_POST['senha']);
                $usuario->setTipo(2);

                $usuarioController = new ControllerUsuario();
                $usuarioController->atualizarUsuario($usuario, $_POST["confirmarSenha"]);

                $professor->setUsuario($usuario);
                $professorController = new ControllerProfessor();       
                $flag = $professorController->atualizarProfessor($professor);
                if ($flag) {
                    if ($professor->getId() == DadosSessao::getDadosSessao()->getId()) {
                        $_SESSION["sUsuario"] = ($professor);
                    }
                }  
                header("location: professor-listar.php");
                exit();
            }
?>

<script src="../../resource/js/sisgebones/scriptValidateProfessor.js"></script>
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
                
                <a class="logo" href="#"><img src="../../resource/img/logo_mini_white.png" alt=""></a>
                
                <ul class="breadcrumb visible-desktop">
                    <li class="home"><a href="../home/home.php"></a><span class="divider"></span></li>                                                          
                    <li class="active">Página de Professores</li>
                </ul>
                
                <ul class="profileBar">
                    <li class="user visible-desktop"><img src="../../resource/img/user_avatar.png" alt=""></li>
                    <li class="profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="../home/perfil.php"><?php echo DadosSessao::getDadosSessao()->getNome(); ?></a>
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
        <li>
            <a href="../home/home.php">Início</a>
        </li>
        <li>
            <a href="../emprestimo/emprestimo-registrar.php">Empréstimo</a>            
        </li>
        <li>
            <a href="../osso/osso-cadastrar-novo.php">Osso</a>
        </li>
        <li class="active">
            <a href="../professor/professor-cadastrar.php">Professor</a>
        </li>
        <li>
            <a href="../aluno/aluno-cadastrar.php">Aluno</a>
        </li>
        <li>
            <a href="../administrador/administrador-cadastrar.php">Administrador</a>
        </li>
    </ul>
</aside>

<div id="content" class="content-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h2>Professor</h2>
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
                    <li class="active"><a href="professor-cadastrar.php" data-toggle="tab">Cadastrar Professor</a></li>
                    <li><a href="professor-listar.php" data-toggle="tab">Listar Professores</a></li>
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <form class="form-horizontal" method="post" action="professor-editar.php">
                        <?php $viewProfessor->printEditForm($_GET["id"]); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        include_once '../../application/view/footer.view.php';
        else :
            header("location: professor-listar.php");
            exit();
        endif;
    endif;
?>

