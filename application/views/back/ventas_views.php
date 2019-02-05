
<div class=" container mt-5 text-center col-sm-10 col-md-10 bg-warning">
	<div class="well">
		<h1>Todas las reservas</h1>
	</div>

	<a type="button" class="btn btn-primary" href="<?php echo base_url('camping'); ?>">Volver</a>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Total</th>
				<th>Detalle</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ventas->result() as $row) {?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->fecha; ?></td>
				<td><?php echo $row->nombre, ' ', $row->apellido; ?></td>
				<td><?php echo $row->total_venta; ?></td>
				<td><a href="<?php echo base_url("vista_detalle/$row->id"); ?>">Ver detalle</a>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div>

	</div>
</div>
</div>
</div>
