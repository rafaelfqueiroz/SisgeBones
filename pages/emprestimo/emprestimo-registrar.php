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
    
    session_start();
    
    if (empty($_SESSION["usuario"])):
        header("location: ../login/index.php");
        exit();
    else :
        if (PermissionValidator::isAdministrador()) :
            $viewEmprestimo = new ViewEmprestimo();       
            $admin = unserialize($_SESSION["usuario"]);
            if (@$_POST['source'] == "registrar") {
                $emprestimo = new Emprestimo();
                if ($_POST['tipo'] == "3") {
                    $alunoController = new ControllerAluno();
                    $aluno = new Aluno();
                    $aluno->setId($_POST['nome']);
                    $aluno = $alunoController->encontrarPorId($aluno);
                    $emprestimo->setUsuario($aluno->getUsuario());
                } else if ($_POST['tipo'] == "2"){
                    $professorController = new ControllerProfessor();
                    $professor = new Professor();
                    $professor->setId($_POST['nome']);
                    $professor = $professorController->encontrarPorId($professor);
                    $emprestimo->setUsuario($professor->getUsuario());
                }
                $emprestimo->setDataEmprestimo(date('Y-m-d-H:i:s'));
                $emprestimo->setDataDevolucao(NULL);
                $emprestimo->setQuantidade($_POST["quantidade"]);
                $emprestimo->setAdministrador($admin);      
                $ossoController = new ControllerOsso();
                $ossos = array();                
                
                foreach ($_POST["bones"] as $idOsso) {
                    $osso = new Osso();
                    $osso->setId($idOsso);
                    $osso = $ossoController->encontrarPorId($osso);                    
                    array_push($ossos, $osso);
                }
                $emprestimo->setOssos($ossos);
                $emprestimoController = new ControllerEmprestimo();
                $emprestimoController->salvar($emprestimo);
            } 
?>
<script src="../../resource/js/jquery/select2.min.js"></script>
<link rel="stylesheet" href="../../resource/css/select2/select2.css">
<script>
//      $(function(){jQuery('.select2').select2({placeholder:"Escolha uma opção"});});
        $(function(){jQuery('.select2').select2();});
        
      var dataAluno;
      var dataProfessor;
      $(document).ready(function() {
          dataAluno = $.get("EmprestimoAluno.php");
          dataProfessor = $.get("EmprestimoProfessor.php");
          $("#s2id_selectUsuario a span.select2-chosen").text("Insira o nome do aluno");
          $("#radioAluno").bind('click', function(){
              dataAluno.done(function(data){
                  $("#selectUsuario").html(data);
                  $("#inputTipo").val(3);
                  $("#s2id_selectUsuario a span.select2-chosen").text("Insira o nome do aluno");
              });
          });
          $("#radioProfessor").bind('click', function(){
              dataProfessor.done(function(data){
                  $("#selectUsuario").html(data);
                  $("#inputTipo").val(2);
                  $("#s2id_selectUsuario a span.select2-chosen").text("Insira o nome do professor");
              });
          });
      });
</script>

<style type="text/css">
    .radioEmprestimo {
        position: absolute;
    }
    .labelRadio {
        display: inline;
        margin: 0px 20px 5px 17px;
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
                <input id="prependedInput" class="text-center" type="text" 
                       placeholder="12/01/2013 - 18/01/2013" value="12/01/2013 - 18/01/2013">
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="tabbable widget">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="emprestimo-registrar.php" data-toggle="tab">Realizar Empréstimo</a></li>
                    <li><a href="emprestimo-listar.php" data-toggle="tab">Listar Empréstimos</a></li>
                    <li><a href="emprestimo-listar-pendentes.php" data-toggle="tab">Empréstimos Pendentes</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="realizar">
                        <form class="form-horizontal" method="post" action="emprestimo-registrar.php">
                            <?php $viewEmprestimo->printForm(); ?>
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
            header("location: ../home/home.php");
            exit();
        endif;
    endif;
?>