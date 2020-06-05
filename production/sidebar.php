<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--- h3>General</h3 --->
                <ul class="nav side-menu">
<li><a href="main.php"><i class="fa fa-home"></i>Head Count</a></li>
<li><a href="dashboard.php"><i class="fa fa-calculator"></i>Head Count Personal</a></li><!--- upd usuarios --->
<li><a href="periodo_consulta.php"><i class="fa fa-institution"></i>Nóminas</a></li>
<!--- li><a href="tusuario.php"><i class="fa fa-child"></i>Usuarios</a></li --->  
<!--- li><a href="tusuarioAsistencia.php"><i class="fa fa-check"></i>Asistencia</a></li --->  

<?php ?>
                </ul>                       
              </div>
            </div>
<!-- /sidebar menu -->
<!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="../action/logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
<!-- /menu footer buttons -->

          </div>
        </div>

<!-- top navigation -->
     
    <div class="top_nav small">
        <div class="nav_menu small">
        <nav>

  
<!--- toggle --->              
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
<!--- /toggle --->  
<!--- iconos de la derecha --->
              <ul class="nav navbar-nav navbar-right">
<!--- nombre --->                
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $us_tt_promo_nombre ;?> <?php echo $us_tt_promo_apellido1 ;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Perfil</a></li>
                    <li><a href="javascript:;"> Editar usuarios</a></li>
                    <li><a href="javascript:;"> Ayuda</a></li>
                  </ul>
                </li>
<!--- /nombre --->
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

  <table>

    <tbody>
      <?php 
      $sql_alertas = "SELECT TOP 4 * FROM tareasPromo WHERE usuarioPromo=$idPromo" ;
      $alertasTablaUs = sqlsrv_query($conn, $sql_alertas) or die("database error:". sqlsrv_error($conn));
      while( $alertasUs = sqlsrv_fetch_array($alertasTablaUs) ) {

$asignoTarea=$alertasUs['asignoTarea'];



$sql_usuariosProm = sqlsrv_query($conn, "select * from usuaripsPromo WHERE idPromo='$asignoTarea' ");
                            if($c=sqlsrv_fetch_array($sql_usuariosProm)) {
                                $nombre_asigno_tarea=$c['nombre'];
                            }        
      ?>
    <tr>
         
                    <li>
                      <a>
                        <span>
                          <span><?php echo $nombre_asigno_tarea; ?></span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          <?php echo utf8_encode($alertasUs['tareaTitulo']); ?>
                        </span>
                        <span class="message">
                          <?php echo utf8_encode($alertasUs['tareaContenido']); ?>
                        </span>
                      </a>
                    </li>
         


    </tr>
      <?php } ?>
    </tbody>
    </table>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>Mas Notificaciones</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
<!--- /iconos de la derecha --->

        </nav>
        </div> 
    </div> 
<!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
      
    

