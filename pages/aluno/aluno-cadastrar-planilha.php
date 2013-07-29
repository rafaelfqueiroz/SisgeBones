<?php 
    
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    
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
    include_once '../../application/utils/DadosSessao.php';
//    error_reporting(E_ALL ^ E_NOTICE);
//    require_once '../../application/utils/excel_reader.php';
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../login/index.php");
        exit();
    else :
        if (PermissionValidator::isAdministrador()) :
            include_once '../../application/view/header.view.php';
            $viewAluno = new ViewAluno();

            if (@$_POST['source'] == "cadastrarPlanilha") {
//                $data = array();
                if ( $_FILES['planilha']['tmp_name'] ) {
                    $dom = DOMDocument::load( $_FILES['planilha']['tmp_name'] );                    
                    $rows = $dom->getElementsByTagName('Row');
                    $first_row = false;
                    foreach ($rows as $row) {
                        if ( !$first_row ) {
                            $content = "";
                            $index = 1;
                            $cells = $row->getElementsByTagName('Cell');                            
                            foreach($cells as $cell) {
                                $ind = $cell->getAttribute('Index');
                                if ($ind != null) {
                                    $index = $ind;
                                }
                                if ($index == 1) {
                                    $content = $cell->nodeValue;
                                }
                                $cellContent = explode(" ", $content);
                                $aluno = new Aluno();
                                $aluno->setNome($cellContent[1]);
                                $aluno->setMatricula($cellContent[2]);
                                $aluno->setAtivo(false);
                                $aluno->setEMonitor(false);
                                $aluno->setEmail("Cadastro incompleto");
                                $aluno->setCurso($_POST["curso"]);
                                
                                $usuario = new Usuario();
                                $usuario->setLogin($cellContent[2]);
                                $usuario->setSenha($cellContent[2]);
                                $usuario->setTipo(3);
                                
                                $usuarioController = new ControllerUsuario();
                                $usuarioController->salvar($usuario);
                                $responseDB = $usuarioController->encontrarPorLogin($usuario->getLogin());
                                
                                $aluno->setUsuario($responseDB);
                                $alunoController = new ControllerAluno();
                                $alunoController->salvar($aluno);
//                                array_push($data, $content);
                            }                       
                        }
                    }
                    header('location:' . $_SERVER['PHP_SELF']);
                }
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
                    <li class="home"><a href="../home/home.php"></a><span class="divider"></span></li>              
                    <li class="active">Página de alunos</li>
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
        <li>
            <a href="../professor/professor-cadastrar.php">Professor</a>
        </li>
        <li class="active">
            <a href="aluno-cadastrar-planilha.php">Aluno</a>
        </li>
        <li>
            <a href="../administrador/administrador-cadastrar.php">Administrador</a>
        </li>
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
                    <li><a href="aluno-cadastrar.php" data-toggle="tab">Cadastrar Aluno</a></li>
                    <li class="active"><a href="aluno-cadastrar-planilha.php" data-toggle="tab">Cadastrar Planilha de Alunos</a></li>  
                    <li><a href="aluno-listar.php" data-toggle="tab">Listar Alunos</a></li>
                    <li><a href="monitor-listar.php" data-toggle="tab">Listar Monitores</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="cadastrar">
                        <form class="form-horizontal" method="post" action="aluno-cadastrar-planilha.php" enctype="multipart/form-data">
                            <?php $viewAluno->printFormPlanilha(); ?>
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