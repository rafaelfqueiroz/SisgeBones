<?php 
    include_once 'application/view/header.view.php';
    include_once 'application/config.php';
    
    include_once 'application/controller/Controller.php';
    include_once 'application/controller/CrudController.php';
    include_once 'application/model/AbstractEntity.php';
    include_once 'application/view/AbstractView.php';
        
    include_once 'application/persistence/abstracao/Dao.php';
    include_once 'application/persistence/abstracao/Persistencia.php';
    include_once 'application/persistence/interfaces/AlunoDao.php';
    
    include_once 'application/model/Aluno.php';
    include_once 'application/controller/ControllerAluno.php';    
    include_once 'application/persistence/implementacoes/PersistenceAluno.php';
    include_once 'application/view/ViewAluno.php';
    
    $viewAluno = new ViewAluno();
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
                    <li class="home"><a href="index.php"></a><span class="divider"></span></li>              
                    <li class="active">Página de alunos</li>
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
        <li>
            <a href="emprestimo.php">Empréstimo</a>            
        </li>
        <li>
            <a href="osso.php">Osso</a>
        </li>
        <li>
            <a href="professor.php">Professor</a>
        </li>
        <li class="active">
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
                    <li class="active"><a href="#cadastrar" data-toggle="tab">Cadastrar Aluno</a></li>
                    <li><a href="#listar-alunos" data-toggle="tab">Listar Alunos</a></li>
                    <li><a href="#listar-monitores" data-toggle="tab">Listar Monitores</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="cadastrar">
                        <form class="form-horizontal" method="post">
                            <?php $viewAluno->printForm(); ?>
                        </form>
                    </div>
                    <div class="tab-pane" id="listar-alunos">
                        <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
                                <thead>
                                        <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 167px;">Rendering engine</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 232px;">Browser</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 214px;">Platform(s)</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 142px;">Engine version</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">CSS grade</th></tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <tr class="gradeA odd">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Firefox 1.0</td>
                                        <td class=" ">Win 98+ / OSX.2+</td>
                                        <td class="center ">1.7</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA even">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Firefox 1.5</td>
                                        <td class=" ">Win 98+ / OSX.2+</td>
                                        <td class="center ">1.8</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA odd">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Firefox 2.0</td>
                                        <td class=" ">Win 98+ / OSX.2+</td>
                                        <td class="center ">1.8</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA even">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Firefox 3.0</td>
                                        <td class=" ">Win 2k+ / OSX.3+</td>
                                        <td class="center ">1.9</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA odd">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Camino 1.0</td>
                                        <td class=" ">OSX.2+</td>
                                        <td class="center ">1.8</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA even">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Camino 1.5</td>
                                        <td class=" ">OSX.3+</td>
                                        <td class="center ">1.8</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA odd">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Netscape 7.2</td>
                                        <td class=" ">Win 95+ / Mac OS 8.6-9.2</td>
                                        <td class="center ">1.7</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA even">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Netscape Browser 8</td>
                                        <td class=" ">Win 98SE+</td>
                                        <td class="center ">1.7</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA odd">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Netscape Navigator 9</td>
                                        <td class=" ">Win 98+ / OSX.2+</td>
                                        <td class="center ">1.8</td>
                                        <td class="center ">A</td>
                                    </tr>
                                    <tr class="gradeA even">
                                        <td class="  sorting_1">Gecko</td>
                                        <td class=" ">Mozilla 1.0</td>
                                        <td class=" ">Win 95+ / OSX.1+</td>
                                        <td class="center ">1</td>
                                        <td class="center ">A</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="listar-monitores">
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
        $aluno = new Aluno();
        $aluno->nome = $_POST['nome'];
        $aluno->matricula = $_POST['matricula'];
        $aluno->curso = $_POST['curso'];
        $aluno->email = $_POST['email'];
        $aluno->eMonitor = $_POST['eMonitor'];
        $usuario = new Usuario();
        $usuario->login = $_POST['login'];        
        $usuario->senha = $_POST['senha'];
        $usuario->tipo = 4;
        
        $aluno->usuario = $usuario;
        
        $alunoController = new ControllerAluno();
        $alunoController->salvar($aluno);
    } 
?>