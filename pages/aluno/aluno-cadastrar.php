<?php 
    include_once '../../application/config.php';
    
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';
        
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/AlunoDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/controller/ControllerAluno.php';
    include_once '../../application/persistence/implementacoes/PersistenceAluno.php';
    include_once '../../application/view/ViewAluno.php';
        
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
            include_once '../../application/view/header.view.php';
            $viewAluno = new ViewAluno();

            if (@$_POST['source'] == "cadastrar") {        
                $aluno = new Aluno();
                $aluno->setNome($_POST['nome']);
                $aluno->setMatricula($_POST['matricula']);
                $aluno->setCurso($_POST['curso']);
                $aluno->setEmail($_POST['email']);
                $aluno->setAtivo(true);

                if(isset($_POST["eMonitor"])) {
                    $aluno->setEMonitor(true);
                } else {
                    $aluno->setEMonitor(false);
                }

                $aluno->setEMonitor(true);

                $usuario = new Usuario();
                $usuario->setLogin($_POST['login']);
                $usuario->setSenha($_POST['senha']);
                $usuario->setTipo(3);

                $usuarioController = new ControllerUsuario();
                $usuarioController->salvar($usuario);
                $responseDB = $usuarioController->encontrarPorLogin($usuario->getLogin());

                $aluno->setUsuario($responseDB);        
                $alunoController = new ControllerAluno();
                $alunoController->salvar($aluno);
                header('location:' . $_SERVER['PHP_SELF']);
            }
?>
<style rel="stylesheet" type="text/css">
    .row {
        margin-left: 0px;
    }
</style>
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
                    <li class="active">Página de alunos</li>
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
            <a href="../home/index.php">Dashboard</a>
        </li>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../emprestimo/emprestimo-registrar.php">Empréstimo</a>            
            </li>
        <?php endif; ?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../osso/osso-cadastrar-novo.php">Osso</a>
            </li>
        <?php endif; ?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../professor/professor-cadastrar.php">Professor</a>
            </li>
        <?php endif; ?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li class="active">
                <a href="aluno-cadastrar.php">Aluno</a>
            </li>
        <?php endif; ?>
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
            <h2>Aluno</h2>
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
                    <?php if(PermissionValidator::isAdministrador()) : ?>
                        <li class="active"><a href="aluno-cadastrar.php" data-toggle="tab">Cadastrar Aluno</a></li>
                    <?php endif; ?>
                    <?php if(PermissionValidator::isAdministrador()) : ?>
                        <li><a href="aluno-cadastrar-planilha.php" data-toggle="tab">Cadastrar Planilha de Alunos</a></li>
                    <?php endif; ?>
                    <li><a href="aluno-listar.php" data-toggle="tab">Listar Alunos</a></li>
                    <li><a href="monitor-listar.php" data-toggle="tab">Listar Monitores</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="cadastrar">
                        <form class="form-horizontal" method="post" action="aluno-cadastrar.php">
                            <?php $viewAluno->printForm(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
        include_once '../../application/view/footer.view.php';
        else :
            header("location: aluno-listar.php");
            exit();
        endif;
    endif;
?>