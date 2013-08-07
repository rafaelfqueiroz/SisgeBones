<?php 
    include_once '../../application/view/header.view.php';
    include_once '../../application/config.php';
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';
        
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/EmprestimoDao.php';
    include_once '../../application/persistence/interfaces/AdministradorDao.php';
    include_once '../../application/persistence/interfaces/ProfessorDao.php';
    include_once '../../application/persistence/interfaces/AlunoDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    include_once '../../application/persistence/interfaces/OssoDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/controller/ControllerAdministrador.php';
    include_once '../../application/persistence/implementacoes/PersistenceAdministrador.php';
    
    include_once '../../application/model/Emprestimo.php';
    include_once '../../application/controller/ControllerEmprestimo.php';    
    include_once '../../application/persistence/implementacoes/PersistenceEmprestimo.php';
    include_once '../../application/view/ViewEmprestimo.php';
    
    include_once '../../application/model/Professor.php';
    include_once '../../application/controller/ControllerProfessor.php';    
    include_once '../../application/persistence/implementacoes/PersistenceProfessor.php';
    
    include_once '../../application/model/Aluno.php';
    include_once '../../application/controller/ControllerAluno.php';
    include_once '../../application/persistence/implementacoes/PersistenceAluno.php';
    
    include_once '../../application/model/Osso.php';
    include_once '../../application/controller/ControllerOsso.php';    
    include_once '../../application/persistence/implementacoes/PersistenceOsso.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/utils/DadosSessao.php';
    include_once '../../application/utils/CurrentDate.php';
    include_once '../../application/utils/Validator.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../login/index.php");
        exit();
    else :
        if (!empty($_GET["id"]) || @$_POST['source'] == "finalizar") :
            $viewEmprestimo = new ViewEmprestimo();
            if (@$_POST['source'] == "finalizar") {
                $emprestimoController = new ControllerEmprestimo();
                $emprestimo = new Emprestimo();
                $emprestimo->setId(@$_POST["idEmprestimo"]);
                $ossosEmprestimo = $emprestimoController->listarOssosDeEmprestimo($emprestimo);
                $emprestimo = $emprestimoController->encontrarPorId($emprestimo);
                $emprestimo->setStatus(false);
                $emprestimo->setDataDevolucao(date('Y-m-d-H:i:s'));
                $emprestimoController->atualizar($emprestimo);
                $ossoController = new ControllerOsso();          
                foreach ($ossosEmprestimo as $osso) {
                    $upQtd = $osso->getQtdDisponivel() + $osso->getQtdEmprestada();
                    $osso->setQtdDisponivel($upQtd);
                    $ossoController->atualizar($osso);
                }
                header("location: emprestimo-listar-pendentes.php");
                exit();
            }
?>

<style rel="stylesheet" type="text/css">
    .controls label.answer {
        width: auto;
        text-align: left;
        margin-left: 120px;
    }
    .controls label.description {
        font-weight: bold;
        color: #5e5e5e;
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
                    <li class="home"><a href="../home/home.php"></a><span class="divider"></span></li>                   
                    <li class="active">Página de empréstimos</li>
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
        <li class="active">
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
        <li>
            <a href="../administrador/administrador-cadastrar.php">Administrador</a>
        </li>
    </ul>
</aside>

<div id="content" class="content-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h2>Empréstimo</h2>
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
                    <li class="active"><a href="emprestimo-detalhes.php?id=<?php echo $_GET["id"] ?>" data-toggle="tab">Detalhes Empréstimo</a></li>
                    <?php if(PermissionValidator::isAdministrador()) : ?>
                        <li><a href="emprestimo-registrar.php" data-toggle="tab">Registrar Empréstimo</a></li>
                        <li><a href="emprestimo-listar.php" data-toggle="tab">Listar Empréstimos</a></li>
                        <li><a href="emprestimo-listar-pendentes.php" data-toggle="tab">Empréstimos Pendentes</a></li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <form class="form-horizontal" method="post" action="emprestimo-detalhes.php">
                        <?php $viewEmprestimo->printEmprestimoDetalhes($_GET["id"]); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        include_once '../../application/view/footer.view.php'; 
        else :
            if (PermissionValidator::isAdministrador()) {
                header("location: emprestimo-listar.php");
                exit();
            } else {
                header("location: emprestimo-usuario.php");
                exit();
            }
        endif;
    endif;
?>