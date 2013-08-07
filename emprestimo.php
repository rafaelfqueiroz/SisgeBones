<?php 
    include_once 'application/view/header.view.php';
    include_once 'application/config.php';
    
    include_once 'application/controller/Controller.php';
    include_once 'application/controller/CrudController.php';
    include_once 'application/model/AbstractEntity.php';
    include_once 'application/view/AbstractView.php';
        
    include_once 'application/persistence/abstracao/Dao.php';
    include_once 'application/persistence/abstracao/Persistencia.php';
    include_once 'application/persistence/interfaces/EmprestimoDao.php';
    
    include_once 'application/model/Emprestimo.php';
    include_once 'application/controller/ControllerEmprestimo.php';    
    include_once 'application/persistence/implementacoes/PersistenceEmprestimo.php';
    include_once 'application/view/ViewEmprestimo.php';
    
    $viewEmprestimo = new ViewEmprestimo();
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
                    <li class="home"><a href="index.php"></a><span class="divider"></span></li>                   
                    <li class="active">Página de empréstimos</li>
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
        <li class="active">
            <a href="emprestimo.php">Empréstimo</a>            
        </li>
        <li>
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
            <h2>Empréstimo</h2>
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
                    <li class="active"><a href="#realizar" data-toggle="tab">Realizar Empréstimo</a></li>
                    <li><a href="#listar-emprestimos" data-toggle="tab">Listar Empréstimos</a></li>
                    <li><a href="#emprestimos-pendentes" data-toggle="tab">Empréstimos Pendentes</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="realizar">
                        <form class="form-horizontal" method="post">
                            <?php $viewEmprestimo->printForm(); ?>
                        </form>
                    </div>
                    <div class="tab-pane" id="listar-emprestimos">
                        <p>Section 2</p>
                    </div>
                    <div class="tab-pane" id="emprestimos-pendentes">
                        <p>Section 3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'application/view/footer.view.php'; ?>

<?php 
    if (@$_POST['source'] == "cadastrar") {
        $emprestimo = new Emprestimo();
        $emprestimo->dataEmprestimo = $_POST['dataEmprestimo'];
        $emprestimo->dataDevolucao = $_POST['dataDevolucao'];
        $emprestimo->dataDevolucao = $_POST['dataDevolucao'];
        $osso = new ControllerOsso();
        $emprestimo->codigo = $_POST['codigo'];
        $emprestimo->administrador = $_POST['nomeAdmin'];
        explode($campodetexto, ';');
        $emprestimoController = new ControllerEmprestimo();
        $emprestimoController->salvar($emprestimo);
    } 
?>
