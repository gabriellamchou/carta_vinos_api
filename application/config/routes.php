<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# Vinos

$route['vinos'] = 'VinoController/vinos';
$route['vinos/(:num)'] = 'VinoController/vino/$1';
$route['vinos/nuevo'] = 'VinoController/storeVino';
$route['vinos/(:num)/editar'] = 'VinoController/editVino/$1';
$route['vinos/(:num)/eliminar'] = 'VinoController/deleteVino/$1';

# Uvas

$route['uvas'] = 'UvaController/uvas';
$route['uvas/(:num)'] = 'UvaController/uva/$1';
$route['uvas/nueva'] = 'UvaController/storeUva';
$route['uvas/(:num)/editar'] = 'UvaController/editUva/$1';
$route['uvas/(:num)/eliminar'] = 'UvaController/deleteUva/$1';

# Regiones

$route['regiones'] = 'RegionController/regiones';
$route['regiones/(:num)'] = 'RegionController/region/$1';
$route['regiones/nueva'] = 'RegionController/storeRegion';
$route['regiones/(:num)/editar'] = 'RegionController/editRegion/$1';
$route['regiones/(:num)/eliminar'] = 'RegionController/deleteRegion/$1';

# Bodegas

$route['bodegas'] = 'BodegaController/bodegas';
$route['bodegas/(:num)'] = 'BodegaController/bodega/$1';
$route['bodegas/nueva'] = 'BodegaController/storeBodega';
$route['bodegas/(:num)/editar'] = 'BodegaController/editBodega/$1';
$route['bodegas/(:num)/eliminar'] = 'BodegaController/deleteBodega/$1';

# Tipos

$route['tipos'] = 'TipoController/tipos';
$route['tipos/(:num)'] = 'TipoController/tipo/$1';
$route['tipos/nuevo'] = 'TipoController/storeTipo';
$route['tipos/(:num)/editar'] = 'TipoController/editTipo/$1';
$route['tipos/(:num)/eliminar'] = 'TipoController/deleteTipo/$1';

# Tests

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['prueba-get'] = 'Test/prueba';
$route['prueba-post'] = 'Test/prueba';

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
