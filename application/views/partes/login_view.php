

  <div
  class="container-fluid col-sm-10 mt-3" style="background-image: url('assets/img/hojas.jpg'); width: 100%; height:100%; background-position:fixed; background-color: transparent;">
 <div class="row">

        <h1  class="container bg-light mt-2 text-center col-sm-5 mx-auto login-title">Inicie sesión para continuar</h1>
</div>
        <?php echo validation_errors(); ?>

        <!-- Genera un formulario para loguearse -->
<div class="row ">
<div class="mx-auto mt-3 col-sm-5" style="width: 200px">
          <div class="form-group text-center">


             <?php echo form_open('verifico_usuario', ['class' => 'form-signin', 'role' => 'form']); ?> <br>

              <?php echo form_input(['name' => 'email',
    'id'                                        => 'email',
    'class'                                     => 'form-control',
    'placeholder'                               => 'Email',
    'required'                                  => 'required',
    'autofocus'                                 => 'autofocus']); ?>

    <br>

              <?php echo form_input(['type' => 'password',
    'name'                                      => 'password',
    'id'                                        => 'password',
    'class'                                     => 'form-control',
    'placeholder'                               => 'Contraseña',
    'required'                                  => 'required']); ?> <br>

              <?php echo form_submit('submit', 'Iniciar', "class='btn btn-lg btn-primary btn-block'"); ?> <br>

              <?php echo form_close(); ?>

            </div>

          </div>
</div>
      </div>
     </div>
