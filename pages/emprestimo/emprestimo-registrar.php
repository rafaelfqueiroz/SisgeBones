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
        header("location: ../../index.php");
        exit();
    else :
        if (PermissionValidator::isAluno() && DadosSessao::getDadosSessao()->getAtivo() == 0) {
            header('location: ../home/perfil.php');
            exit();
        }
        if (PermissionValidator::isAdministrador()) :            
            $viewEmprestimo = new ViewEmprestimo();       
            $admin = unserialize($_SESSION["usuario"]);
            if (@$_POST['source'] == "registrar") {
                $emprestimo = new Emprestimo();
                if (@$_POST['tipo'] == "3") {
                    $alunoController = new ControllerAluno();
                    $aluno = new Aluno();
                    $aluno->setId(@$_POST['nome']);
                    $aluno = $alunoController->encontrarPorId($aluno);
                    $emprestimo->setUsuario($aluno->getUsuario());
                } else if (@$_POST['tipo'] == "2"){
                    $professorController = new ControllerProfessor();
                    $professor = new Professor();
                    $professor->setId(@$_POST['nome']);
                    $professor = $professorController->encontrarPorId($professor);
                    $emprestimo->setUsuario($professor->getUsuario());
                }                
                $emprestimo->setDataEmprestimo(date('Y-m-d-H:i:s'));
                $emprestimo->setDataDevolucao(NULL);
                
                $emprestimo->setQuantidade(@$_POST["quantidadeTotal"]);
                $emprestimo->setAdministrador($admin);
                $emprestimo->setStatus(true);
                $ossoController = new ControllerOsso();
                $ossos = array();
                $ossos = unserialize($_SESSION["bandeja"]);
                foreach ($ossos as $osso) {
                    $osso = $ossoController->atualizar($osso);
                }
                $emprestimo->setOssos($ossos);
                $emprestimoController = new ControllerEmprestimo();
                $flag = $emprestimoController->salvar($emprestimo);
                if ($flag == 1) {
                    unset($_SESSION["bandeja"]);
                    unset($_SESSION["contador"]);
                }
            } 
?>
<script src="../../resource/js/jquery/jquery.blockUI.js"></script>
<script src="../../resource/js/jquery/select2.min.js"></script>
<script src="../../resource/js/json2.js"></script>
<link rel="stylesheet" href="../../resource/css/select2/select2.css" />
<script>       
      var dataAluno;
      var dataProfessor;
      var dataBones;
      var listDataBones;
      $(document).ready(function() {
          $('.select2').select2();//ESTA LINHA É ESTREMAMENTE NECESSÁRIOA PARA O FUNCUONAMENTO DOS SELECT
          $(".select2#selectUsuario").select2({allowClear:true,placeholder:"Escolha um aluno"});
          dataAluno = $.get("EmprestimoAluno.php");
          dataProfessor = $.get("EmprestimoProfessor.php");
          dataBones = $.get("EmprestimoOsso.php");
          $("#radioAluno").bind('click', function(){
              dataAluno.done(function(data){
                  $(".select2#selectUsuario").html(data);
                  $("#inputTipo").val(3);
                  $(".select2#selectUsuario").select2({placeholder:"Escolha um aluno"});
              });
          });
          $("#radioProfessor").bind('click', function(){
              dataProfessor.done(function(data){
                  $(".select2#selectUsuario").html(data);
                  $("#inputTipo").val(2);
                  $(".select2#selectUsuario").select2({placeholder:"Escolha um professor"});
              });
          });
          
          $(".select2#selectOsso").change(function(){              
              $("#emprestimo-form .controls").children().attr("disabled", "disabled");
              $("table").attr("disabled", "disabled");
              adicionarComponentesDeEmprestimo();
          });
          $("#inputQuantidade").val($("#totalQtdCell").text().substring(7));
          
          $('#registrarEmprestimoBtn').click(function () {
                $.blockUI({
                    message: 'Por favor, aguarde...',
                    css: { 
                        border: 'none', 
                        padding: '15px',
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5,
                        color: '#fff'
                    }
                });
          });
      });
      
      function adicionarComponentesDeEmprestimo() {
          var componentesDiv = '<label class="control-label" for="qtdOssosEmprestimo">Quantidade</label>' +
              '<div class="controls">' +
              '<input id="qtdOssosEmprestimo" name="qtdOssos" style="width:50px;" min=\"1\" max=\"30\" required type="number" />&nbsp&nbsp&nbsp' +
              '<a href="#" id="cancel-tray" class="btn" onClick="cancelarDaBandeja()">Cancelar</a>&nbsp&nbsp&nbsp' +
              '<a href="#" id="add-tray" class="btn small-btn btn-success" onClick="adicionarNaBandeja()">Ok</a>' +
              '</div>';
          $("#divOssos").html(componentesDiv);
      }
      function removerComponentesDeEmprestimo() {
          $("#emprestimo-form .controls").children().removeAttr("disabled");
          $("#inputAdministrador").attr("disabled", "disabled");
          $("#inputQuantidade").attr("disabled", "disabled");
          $("table").removeAttr("disabled");
          $("#divOssos").empty();
          $(".select2#selectOsso").select2("val","");          
      }
      function adicionarNaBandeja() {
          var idOsso = $('.select2#selectOsso').val();
          var qtd = $('#qtdOssosEmprestimo').val();
          qtd = parseInt(qtd);
          if (qtd != null && qtd > 0) {
            var info;
            if (listDataBones == null) {
                    dataBones.done(function(data) {
                        listDataBones = $.parseJSON(data);
                    });
            }
            var index;
            for (index = 0; index < listDataBones.length; index++) {
                if (listDataBones[index].id == idOsso) {
                    info = listDataBones[index];
                    break;
                }
            }
            var limite = info.qtdDisponivel - qtd;
            if (limite >= 0) {
                    info.qtdDisponivel = limite;
                    listDataBones[index] = info;
                    info = JSON.stringify(info);

                    var posting = $.post("../../application/utils/Bandeja.php", 
                    { item: info, action:"adicionar", qtdOsso: qtd });
                    posting.done(function (response) {
                        if($('#tableTray').length > 0) {
                            addRowAtTableTray(response);
                        } else {
                            createTableTray();
                            addRowAtTableTray(response);
                        }
                });
                removerComponentesDeEmprestimo();            
                return false;
            } else {
                alert("Quantidade indisponível para empréstimo");
            }
          } else {
            alert("A quantidade deve ser maior do que zero");
          }
      }
      
      function removerDaBandeja(idOsso, qtdOsso) {
            var info;
            info = JSON.stringify(idOsso);
            var posting = $.post("../../application/utils/Bandeja.php",
            { item: info, action:"remover"});

            posting.done(function (response) {
                addRowAtTableTray(response);
            });
             var incremented;
            var index;
            for (index = 0; index < listDataBones.length; index++) {
                if (listDataBones[index].id == idOsso) {
                    incremented =  listDataBones[index].qtdDisponivel;
                    break;
                }
            }
            listDataBones[index].qtdDisponivel = incremented + qtdOsso;
      }
      
      function cancelarDaBandeja() {
          removerComponentesDeEmprestimo();
      }
      
      function createTableTray() {
          var table = 
            '<table id="tableTray" class="table table-striped table-bordered dataTable">' +
                '<thead>' +
                    '<tr role="row">' +
                        '<th class="sorting_asc" role="columnheader">Nome</th>' +
                        '<th class="sorting" role="columnheader">Código</th>' +
                        '<th class="sorting" role="columnheader">Quantidade</th>' +
                        '<th class="sorting" role="columnheader"></th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>' +
                '</tbody>' +
            '</table>';
          $("#divTableTray").html(table);
      }
      
      function addRowAtTableTray(dataTBody) {
          $("#divTableTray tbody").html(dataTBody);
          $("#inputQuantidade").val(parseInt($("#totalQtdCell").text().substring(7)));
      }
      
      function enableInput() {
          $("#inputQuantidade").removeAttr("disabled");
      }
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
                    <li class="active"><a href="emprestimo-registrar.php" data-toggle="tab">Realizar Empréstimo</a></li>
                    <li><a href="emprestimo-listar.php" data-toggle="tab">Listar Empréstimos</a></li>
                    <li><a href="emprestimo-listar-pendentes.php" data-toggle="tab">Empréstimos Pendentes</a></li>
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <form id="emprestimo-form" class="form-horizontal" method="post" action="emprestimo-registrar.php">
                        <?php $viewEmprestimo->printForm(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        include_once '../../application/view/footer.view.php'; 
        else :
            header("location: emprestimo-usuario.php");
            exit();
        endif;
    endif;
?>