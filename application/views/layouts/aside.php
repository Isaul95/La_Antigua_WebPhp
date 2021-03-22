
        <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" >
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
<!-- ========= Aqui se reciben los roles =========== -->
            <?php
                $user=null;
                $student=2;
                $admin=1;
                $profesor=3;
                $user= $this->session->userdata("rol");
                // echo $user;
            ?>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
              <li class="header"><strong>OPCIONES DE MENU</strong></li>
              <li>
                  <a href="<?php echo base_url();?>dashboard">
                      <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>



<!-- ROLE ALUMNO ===================== Empieza rol alumno to vistas ===================== -->
<!-- <?php echo $this->session->userdata("username")?> <br>
<?php echo $this->session->userdata("rol")?> -->

 <?php if($user==$student):?>
        <li class="treeview">
               <a href="#">
                   <i class="fas fa-user-graduate"></i>  <span>Alumnos</span>
                   <span class="pull-right-container">
                       <i class="fa fa-angle-left pull-right"></i>
                   </span>
               </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>alumnos/altaBaucherBanco">
                    <i class="fas fa-money-check-alt"></i> Subir Baucher</a>
                 </li>
            </ul>
        </li>
 <?php endif;?>


<!-- ROLE ADMIN ===================== Empieza rol ADMIN to vistas ===================== -->
<?php if($user==1):?>
      <li class="treeview">
            <a href="#">
                <i class="fas fa-balance-scale"></i> <span>Administrativos</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
          <ul class="treeview-menu">

                <li><a href="<?php echo base_url();?>Administrativos/Profesores">
                  <i class="far fa-dot-circle"></i> Profesores </a>
                </li>

                <li><a href="<?php echo base_url();?>Administrativos/Banquetes">
                    <i class="far fa-dot-circle"></i> Banquetes </a>
                </li>

          </ul>
      </li>
<?php endif;?>


<?php if($user==1):?>

      <li class="treeview">
          <a href="#">
              <i class="fas fa-balance-scale"></i> <span>Banquetes</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url();?>Banquetes/Platillos">
                 <i class="far fa-dot-circle"></i>  Platillos</a>
              </li>

              <li><a href="<?php echo base_url();?>Banquetes/Utensilios">
                <i class="far fa-dot-circle"></i>  Utensilios</a>
              </li>
          </ul>
      </li>



      <li class="treeview">
          <a href="#">
              <i class="fas fa-balance-scale"></i> <span>Eventos</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo base_url();?>Eventos/NuevoEvento">
                 <i class="far fa-dot-circle"></i>  Crear Nuevo Evento</a>
              </li>

              <li><a href="<?php echo base_url();?>Eventos/ListaEventos">
                <i class="far fa-dot-circle"></i>  Consultar Eventos</a>
              </li>
          </ul>
      </li>

<?php endif;?>


<!-- ROLE PROFE ===================== Empieza rol PROFE to vistas ===================== -->
<?php if($user==3):?>
      <li class="treeview">
          <a href="#">
              <i class="fas fa-balance-scale"></i> <span>Profesores</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">

              <li><a href="<?php echo base_url();?>Finanzas/HabilitarAlumnos">
                  <i class="far fa-dot-circle"></i> Subir planeación</a>
              </li>

             <li><a href="<?php echo base_url();?>Administrativos/Calificaciones">
              <i class="far fa-dot-circle"></i> Agregar calificaciones</a>
             </li>

          </ul>
      </li>
<?php endif;?>



<?php if($user==1):?>
      <li class="treeview">
          <a href="#">
            <i class="fas fa-user-shield"></i> <span>Administrador</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

        <ul class="treeview-menu">
              <li>
                  <a href="<?php echo base_url();?>administrador/usuarios">
                  <i class="far fa-dot-circle"></i>  Usuarios</a>
              </li>

              <li>
                  <a href="<?php echo base_url();?>administrador/permisos">
                    <i class="far fa-dot-circle"></i>  Permisos</a>
              </li>
        </ul>
    </li>
<?php endif;?>

    <li>
        <a href="<?php echo base_url();?>Platillos/ControlPlatillos">
            <i class="fas fa-drumstick-bite"></i> <span>Platillos</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url();?>Salones/ControlSalones">
            <i class="fas fa-home"></i> <span>Salones</span>
        </a>
    </li>

<!-- ============================== Inicio Modificacion Nacho ======================================== -->
      <!-- Inicio Seccion de Mobiliario -->
      <li>
        <a href="<?php echo base_url();?>Mobiliario/Mobiliario">
        <i class="fas fa-chair"></i> Mobiliario</a>
      </li>
      <!-- Fin Seccion de Mobiliario -->
      <!-- Inicio Seccion de Clientes -->
      <li>
        <a href="<?php echo base_url();?>Clientes/Clientes">
        <i class="fas fa-users"></i> Clientes</a>
      </li>
      <!-- Fin Seccion de Clientes -->



           </ul>
       </section>
   </aside>
