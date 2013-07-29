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
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../login/index.php");
        exit();
    else :
        if (PermissionValidator::isAdministrador()) :
            include_once '../../application/view/header.view.php';
            $viewProfessor = new ViewProfessor();

            if (@$_POST['source'] == "cadastrar") {
                $professor = new Professor();
                $professor->setNome($_POST['nome']);
                $professor->setMatricula($_POST['matricula']);
                $professor->setEmail($_POST['email']);
                $professor->setRg($_POST['rg']);

                $usuario = new Usuario();
                $usuario->setLogin($_POST['login']);
                $usuario->setSenha($_POST['senha']);
                $usuario->setTipo(2);

                $usuarioController = new ControllerUsuario();
                $usuarioController->salvar($usuario);
                $responseDB = $usuarioController->encontrarPorLogin($usuario->getLogin());

                $professor->setUsuario($responseDB);
                $professorController = new ControllerProfessor();     
                $professorController->salvar($professor);        
            }
?>

<script src="../../resource/js/sisgebones/scriptValidateProfessor.js"></script>

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
                    <li class="active">Página de Professores</li>
                </ul>
                
                <ul class="profileBar">
                    <li class="user visible-desktop"><img src="../../resource/img/user.jpg" alt=""></li>
                    <li class="profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo DadosSessao::getDadosSessao()->getNome(); ?></a>
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
                <input id="prependedInput" class="text-center" type="text" 
                       placeholder="12/01/2013 - 18/01/2013" value="12/01/2013 - 18/01/2013">
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
                    <div class="tab-pane active" id="cadastrar">
                       <form class="form-horizontal" method="post" action="professor-cadastrar.php">
                            <?php $viewProfessor->printForm(); ?>
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
            header("location: professor-listar.php");
            exit();
        endif;
    endif;
?>

