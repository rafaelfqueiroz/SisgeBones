<?php 

    include_once '../../application/controller/Controller.php';
    include_once '../../application/controller/CrudController.php';
    include_once '../../application/view/AbstractView.php';
    
    include_once '../../application/persistence/abstracao/Dao.php';
    include_once '../../application/persistence/abstracao/Persistencia.php';
    include_once '../../application/persistence/interfaces/AdministradorDao.php';
    include_once '../../application/persistence/interfaces/UsuarioDao.php';
    
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/model/Administrador.php';
    
    include_once '../../application/model/Usuario.php';
    include_once '../../application/controller/ControllerUsuario.php';
    include_once '../../application/persistence/implementacoes/PersistenceUsuario.php';
    
    include_once '../../application/view/ViewUsuario.php';
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/utils/DadosSessao.php';
    include_once '../../application/utils/CurrentDate.php';
    include_once '../../application/utils/Validator.php';
    
    session_start();
    if (empty($_SESSION["usuario"])):
        header("location: ../login/index.php");
    else :      
        include_once '../../application/view/header.view.php';
        $viewUsuario = new ViewUsuario();
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
                </ul>
                
                <ul class="profileBar">
                    <li class="user "><img src="../../resource/img/user_avatar.png" alt=""></li>
                    <li class="profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="perfil.php"><?php echo DadosSessao::getDadosSessao()->getNome(); ?></a>
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
        <li class="active">
            <a href="home.php">Início</a>
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
        <?php if(PermissionValidator::isAdministrador()) : ?>
            <li>
                <a href="../osso/osso-cadastrar-novo.php">Osso</a>
            </li>
        <?php else : ?>
            <li>
                <a href="../osso/osso-listar.php">Osso</a>
            </li>
        <?php endif; ?>
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
            <h2>Perfil</h2>
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
                    <li class="active"><a href="#tab1" data-toggle="tab">Perfil de usuário</a></li>                    
                </ul>
                <div class="tab-content">
                    <?php Validator::showError(); ?>
                    <form class="form-horizontal" method="post" action="perfil.php">
                        <?php $viewUsuario->printForm(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
        include_once '../../application/view/footer.view.php';
    endif;
?>