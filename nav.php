<?php require('topNav.php'); ?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <!-- <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Búsqueda...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </li> -->
            <li>
                <a href="index.php"><i class="fa fa-sticky-note fa-fw"></i> Noticias</a>
            </li>
            <?php
            if (!isset($_SESSION)) {
              session_start();
            }
             if(isset($_SESSION['Rol_idRol'])) {
               if(($_SESSION['Rol_idRol'])==2) { ?>
                 <li>
                     <a href="#"><i class="fa fa-desktop fa-fw"></i> Recursos H.<span class="fas fa-angle-right  pull-right  pull-right"></span></a>
                     <ul class="nav nav-second-level">

                         <li>
                             <a href="#"><i class="fa fa-birthday-cake fa-fw"></i>Cumpleaños</a>

                         </li>
                         <li>
                             <a  href="nuevoPost.php"><i class="fa fa-sticky-note fa-fw"></i> Nuevo Aviso </a>
                         </li>
                     </ul>
                 </li>

            <?php
            }
          } ?>

            <?php
            if (!isset($_SESSION)) {
              session_start();
            }
             if(isset($_SESSION['Rol_idRol'])) {
               if(($_SESSION['Rol_idRol'])==1) { ?>
                 <li>
                     <a href="#"><i class="fa fa-desktop fa-fw"></i> TI<span class="fas fa-angle-right  pull-right"></span></a>
                     <ul class="nav nav-second-level">
                         <li>
                             <a href="https://trello.com/b/CUOZ15r6/actividades" target="_blank"><i class="fa fa-trello fa-fw"></i>Trello </a>
                         </li>
                         <li>
                             <a href="MesaTI.php">Mesa de TI</a>
                         </li>
                         <li>
                             <a href="ticketsTi.php">Tickets Pendientes</a>
                         </li>
                         <li>
                             <a  href="nuevoPost.php"><i class="fa fa-sticky-note fa-fw"></i> Nuevo Aviso </a>
                         </li>
                     </ul>
                 </li>
              <li>
                  <a  href="nuevoPost.php"><i class="fa fa-sticky-note fa-fw"></i> Nuevo Post </a>
              </li>
            <?php
            }
          } ?>

            <li>
                <a href="#"><i class="fas fa-chart-line fa-fw"></i> Estadísticas (Próximamente)<span class="fas fa-angle-right  pull-right"></span></a>
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
                <a href="tables.html"><i class="fa fa-rocket fa-fw"></i> Aplicaciones<span class="fas fa-angle-right  pull-right"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="MesaDeAyuda.php"><i class="fa fa-life-ring fa-fw"></i>Mesa de ayuda</a>
                    </li>
                    <li>
                        <a href="abandono.php"><i class="fa fa-money fa-fw"></i>Cálculo de abandono</a>
                    </li>
                    <li>
                        <a href="menuDigitalizacion.php"><i class="fa fa-file-text fa-fw"></i> Digitalización</a>
                    </li>
                </ul>
            </li>
            <!-- Sevicios -->

            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Servicios<span class="fas fa-angle-right  pull-right"></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="http://10.181.131.97:8081/login.aspx?ReturnUrl=%2f" target="_blank"><i class="fas fa-list-ul"></i> Control de inventarios</i></a>
                    </li>
                    <li>
                        <a href="https://webservice.aaadam.com.mx/Formatos/" target="_blank"><i class="far fa-user-circle"></i> Servicio de Gafetes</a>
                    </li>
                    <li>
                        <a href="https://go.reachcore.com/portal" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"> Consulta de Facturas</i></a>
                    </li>
                    <li>
                      <a href="descargas/mesadeserviciosat.pdf" download="mesadeserviciosat.pdf">
                        <i class="fa fa-download fa-fw"></i>Mesa de servicios SAT</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope" aria-hidden="true"> Correos </i>
                          <span class="fas fa-angle-right  pull-right"></span></a>
                        <ul class="nav nav-third-level">
                          <li>
                              <a href="https://login.microsoftonline.com/" target="_blank">Correo Braniff</a>
                          </li>
                          <li>
                              <a href="https://login.microsoftonline.com/" target="_blank">Correo Interpuerto</a>
                          </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-file-pdf-o"> Reglas Generales C.E. 2018</i>
                          <span class="fas fa-angle-right  pull-right"></span></a>
                        <ul class="nav nav-third-level">
                          <li>
                            <a href="descargas/ReglasDeComercio/RGCE - DOF 2018.pdf" download="RGCE - DOF 2018.pdf">
                              <i class="fa fa-download fa-fw"></i>RGCE-DOF</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 1_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 1</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 2_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 2</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 3_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 3</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 4_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 4</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 5_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 5</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 6_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 6</a>
                          </li>
                          <li>
                            <a href="descargas/ReglasDeComercio/ANEXO 7_REGLAS Generales de Comercio Exterior para 2018..pdf" download="Anexo1.pdf">
                              <i class="fa fa-download fa-fw"></i>Anexo 7</a>
                          </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>

                <!-- /.nav-second-level -->
            </li>

            <!-- Procesos -->

            <li>
                <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Procesos<span class="fas fa-angle-right  pull-right"></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="#">TI <span class="fas fa-angle-right  pull-right"></span></a>
                        <ul class="nav nav-third-level">
                          <li>
                              <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>Comunicaciones</a>
                          </li>
                          <li>
                              <a href="#"><i class="fa fa-users" aria-hidden="true"></i>Soporte Usuarios</a>
                          </li>
                          <li>
                              <a href="#"><i class="fa fa-share-square-o" aria-hidden="true"></i>Backups</a>
                          </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i> Formatos<span class="fas fa-angle-right  pull-right"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                      <a href="descargas/Solicitud de pago.xls" download="Solicitud de pago.xls">
                        <i class="fa fa-download fa-fw"></i>Solicitud de pago</a>
                  </li>
                    <li>
                        <a href="descargas/direcotrio-telefonicoIMM.pdf" download="direcotrio-telefonicoIMM.pdf">
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
                <a href="#"><i class="fa fa-microchip" aria-hidden="true"></i> Manuales<span class="fas fa-angle-right  pull-right"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                      <a href="Manuales/DGR 2017/Live Animals Regulations 2017 43rd Ed.pdf" download="Live Animals Regulations 2017 43rd Ed.pdf">
                        <i class="fa fa-download fa-fw"></i>Live Animals Regulations 2017</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2017/Perishable Cargo Regulations 2017 16th Ed.pdf" download="Perishable Cargo Regulations 2017 16th Ed.pdf">
                        <i class="fa fa-download fa-fw"></i>Perishable Cargo Regulations 2017</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2017/Temperature Controls Regulations 2017 5th Ed.pdf" download="Temperature Controls Regulations 2017 5th Ed.pdf">
                        <i class="fa fa-download fa-fw"></i>Temperature Controls Regulations2017</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2017/The Air Cargo Tariff Manual North America Rates.pdf" download="The Air Cargo Tariff Manual North America Rates">
                        <i class="fa fa-download fa-fw"></i>The Air Cargo Tariff Manual North America Rates 2017</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2018/Live  Animals Regulations 2018 44th Ed.pdf" download="Live  Animals Regulations 2018 44th Ed.PDF">
                        <i class="fa fa-download fa-fw"></i>Live  Animals Regulations 2018 44th Ed</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2018/Dangerous Good Regulations 2018 59th Ed.pdf" download="Dangerous Good Regulations 2018 59th Ed.PDF">
                        <i class="fa fa-download fa-fw"></i>Dangerous Good Regulations 2018 59th Ed</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2018/Perishable Cargo Regulations 2018 17th Ed.pdf" download="Perishable Cargo Regulations 2018 17th Ed.PDF">
                        <i class="fa fa-download fa-fw"></i>Perishable Cargo Regulations 2018 17th Ed</a>
                  </li>
                  <li>
                      <a href="Manuales/DGR 2018/Temperature Control Regulations 2018 6th Ed.pdf" download="Temperature Control Regulations 2018 6th Ed.PDF">
                        <i class="fa fa-download fa-fw"></i>Temperature Control Regulations 2018 6th Ed</a>
                  </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Usuarios<span class="fas fa-angle-right  pull-right"></span></a>
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
            <li>
              <a href="#"><i class="fa fa-users fa-fw"></i> Redes sociales<span class="fas fa-angle-right  pull-right"></span></a>
                <ul class="nav nav-second-level">
                  <a href="https://www.facebook.com/InterpuertoMMx/" target="_blank">
                      <div class="panel-footer">
                          <i class="fa fa-facebook-official fa-fw"></i>
                          <span class="pull-left">Facebook</span>
                          <div class="clearfix"></div>
                      </div>
                    <a href="https://twitter.com/interpuerto" target="_blank">
                      <div class="panel-footer">
                          <i class="fa fa-twitter fa-fw"></i>
                          <span class="pull-left">Twitter</span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
