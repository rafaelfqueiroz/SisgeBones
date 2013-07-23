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
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../login/login.php");
        exit();
    else :
        if (PermissionValidator::isAdministrador()) :
            $admin = unserialize($_SESSION["usuario"]);
            if ($admin->getModerador() == '0') :
                include_once '../../application/view/header.view.php';   
                $viewAdministrador = new ViewAdministrador();
                if (@$_POST['source'] == "editar") {
                    $administrador = new Administrador();
                    $administrador->setId($_POST['id']);
                    $administrador->setNome($_POST['nome']);
                    $administrador->setMatricula($_POST['matricula']);  
                    $administrador->setEmail($_POST['email']);
                    if(isset($_POST['moderador'])) {
                        $administrador->setModerador(true);
                    } else {
                        $administrador->setModerador(false);
                    }
                    $usuario = new Usuario();
                    $usuario->setId($_POST['idUsuario']);
                    $usuario->setLogin($_POST['login']);
                    $usuario->setSenha($_POST['senha']);
                    $usuario->setTipo(1);

                    $usuarioController = new ControllerUsuario();
                    $usuarioController->atualizar($usuario);

                    $administrador->setUsuario($usuario);
                    $adminController = new ControllerAdministrador();
                    $adminController->atualizar($administrador);                    
                    header('location: administrador-listar.php');
                    exit();
                }
?>

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
                    <li class="home"><a href="../home/index.php"></a><span class="divider"></span></li>                
                    <li class="active">Página de administradores</li>
                </ul>
                
                <ul class="profileBar">
                    <li class="user visible-desktop"><img src="../../resource/img/user.jpg" alt=""></li>
                    <li class="profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Rafael<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a tabindex="-1" href="#">Action</a></li>                            
                            <li><a tabindex="-1" href="#">Another action</a></li>                            
                            <li><a tabindex="-1" href="#">Something else here</a></li>                            
                        </ul>
                    </li>
                    <li class="profile"><a class="dropdown-toggle" href="../login/logout.php">Logout</a></li>
                    <li class="calendar"><a href="#"></a></li>
                    <li class="mail"><a href="#"></a><span class="attention">!</span></li>
                </ul>                               
            </div>
        </div>
    </div>
</header>

<aside>
    <form class="form-search">
        <div class="input-prepend">
            <button type="submit" class="btn"></button>
            <input type="text" class="search-query">
        </div>
    </form>
    
    <ul class="sideMenu">
        <li>
            <a href="index.php">Dashboard</a>
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
                <input id="prependedInput" class="text-center" type="text" 
                       placeholder="12/01/2013 - 18/01/2013" value="12/01/2013 - 18/01/2013">
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="tabbable widget">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="administrador-cadastrar.php" data-toggle="tab">Cadastrar Administrador</a></li>
                    <li><a href="administrador-listar.php" data-toggle="tab">Listar Administrador</a></li>
                </ul>
                <div class="tab-content">
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
            header("location: ../home/index.php");
            exit();
        endif;
    endif;
?>