<nav class="navbar navbar-expand-lg navbar-light" style=" background-image: url('assets/img/maderitaa.jpg');">
    <a class="navbar-brand" href="camping">CampingPanambi</a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
         </button>
<!--MENU PARA ADMINISTADORES -->
<?php if (($this->session->userdata('logged_in')) and ($perfil == '1')) {?>
               <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a size=7 class="nav-link" href="<?php echo base_url('alta_producto'); ?>">Alta Alquiler</a>
                  </li>
                  <li class="nav-item">
                     <a size=3 class="nav-link" href="ver_consultas">Consultas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('productos_todos'); ?>">Alquileres</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('listado_ventas'); ?>">Reservados</a>
                  </li>

              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span></a>
           <div class="dropdown-menu">
                 <a class="dropdown-item" href="<?php echo base_url('usuarios_todos'); ?>">Activos</a>
                 <a class="dropdown-item" href="<?php echo base_url('usuario_disabled'); ?>">Eliminados</a>
           </div>
              </li>
        </ul>
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Bienvenido <?=$nombre?><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Salir</a>
                    </div>
          </li>
          </ul>
        </div>
<!--MENU PARA CLIENTES -->
<?php } else if (($this->session->userdata('logged_in')) and ($perfil == '0')) {?>
<div class="collapse navbar-collapse" id="navbarText">
  <ul class="nav navbar-nav mr-auto">

                  <li class="nav-item">
                     <a class="nav-link" href="consultas">Consultas</a>
                  </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('carrito'); ?>">Reservas</a>
        </li>

        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Mi Perfil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="<?php echo base_url('recibo'); ?>">Mis Reservas</a>
                    </div>
        </li>

</ul>
<ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Bienvenido <?=$nombre?><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Salir</a>
                    </div>
        </li>
      </ul>
    </div>

<!--MENU PARA PUBLICO -->
<?php } else {?>
      <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">


<li class="nav-item">
                     <a class="nav-link" href="consultas">Consultas</a>
                  </li>
        <li class="nav-item">

        <a class="nav-link" href="registro">Reservas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ubicacion">Ubicación</a>
      </li>
      </ul>
        <ul class="nav navbar-nav">
        <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('login'); ?>">Ingresar</a>
                </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('registro'); ?>">Registrarse</a>
        </li>

<?php }?>

    </div>
  </div>
</nav>


