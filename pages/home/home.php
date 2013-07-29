<?php 
    include_once '../../application/model/AbstractEntity.php';
    include_once '../../application/model/Aluno.php';
    include_once '../../application/model/Professor.php';
    include_once '../../application/model/Administrador.php';
    
    include_once '../../application/utils/PermissionValidator.php';
    include_once '../../application/utils/DadosSessao.php';
    
    session_start();
    if (empty($_SESSION["usuario"])):
        header("location: ../login/login.php");
    else :        
        include_once '../../application/view/header.view.php';        
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
                    <li class="user "><img src="../../resource/img/user.jpg" alt=""></li>
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
            <h2>Início</h2>
            <div class="input-prepend pull-right">
                <span class="add-on"><i class="icon-calendar"></i></span>
                <input id="prependedInput" class="text-center" type="text" 
                       placeholder="<?php echo date("l, j-F-Y"); ?>" value="<?php echo date("l, j-F-Y"); ?>">
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="tabbable widget">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Realizar Empréstimo</a></li>
                    <li><a href="#tab2" data-toggle="tab">Listar Empréstimos</a></li>
                    <li><a href="#tab3" data-toggle="tab">Empréstimos Pendentes</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                    </div>
                    <div class="tab-pane" id="tab2">
                        <p>Section 2</p>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <p>Section 3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include_once 'application/view/footer.view.php';
    endif;
?>