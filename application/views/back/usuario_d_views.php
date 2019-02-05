
<div class="col-sm-10 col-md-10 container mt-3 bg-warning">
	<div class="well">
		<h1>Usuarios eliminados</h1>
	</div>
	<table class="table table-bordered ">
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Activar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($usuario->result() as $row) {?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->nombre; ?></td>
				<td><?php echo $row->apellido; ?></td>
				<td><a href="<?php echo base_url("activar_usuario/$row->id"); ?>">Activar</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div>

	</div>
</div>
</div>
</div>