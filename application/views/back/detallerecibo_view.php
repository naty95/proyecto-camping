
<div class="container col-sm-10 col-md-10 mt-5 bg-light" style="background-image: url(<?php echo base_url("assets/img/hoja.jpg"); ?>); width: 100%; height:100%; background-position:fixed">


	<div class="well text-center">
		<h1>Detalle venta</h1>
	</div>
	<a type="button" class="btn btn-primary" href="<?php echo base_url('recibo'); ?>">Volver</a>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Fecha</th>
				<th>Total</th>

			</tr>
		</thead>
		<tbody>
			<?php foreach ($venta->result() as $row) {?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->fecha; ?></td>
				<td><?php echo $row->total_venta; ?></td>

			</tr>
			<?php }?>
		</tbody>
	</table>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>total</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($detalles->result() as $row) {?>
			<tr>
				<td><?php echo $row->descripcion; ?></td>
				<td><?php echo $row->cantidad; ?></td>
				<td><?php echo $row->total; ?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div>

	</div>
</div>
</div>
</div>
