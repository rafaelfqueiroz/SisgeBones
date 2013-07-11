<?php 
    include_once 'application/view/header.view.php';
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
        <li class="active">
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
            <h2>Dashboard</h2>
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
                    <li class="active"><a href="#tab1" data-toggle="tab">Realizar Empréstimo</a></li>
                    <li><a href="#tab2" data-toggle="tab">Listar Empréstimos</a></li>
                    <li><a href="#tab3" data-toggle="tab">Empréstimos Pendentes</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="btn-group pull-right mrg-btm10" data-toggle="buttons-radio">
                            <button class="btn active">Day</button>
                            <button class="btn">Month</button>
                            <button class="btn">Year</button>
                        </div>
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
<?php include_once 'application/view/footer.view.php'; ?>