
<div class="container-fluid" id="carrito">
    <div class="cart" >
        <div class = "heading">
            <h2 id="h2" align="center">Productos en tu Carrito</h2>
        </div>
        
        <div class="text" align="center"> 

            <?php  $cart_check = $this->cart->contents();
            // Si el carrito está vacio, mostrar el siguiente mensaje
            if (empty($cart_check)) 
            {
                echo 'Para agregar productos al carrito, click en "Comprar"';
            }  
            ?>    
        </div>
        
        <table class="table" border="0" cellpadding="5px" cellspacing="1px">

            <?php // Todos los items de carrito en "$cart". 
            if ($cart = $this->cart->contents()):  
            ?>
                <tr id= "main_heading">
                    <td>ID</td>
                    <td>Descripcion</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                    <td>Cancelar Producto</td>
                </tr>

            <?php // Crea un formulario y manda los valores a carrito_controller/actualiza carrito
            echo form_open('carrito_actualiza');
                $gran_total = 0;
                $i = 1;

                foreach ($cart as $item):
                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
            ?>
                    <tr>
                        <td>
                            <?php echo $i++; ?>
                        </td>
                        <td>
                            <?php echo $item['name']; ?>
                        </td>
                        <td>
                            $ <?php echo number_format($item['price'], 2); ?>
                        </td>
                        <td>
                            <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 
                                                    'maxlength="3" size="1" style="text-align: right"'); ?>
                        </td>
                            <?php $gran_total = $gran_total + $item['subtotal']; ?>
                        <td>
                            $ <?php echo number_format($item['subtotal'], 2) ?>
                        </td>
                        <td> 
                            <?php // Imagen
                                $path = '<img src= '. base_url('assets/img/cart_cross.jpg') . ' width="25px" height="20px">';
                                echo anchor('carrito_elimina/' . $item['rowid'], $path); 
                            ?>
                        </td>
                    </tr>
                <?php 
                endforeach; 
                ?>
                    
                <tr>
                    <td>
                        <b>Total: $
                            <?php //Gran Total
                            echo number_format($gran_total, 2); 
                            ?>
                        </b>
                    </td> 
                    <td colspan="5" align="right">
                        <!-- Borrar carrito usa mensaje de confirmacion javascript implementado en partes/head_view -->
                        <input type="button" class ='btn btn-primary btn-lg' value="Borrar Carrito" onclick="borra_carrito()">
                        <!-- Submit boton. Actualiza los datos en el carrito -->
                        <input type="submit" class ='btn btn-primary btn-lg' value="Actualizar">
                        <!-- " Confirmar orden envia a carrito_controller/muestra_compra  -->
                        <input type="button" class ='btn btn-primary btn-lg' value="Confirmar Orden" onclick="window.location = 'comprar'">
                    </td>
                </tr>
                <?php echo form_close();
            endif; ?>
        </table>
    </div>
</div>
<br>