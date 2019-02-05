<style type="text/css">
	table{color:black;}
</style>
<div class=" container col-sm-10 col-md-10 bg-warning mt-3">
	<div class="well text_center">
		<h1 class= "text-center">Todas las consultas</h1>
	</div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Mensaje</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($consultas->result() as $row) {?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->nombre; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><?php echo $row->mensaje; ?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div>

	</div>
</div>
</div>
</div>
