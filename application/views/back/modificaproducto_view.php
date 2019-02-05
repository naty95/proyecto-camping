
<div class="container">
<div class="col-sm-10 col-md-10">
	<div class="well">
		<h1>Modificar Datos</h1>
		<h6> <b>Acepta imagenes gif, jpg, jpeg, png</b></h6>
		<h6> <b>Tamaño maximo de la imagen 2MB</b></h6>
	</div>

	<?php echo form_open_multipart("verifico_modificaproducto/$id", ['class' => 'form-signin', 'role' => 'form']); ?>
		<div class="row">
	   		<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Descripcion:', 'descripcion'); ?>
					<?php echo form_input(['name' => 'descripcion',
    'id'                               => 'descripcion',
    'class'                            => 'form-control',
    'placeholder'                      => 'Descripcion',
    'autofocus'                        => 'autofocus',
    'value'                            => "$descripcion"]); ?>
					<?php echo form_error('descripcion'); ?>
				</div>
			</div>

		</div>
		<div class="row">
	   		<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Precio:', 'precio'); ?>
					<?php echo form_input(['name' => 'precio',
    'id'                               => 'precio',
    'class'                            => 'form-control',
    'placeholder'                      => 'Precio',
    'value'                            => "$precio"]); ?>
					<?php echo form_error('precio'); ?>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Imagen actual:', 'img_ac'); ?>
					<img  id="imagen_view" name="imagen_view" class="img-thumbnail" src="<?php echo base_url($imagen); ?>" >
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo form_label('Imagen:', 'imagen'); ?>
					<?php echo form_input(['type' => 'file',
    'name'                             => 'filename',
    'id'                               => 'filename',
    'class'                            => 'form-control']); ?>
					<?php echo form_error('filename'); ?>
					<br>
					<?php echo form_submit('modificar', 'Modificar', "class='btn btn-lg btn-warning btn-block'"); ?>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
	<div>

	</div>
</div>
</div>
