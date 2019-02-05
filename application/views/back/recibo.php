
<div class=" container-fluid mt-5 col-sm-10 col-md-10" style="background-image: url('assets/img/hojas.jpg'); width: 100%; height:100%; background-position:fixed; background-color: transparent;">
    <div class="well">
        <h1 class="text-center mt-3 bg-success">Todas sus reservas</h1>
    </div>
    <a type="button" class="btn btn-primary mt-3" href="<?php echo base_url('camping'); ?>">Volver</a>

    <table class=" container-fluid mt-3 bg-success table table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas->result() as $row) {?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->fecha; ?></td>
                <td><?php echo $row->total_venta; ?></td>
                <td><a href="<?php echo base_url("vista_deta/$row->id"); ?>">Ver detalle</a>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <div>

    </div>
</div>
</div>
</div>
