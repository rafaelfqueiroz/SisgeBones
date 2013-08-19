<?php    
    include_once 'application/config.php';    
    
    include_once 'application/controller/Controller.php';
    include_once 'application/controller/CrudController.php';
    include_once 'application/model/AbstractEntity.php';
        
    include_once 'application/persistence/abstracao/Dao.php';
    include_once 'application/persistence/abstracao/Persistencia.php';

    include_once 'application/persistence/interfaces/UsuarioDao.php';
    include_once 'application/model/Usuario.php';
    include_once 'application/controller/ControllerUsuario.php';
    include_once 'application/persistence/implementacoes/PersistenceUsuario.php';
    
    include_once 'application/model/Administrador.php';
    include_once 'application/controller/ControllerAdministrador.php';
    include_once 'application/persistence/interfaces/AdministradorDao.php';
    include_once 'application/persistence/implementacoes/PersistenceAdministrador.php';
    
    include_once 'application/model/Aluno.php';
    include_once 'application/controller/ControllerAluno.php';
    include_once 'application/persistence/interfaces/AlunoDao.php';
    include_once 'application/persistence/implementacoes/PersistenceAluno.php';
    
    include_once 'application/model/Professor.php';
    include_once 'application/controller/ControllerProfessor.php';
    include_once 'application/persistence/interfaces/ProfessorDao.php';
    include_once 'application/persistence/implementacoes/PersistenceProfessor.php';
    include_once 'application/utils/PermissionValidator.php';
    include_once 'application/utils/Validator.php';
    
    session_start();
    
    if (@$_POST['source'] == "login") {        
        $usuarioController = new ControllerUsuario();
        $usuario = $usuarioController->encontrarPorLoginESenha(@$_POST["login"], @$_POST["senha"]);
        if ($usuario != NULL) {
            session_start();            
            if ($usuario->getTipo() == 1) { //administrador
                $adminController = new ControllerAdministrador();                
                $admin = $adminController->encontrarAdministradorPorIdUsuario($usuario->getId());
                $_SESSION["sUsuario"] = $admin;       
            } else if ($usuario->getTipo() == 2) { //professor                
                $professorController = new ControllerProfessor();
                $professor = $professorController->encontrarProfessorPorIdUsuario($usuario->getId());
                $_SESSION["sUsuario"] = $professor;
            } else if ($usuario->getTipo() == 3) { //aluno
                $alunoController = new ControllerAluno();
                $aluno = $alunoController->encontrarAlunoPorIdUsuario($usuario->getId());
                $_SESSION["sUsuario"] = $aluno;
                if ($aluno->getAtivo() == 0) {
                    header("location: pages/home/perfil.php");
                    die();
                }
            } 
            header('location: pages/home/home.php');
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sisgebones</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="resource/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="resource/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/theme.css">
    <link rel="stylesheet" type="text/css" href="resource/css/font-awesome.css">
    <script src="resource/js/jquery/jquery-latest.js" type="text/javascript"></script>
    <script src="resource/js/sisgebones/sisgebones_validation.js"></script>
    
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <link rel="shortcut icon" href="http://wbpreview.com/previews/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.html">
  </head>
  <body> 
    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" style="float:none;text-align:center;"href="index.php"><span class="second">Sistema de Gerenciamento de Ossos do Departamento de Morfologia</span><span class="second"></span></a>
            </div>
        </div>
    </div>
    

    <div class="container-fluid">
        
        <div class="row-fluid">
<!--                <img src="resource/img/logo_cinza.jpg" alt="">-->
            <div style="text-align:center;">
                    <img src="resource/img/logo.png" alt="">
            </div>
    <div class="dialog span4">
        <div class="block">
            <div class="block-heading">Sign In</div>
            <div class="block-body">
                <form method="post" action="index.php">
                    <label>Login</label>
                    <input type="text" name="login" class="span12">
                    <label>Senha</label>
                    <input type="password" name="senha" class="span12">
                    <input type="hidden" name="source" value="login">
                    <input type="submit" class="btn btn-primary pull-right" value="Entrar">
<!--                    <p><a href="#">Esqueceu sua senha?</a></p>-->
                    <div class="clearfix"></div>
                </form>
            </div>
            <?php Validator::showError(); ?>
        </div>
        
    </div>
                
</div>
    <script src="resource/js/bootstrap/bootstrap.js"></script>
    
  </body>
</html>


