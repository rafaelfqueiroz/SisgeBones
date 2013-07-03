<?php 
    include_once 'application/view/header.view.php';
?>

<div id="navbar">
    <div id="navbarconteiner">
        <a id="logo" href="#">SisgeBones</a>
        <ul class="mappath visible-desktop">
            <li class="homepath">
                <a href="#"><img src="resource/img/icon-home.gif"></a>
                <span class="divider"></span>
            </li>
            <li></li>
            <li><a href="#">Sample 1 ></a></li>
            <li><a href="#">Sample 2</a></li>
        </ul>
        
        <ul class="profilebar">
            <li><img src="resource/img/default-user.png"></li>
            <li class="profile">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Rafael <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a tabindex="-1" href="#">Action</a></li>
                        <li><a tabindex="-1" href="#">Another action</a></li>
                        <li><a tabindex="-1" href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="#">Separated link</a></li>
                    </ul>
            </li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
<div id="sideleftbar">
    <ul id="sideleftmenu">
        <li><a>Dashboard</a></li>
        <li><a>Professores</a></li>
        <li><a>Alunos</a></li>
        <li><a>Emprestimo</a></li>
        <li><a>Administradores</a></li>
    </ul>
</div>