<?php 
    include_once 'application/view/header.view.php';
    include_once 'application/config.php';
    
    include_once 'application/controller/Controller.php';
    include_once 'application/controller/CrudController.php';
    include_once 'application/model/AbstractEntity.php';
    include_once 'application/view/AbstractView.php';
            
    include_once 'application/persistence/abstracao/Dao.php';
    include_once 'application/persistence/abstracao/Persistencia.php';
    include_once 'application/persistence/interfaces/OssoDao.php';
    
    include_once 'application/model/Osso.php';
    include_once 'application/controller/ControllerOsso.php';    
    include_once 'application/persistence/implementacoes/PersistenceOsso.php';
    include_once 'application/view/ViewOsso.php';
    
    $viewOsso = new ViewOsso();
    
    if (@$_POST['osso-novo'] == "cadastrar") {
        $osso = new Osso();
        $osso->setNome(@$_POST['nome']);
        $osso->setQuantidade(@$_POST['quantidade']);
        $osso->setCodigo(@$_POST['codigo']);   
        $ossoController = new ControllerOsso();  
        $ossoController->salvar($osso);
        header('location:' . $_SERVER['PHP_SELF']);
    } else if (@$_POST['osso-existente'] == "inserir") {
        $codigoOsso = @$_POST['codigoOsso'];
        $quantidadeOsso = @$_POST['quantidadeOsso'];
        $ossoController = new ControllerOsso();        
        $osso = $ossoController->encontrarPorCodigo($codigoOsso);
        $quantidadeOsso += $osso->getQuantidade();
        $osso->setQuantidade($quantidadeOsso);
        $ossoController->atualizar($osso);
    }
?>

<style rel="stylesheet" type="text/css">
    .row {
        margin-left: 0px;
    }
</style>

<script src="resource/js/sisgebones/scriptValidateOsso.js"></script>

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
                    <li class="home"><a href="index.php"></a><span class="divider"></span></li>                  
                    <li class="active">Página de Ossos</li>
                </ul>
                
                <ul class="profileBar">
                    <li class="user visible-desktop"><img src="resource/img/user.jpg" alt=""></li>
                    <li class="profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Rafael<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a tabindex="-1" href="#">Action</a></li>                            
                            <li><a tabindex="-1" href="#">Another action</a></li>                            
                            <li><a tabindex="-1" href="#">Something else here</a></li>                            
                        </ul>
                    </li>
                    <li class="notify"><a href="#"><span>2</span></a></li>
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
            <a href="emprestimo.php">Empréstimo</a>            
        </li>
        <li class="active">
            <a href="osso.php">Osso</a>
        </li>
        <li>
            <a href="professor.php">Professor</a>
        </li>
        <li>
            <a href="aluno.php">Aluno</a>
        </li>
        <li>
            <a href="administrador.php">Administrador</a>
        </li>
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
                    <li ><a href="#cadastrar-novo-osso" data-toggle="tab">Cadastrar Novo Osso</a></li>
                    <li><a href="#cadastrar-osso-existente" data-toggle="tab">Cadastrar Osso Existente</a></li>
                    <li class="active"><a href="#listar-ossos" data-toggle="tab">Listar Ossos</a></li>                
                </ul>
                <div class="tab-content">
                    <div class="tab-pane " id="cadastrar-novo-osso">
                        <form id="form-osso" class="form-horizontal" method="post" action="osso.php">
                            <?php $viewOsso->printForm(); ?>
                        </form>
                    </div>
                    <div class="tab-pane" id="cadastrar-osso-existente">
                        <form id="form-osso-existente" class="form-horizontal" method="post" action="osso.php">
                            <?php $viewOsso->printFormOsso(); ?>
                        </form>
                    </div>
                    <div class="tab-pane active" id="listar-ossos">
                        <?php $viewOsso->printListAsTable(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'application/view/footer.view.php'; ?>