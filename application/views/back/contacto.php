
 <style>
    body{
    background-color:#f2f2f2;
  }
  </style>
<script type="text/javascript">
function formReset()
{
document.getElementById("myForm").reset();
}
</script>
<div class="container mt-3" style="background-image: url('assets/img/Mariposapng.png'); width: 100%; height:100%; background-position:fixed; background-color: transparent;">
<h1 class="container  mt-3 bg-success titulo text-center"><b>Contacto</b></h1>
<div class="container mt-3 text-center etc"><br>
  <div class="row">
    <div class="col-md-6">
      <div class="container-fluid mt-3">
        <img class="img-responsive" Height="25%"" src="assets/img/Mariposapg.png" style="margin:25%">*/
        <div class="container bg-success">
        <h4>Cualquier duda que tengas no dudes en comunicarte con nosotros.<h4>
        <p>Teléfono: 0800-222-8333 | 0810-222-8333</p>
        <p>Email: campingpanambi@turismo.com</p>
        <p>Dirección: EvaPeron 1500 Wanda-Misiones</p>
        </div>
      </div>
    </div>

    <div class="col-md-6">

    <form action="<?php echo base_url('enviado') ?>" method="post" accept-charset="utf-8" class="form-signin" role="form" id="myForm">
      <div class="form-group">
          <label for="nombre"></label>
          <input type="text" class="form-control" id="name" placeholder="Nombre" name="name" required>
        </div>

        <div class="form-group">
          <label for="email"></label>
          <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>

        <div class="form-group">
          <label for="mensaje"></label>
          <textarea class="form-control" maxlength="200" rows="5" id="msj" placeholder="Mensaje" name="msj" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <input type="button" class="btn btn-danger" onclick="formReset()" value="Vaciar campos">
    </form>

    <!--<div class="alert alert-success" style="visibility: <?php echo "$vision" ?>;">
  Su consulta ha sido enviado correctamente.
</div>-->

    </div>
  </div>
</div>
</div>
<br>