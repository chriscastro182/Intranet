<?php require('topNav.php'); ?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Búsqueda...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="index.php"><i class="fa fa-sticky-note fa-fw"></i> Noticias</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Estadísticas (Próximamente)<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Gráficas</a>
                    </li>
                    <li>
                        <a href="#">Estadísticas</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
             <li>
                <a href="tables.html"><i class="fa fa-rocket fa-fw"></i> Aplicaciones<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="MesaDeAyuda.php"><i class="fa fa-life-ring fa-fw"></i>Mesa de ayuda</a>
                    </li>
                    <li>
                        <a href="abandono.php"><i class="fa fa-money fa-fw"></i>Cálculo de abandono</a>
                    </li>
                    <li>
                        <a href="Digitalizacion.php"><i class="fa fa-file-text fa-fw"></i> Digitalización</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i> Formatos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="descargas/direcotrio-telefonico.xlsx" download="direcotrio-telefonico.xlsx">
                          <i class="fa fa-download fa-fw"></i>Directorio</a>
                    </li>
                    <li>
                        <a href="descargas/fr-cp-requisicic3b3n-de-consumibles-y-papeleria-gsb-rev04.xls" download="fr-cp-requisicic3b3n-de-consumibles-y-papeleria-gsb-rev04.xls">
                          <i class="fa fa-download fa-fw"></i>Papelería</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Servicios<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="http://webmail.alestraune.net.mx/app/" target="_blank">Correo Web</a>
                    </li>
                    <li>
                        <a href="http://10.181.131.97:8081/login.aspx?ReturnUrl=%2f" target="_blank">Control de inventarios</a>
                    </li>
                    <li>
                        <a href="#">Más servicios <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="https://webservice.aaadam.com.mx/Formatos/" target="_blank">Servicio de Gafetes</a>
                            </li>

                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="registro.php">Registro de usuario</a>
                    </li>
                    <li>
                        <a href="login.php">Iniciar Sesión</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
