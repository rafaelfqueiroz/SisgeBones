
<?php 
    
    include_once '../../application/config.php';
    include_once '../../application/utils/PermissionValidator.php';
    
    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/view/AbstractView.php';
        
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    include_once '../../application/persistence/interfaces/EmprestimoDao.php';
    
    include_once '../../application/model/Administrador.php';
    include_once '../../application/model/Emprestimo.php';
    include_once '../../application/controller/ControllerEmprestimo.php';    
    include_once '../../application/persistence/implementacoes/PersistenceEmprestimo.php';
    include_once '../../application/view/ViewEmprestimo.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    
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
        if (!PermissionValidator::isAdministrador()) :
            include_once '../../application/view/header.view.php';
            $viewEmprestimo = new ViewEmprestimo();
?>
<style rel="stylesheet" type="text/css">
    .row {
        margin-left: 0px;
    }
/*    tr.gradeA, tr.odd, tr.even {
        background-color:#e4e4e4 !important;
    }*/
    .table tbody tr td{
        border-top:none;        
    }
    tr.odd {
        background-color: #f9f9f9;
    }
    tr.odd.pendente, tr.even.pendente {
        background-color: #fff0f0;
    }
    
    tr.odd.pendente td, tr.even.pendente td {
        border-bottom: 1px solid #FFCBCB;
    }
    
    tr.gradeA:hover, tr.odd:hover, tr.even:hover {
        background-color:#e4e4e4 !important;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function(){
        $('#example tbody tr').click(function() {
            var url = $(this).data('href');
            window.location.href = url;
        });
    });
</script>
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
            <a href="../emprestimo/emprestimo-usuario.php">Empréstimo</a>            
        </li>
        <li>
            <a href="../osso/osso-listar.php">Osso</a>
        </li>
        <li>
            <a href="../professor/professor-listar.php">Professor</a>
        </li>
        <li>
            <a href="../aluno/aluno-listar.php">Aluno</a>
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
                    <li class="active"><a href="emprestimo-usuario.php" data-toggle="tab">Meus empréstimos</a></li>                    
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <?php $viewEmprestimo->printListaEmprestimosUsuario(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
            include_once '../../application/view/footer.view.php';    
        else :
            header("location: emprestimo-listar.php");
            exit();
        endif;
    endif;
?>