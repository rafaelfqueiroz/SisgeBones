<?php     
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';

    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/OssoDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Osso.php';
    include_once '../../application/controller/ControllerOsso.php';    
    include_once '../../application/persistence/implementacoes/PersistenceOsso.php';
    include_once '../../application/view/ViewOsso.php';
    include_once '../../application/utils/DadosSessao.php';
    include_once '../../application/utils/CurrentDate.php';
    include_once '../../application/utils/Validator.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])) :
        header("location: ../../index.php");
        exit();
    else :
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
        include_once '../../application/view/header.view.php';
        $viewOsso = new ViewOsso();    
?>

<style rel="stylesheet" type="text/css">
    .row {
        margin-left: 0px;
    }
</style>

<script src="../../resource/js/sisgebones/scriptValidateOsso.js"></script>

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
                    <li class="active">Página de Ossos</li>
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
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../emprestimo/emprestimo-registrar.php">Empréstimo</a>            
            </li>
        <?php else : ?>
            <li>
                <a href="../emprestimo/emprestimo-listar.php">Empréstimo</a>            
            </li>        
        <?php endif; ?>
        <li class="active">
            <a href="../osso/osso-listar.php">Osso</a>
        </li>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../professor/professor-cadastrar.php">Professor</a>
            </li>
        <?php else : ?>
            <li>
                <a href="../professor/professor-listar.php">Professor</a>
            </li>
        <?php endif; ?>
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../aluno/aluno-cadastrar.php">Aluno</a>
            </li>
        <?php else : ?>
            <li>
                <a href="../aluno/aluno-listar.php">Aluno</a>
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
            <h2>Osso</h2>
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
                    <?php if(PermissionValidator::isAdministrador()) : ?>
                        <li ><a href="osso-cadastrar-novo.php" data-toggle="tab">Cadastrar Novo Osso</a></li>
                    <?php endif; ?>
                    <?php if(PermissionValidator::isAdministrador()) : ?>
                        <li><a href="osso-cadastrar-existente.php" data-toggle="tab">Cadastrar Osso Existente</a></li>
                    <?php endif; ?>
                    <li class="active"><a href="osso-listar.php" data-toggle="tab">Listar Ossos</a></li>                
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <?php $viewOsso->printListAsTable(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include_once '../../application/view/footer.view.php'; 
    endif;
?>