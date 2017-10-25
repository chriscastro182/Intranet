<?php if(!isset($_SESSION))
    {
        session_start();
    }  ?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">
          <img src="images/IMMlogo.png" class="img-thumbnail" width="20%" alt="Interpuerto Multimodal de México">
        </a>
    </div>
    <ul class="nav navbar-top-links navbar-left">
      <h3>Intranet Corporativa</h3>
    </ul>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">


        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li>
                    <a href="http://webmail.alestraune.net.mx/app/" target="_blank">
                        <div>
                            <strong>Braniff</strong>
                            <span class="pull-right text-muted">
                                <em>Correo Web</em>
                            </span>
                        </div>
                        <div>Elige esta opción si buscas iniciar sesión en tu cuenta @braniff.com</div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="https://login.microsoftonline.com/" target="_blank">
                        <div>
                            <strong>Interpuerto</strong>
                            <span class="pull-right text-muted">
                                <em>Correo Institucional</em>
                            </span>
                        </div>
                        <div>Elige esta opción si buscas iniciar sesión en tu cuenta @interpuerto.com</div>
                    </a>
                </li>
                <!-- <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li> -->
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <!-- <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-tasks">
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 1</strong>
                                <span class="pull-right text-muted">40% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 2</strong>
                                <span class="pull-right text-muted">20% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 3</strong>
                                <span class="pull-right text-muted">60% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                    <span class="sr-only">60% Complete (warning)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 4</strong>
                                <span class="pull-right text-muted">80% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Tasks</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </li> -->
        <!-- /.dropdown -->
        <!-- <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>

        </li> -->
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <?php if(isset($_SESSION['Rol_idRol'])){
                                echo '<li><a href="#"><i class="fa fa-address-card-o fa-fw"></i>'.$_SESSION['u_nombre'].'</a></li>';
                                echo '<li><a href="editPerfil.php"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                                </li>';
                                echo '<li class="divider"></li>';
                                echo ' <li><a href="cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>';
                        }else{
                                echo '<li><a href="login.php"><i class="fa fa-user fa-fw"></i> Iniciar sesión</a>
                                </li>';
                                echo '<li class="divider"></li>';
                                echo '<li><a href="registro.php"><i class="fa fa-user-plus fa-fw"></i> Regístrate</a>
                                </li>';
                            }?>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
