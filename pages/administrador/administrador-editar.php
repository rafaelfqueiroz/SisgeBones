<?php 
    include_once '../../application/config.php';
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';
        
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/AdministradorDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/controller/ControllerAdministrador.php';
    include_once '../../application/persistence/implementacoes/PersistenceAdministrador.php';
    include_once '../../application/view/ViewAdministrador.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/utils/DadosSessao.php';
    include_once '../../application/utils/CurrentDate.php';
    include_once '../../application/utils/Validator.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../../index.php");
        exit();
    else :
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
        if (PermissionValidator::isAdministrador()) :
            $admin = unserialize($_SESSION["usuario"]);
            if ($admin->getModerador() == '0') :                
                include_once '../../application/view/header.view.php';   
                $viewAdministrador = new ViewAdministrador();
                if (@$_POST['source'] == "editar") {                    
                    $administrador = new Administrador();
                    $administrador->setId(@$_POST['id']);
                    $administrador->setNome(@$_POST['nome']);
                    $administrador->setMatricula(@$_POST['matricula']);  
                    $administrador->setEmail(@$_POST['email']);
                    if(isset($_POST['moderador'])) {
                        $administrador->setModerador(true);
                    } else {
                        $administrador->setModerador(false);
                    }
                    $usuario = new Usuario();
                    $usuario->setId(@$_POST['idUsuario']);
                    $usuario->setLogin(@$_POST['login']);
                    $usuario->setSenha(@$_POST['senha']);
                    $usuario->setTipo(1);

                    $usuarioController = new ControllerUsuario();
                    $usuarioController->atualizarUsuario($usuario, @$_POST["confirmarSenha"], @$_POST["id"]);

                    $administrador->setUsuario($usuario);
                    $adminController = new ControllerAdministrador();
                    $flag = $adminController->atualizarAdministrador($administrador);
                    if ($flag) {
                        if ($administrador->getId() == DadosSessao::getDadosSessao()->getId()) {
                            $_SESSION["usuario"] = serialize($administrador);
                        }
                    }
                    header('location: administrador-listar.php');
                    exit();
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
                
                <ul class="breadcrumb visible-desktop">
                    <li class="home"><a href="../home/home.php"></a><span class="divider"></span></li>                
                    <li class="active">Página de administradores</li>
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
            <li>
                <a href="../professor/professor-cadastrar.php">Professor</a>
            </li>                    
            <li>
                <a href="../aluno/aluno-cadastrar.php">Aluno</a>
            </li>                
            <li class="active">
                <a href="../administrador/administrador-cadastrar.php">Administrador</a>
            </li>
    </ul>
</aside>

<div id="content" class="content-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h2>Administrador</h2>
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
                    <li class="active"><a href="administrador-cadastrar.php" data-toggle="tab">Editar Administrador</a></li>
                    <li><a href="administrador-listar.php" data-toggle="tab">Listar Administrador</a></li>
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <form class="form-horizontal" method="post" action="administrador-editar.php">
                        <?php $viewAdministrador->printEditForm($_GET["id"]); ?>
                    </form>
                </div>
            </div>            
        </div>
    </div>
</div>
<?php 
            include_once '../../application/view/footer.view.php';
            else :
                header("location: administrador-listar.php");
                exit();
            endif;
        else :
            header("location: ../home/home.php");
            exit();
        endif;
    endif;
?>