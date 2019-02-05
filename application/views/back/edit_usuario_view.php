<div class="container text-center bg-warning mt-3">

    <div class="form-group col-md-6 ">

      <?php echo form_open("user_up/$id", ['class' => 'form-signin', 'role' => 'form']); ?>

 </div>
 <div class="form-group">
    <?php echo form_error('email'); ?>
    <?php echo form_label('Email:', 'email'); ?>
    <?php echo form_input(['name' => 'email',
    'id'                              => 'email',
    'class'                           => 'form-control',
    'placeholder'                     => 'Ingrese email',
    'value'                           => "$email"]); ?>
  </div>
 <div class="form-group">
    <?php echo form_error('nombre'); ?>
    <?php echo form_label('Nombre:', 'nombre'); ?>
    <?php echo form_input(['name' => 'nombre',
    'id'                              => 'nombre',
    'class'                           => 'form-control',
    'placeholder'                     => 'Ingrese nombre',
    'type'                            => 'text',
    'value'                           => "$nombre"]); ?>
  </div>
  <div class="form-group">
    <?php echo form_error('apellido'); ?>
    <?php echo form_label('Apellido:', 'apellido'); ?>
    <?php echo form_input(['name' => 'apellido',
    'id'                              => 'apellido',
    'class'                           => 'form-control',
    'placeholder'                     => 'Ingrese apellido',
    'type'                            => 'text',
    'value'                           => "$apellido"]); ?>
  </div>
  <div class="form-group">
    <?php echo form_error('telefono'); ?>
    <?php echo form_label('Teléfono:', 'telefono'); ?>
    <?php echo form_input(['name' => 'telefono',
    'id'                              => 'telefono',
    'class'                           => 'form-control',
    'placeholder'                     => 'Ingrese telefono',
    'type'                            => 'text',
    'value'                           => "$telefono"]); ?>
  </div>

  <div class="form-group">
    <?php echo form_error('ciudad'); ?>
    <?php echo form_label('Ciudad', 'ciudad'); ?>
    <?php echo form_input(['name' => 'ciudad',
    'id'                              => 'Ciudad',
    'class'                           => 'form-control',
    'placeholder'                     => 'Ciudad',
    'type'                            => 'text',
    'value'                           => "$ciudad"]); ?>
              </div>
    <div class="form-group">
    <?php echo form_error('pais'); ?>
    <?php echo form_label('Pais:', 'pais'); ?>
    <?php echo form_input(['name' => 'pais',
    'id'                              => 'pais',
    'class'                           => 'form-control',
    'placeholder'                     => 'Pais',
    'type'                            => 'text',
    'value'                           => "$pais"]); ?>
  </div>

 <div class="form-group">
    <?php echo form_error('password'); ?>
    <?php echo form_label('Ingrese contraseña:', 'password'); ?>
    <?php echo form_input(['type' => 'text',
    'name'                            => 'password',
    'id'                              => 'password',
    'class'                           => 'form-control',
    'placeholder'                     => 'contraseña',
    'type'                            => 'password',
    'value'                           => "$password"]); ?>
  </div>

    <?php echo form_submit('submit', 'Guardar cambios', "class='btn btn-lg btn-success btn-block'"); ?>
  <?php echo form_close(); ?><br>
  </div>



