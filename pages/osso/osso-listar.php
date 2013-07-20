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
    
    session_start();
    
    if (empty($_SESSION["usuario"])) :
        header("location: ../login/login.php");
        exit();
    else :
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
                    <li class="home"><a href="../home/index.php"></a><span class="divider"></span></li>                  
                    <li class="active">Página de Ossos</li>
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
                        <li ><a href="osso-cadastrar-novo.php" data-toggle="tab">Cadastrar Novo Osso</a></li>
                    <?php endif; ?>
                    <?php if(PermissionValidator::isAdministrador()) : ?>
                        <li><a href="osso-cadastrar-existente.php" data-toggle="tab">Cadastrar Osso Existente</a></li>
                    <?php endif; ?>
                    <li class="active"><a href="osso-listar.php" data-toggle="tab">Listar Ossos</a></li>                
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listar-ossos">
                        <?php $viewOsso->printListAsTable(); ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include_once '../../application/view/footer.view.php'; 
    endif;
?>