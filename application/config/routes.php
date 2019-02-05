<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
|ller/my_method
 */
$route['default_controller'] = 'Welcome';
$route['camping']            = 'Welcome';
$route['login']              = 'Welcome/login';
$route['servicios']          = 'Welcome/servicios';
$route['reservas']           = 'Welcome/reservas';
$route['ubicacion']          = 'Welcome/ubicacion';
$route['registro']           = 'Welcome/registro';
$route['consultas']          = 'Welcome/consulta';
$route['panel']              = 'panel_controller';

//nuevo usuario
$route['nuevo_usuario'] = 'usuario/nuevo_usuario';
$route['ingreso']       = 'usuario';

$route['user_edit/(:num)'] = 'usuario/edit/$1';
$route['user_up/(:num)']   = 'usuario/editar_usuario/$1';

$route['verifico_usuario']       = 'login_controller';
$route['insert']                 = 'usuario/form_insert';
$route['registrar']              = 'usuario/insert_usuario';
$route['remove_usuario/(:num)']  = 'usuario/usuario_remove/$1';
$route['datos']                  = 'usuario/activos';
$route['usuario_disabled']       = 'usuario/disabled_usuarios';
$route['activar_usuario/(:num)'] = 'usuario/active_user/$1';

$route['usuarios_todos'] = 'usuario/activos';
$route['un_usuario']     = 'usuario/un_usuario/$1';

//verificacion de usuario
$route['valida_usuario'] = 'login_controller';
$route['logout']         = 'panel_controller/logout';

$route['enviado']       = "consulta_controller/index";
$route['ver_consultas'] = "consulta_controller/mostrar";
$route['contacto']      = "consulta_controller/sended_msj";

//producto
$route['productos_agrega']                 = 'producto_controller/agrega_producto';
$route['productos_todos']                  = 'producto_controller/muestra_alquileres';
$route['alta_producto']                    = 'producto_controller/form_agrega_producto';
$route['verifico_nuevoproducto']           = 'producto_controller/agrega_producto';
$route['productos_modifica/(:num)']        = 'producto_controller/muestra_modificar';
$route['verifico_modificaproducto/(:num)'] = 'producto_controller/modificar_producto/$1';
$route['productos_elimina/(:num)']         = 'producto_controller/eliminar_producto';
$route['productos_eliminados']             = 'producto_controller/muestra_eliminados';
$route['productos_activa/(:num)']          = 'producto_controller/activar_producto';

//carrito
$route['carrito']                = 'carrito_controller/alquiler';
$route['carrito_agrega']         = 'carrito_controller/add';
$route['carrito_actualiza']      = 'carrito_controller/actualiza_carrito';
$route['carrito_elimina/(:any)'] = 'carrito_controller/remove/$1';
$route['comprar']                = 'carrito_controller/muestra_compra';
$route['confirma_compra']        = 'carrito_controller/guarda_compra';

$route['listado_ventas']       = "venta_controller/mostrar";
$route['vista_detalle/(:num)'] = "venta_controller/ver_detalle";
$route['vista_deta/(:num)']    = 'venta_controller/muestra_recibo';
$route['recibo']               = 'venta_controller/recibo';

$route['agregar_reserva'] = 'carrito_controller/alquiler';
//$route['panel']                = 'login_controller/tipo_usuario';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;
