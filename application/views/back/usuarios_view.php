
<div class="col-sm-10 col-md-10 mt-3 bg-warning">
	<div class="well">
		<h1>Todos los Usuarios</h1>
	</div>
	<a type="button" class="btn btn-success" href="<?php echo base_url('insert'); ?>">Agregar</a>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>email</th>
				<th>Editar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($usuario->result() as $row) {?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->nombre; ?></td>
				<td><?php echo $row->apellido; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><a href="<?php echo base_url("user_edit/$row->id"); ?>">Editar</a><a href="<?php echo base_url("remove_usuario/$row->id"); ?>"><?php if ($row->perfil == 0) {echo "|Eliminar";}?></a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div>

	</div>
</div>
</div>
</div>
