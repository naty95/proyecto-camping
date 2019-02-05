

<?php if (!$productos) {?>

    <div class="container" >
        <div class="well">
            <h1>No hay Electrodomesticos</h1>
        </div>
    </div>

<?php } else {
    ?>

<div class="container-fluid mt-3" style="background-image: url('assets/img/hojas.jpg'); width: 100%; height:100%; background-position:fixed; background-color: transparent;">

    <h2 class="text-center mt-3 bg-success">Alquileres</h2>

    <hr>

    <div class="row text-center">
        <?php foreach ($productos->result() as $row) {
        ?>
            <div class="container col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
<div class="container bg-success mt-2">
                    <img src="<?php echo base_url($row->imagen); ?>" alt="" class="img-responsive img-thumbnail">

                    <div class="caption">
                        <h4><?php echo trim($row->descripcion); ?></h4>


                        <p>Precio: $ <?php echo $row->precio; ?> </p>

                        <p>
                        <?php
if (($session_data = $this->session->userdata('logged_in'))) {

            // Envia los datos en forma de formulario para agregar al carrito
            echo form_open('carrito_agrega');
            echo form_hidden('id', $row->id);
            echo form_hidden('descripcion', $row->descripcion);
            echo form_hidden('precio_venta', $row->precio);
            ?>
                                <div>
                        <?php
$btn = array(
                'class' => 'btn btn-primary',
                'value' => 'Reservar',
                'name'  => 'action',
            );

            echo form_submit($btn);
            echo form_close();
            ?>
                                </div>
                        <?php
}
        ?>
                        </p>
</div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
    <hr>
</div>
<?php }?>