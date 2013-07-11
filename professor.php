<?php 
    include_once 'application/view/header.view.php';
    include_once 'application/config.php';
    
    include_once 'application/controller/Controller.php';
    include_once 'application/controller/CrudController.php';
    include_once 'application/model/AbstractEntity.php';
    include_once 'application/view/AbstractView.php';
        
    include_once 'application/persistence/abstracao/Dao.php';
    include_once 'application/persistence/abstracao/Persistencia.php';
    include_once 'application/persistence/interfaces/ProfessorDao.php';
    
    include_once 'application/model/Professor.php';
    include_once 'application/controller/ControllerProfessor.php';    
    include_once 'application/persistence/implementacoes/PersistenceProfessor.php';
    include_once 'application/view/ViewProfessor.php';
    
    $viewProfessor = new ViewProfessor();
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
                    <li class="active">Página de Professores</li>
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
        <li>
            <a href="osso.php">Osso</a>
        </li>
        <li class="active">
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
                    <li class="active"><a href="#cadastrar" data-toggle="tab">Cadastrar Professor</a></li>
                    <li><a href="#listar-professores" data-toggle="tab">Listar Professores</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="cadastrar">
                       <form class="form-horizontal" method="post">
                            <?php $viewProfessor->printForm(); ?>
                        </form>
                    </div>
                    <div class="tab-pane" id="listar-professores">
                        <p>Section 2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'application/view/footer.view.php'; ?>

<?php 
    if (@$_POST['source'] == "cadastrar") {
        $professor = new Professor();
        $professor->nome = $_POST['nome'];
        $professor->matricula = $_POST['matricula'];
        $professor->email = $_POST['email'];
        $professor->rg = $_POST['rg'];
        $usuario = new Usuario();
        $usuario->login = $_POST['login'];        
        $usuario->senha = $_POST['senha'];
        $usuario->tipo = 3;
        
        $professor->usuario = $usuario;
        
        $professorController = new ControllerProfessor();
        $professorController->salvar($professor);
    } 
?>

