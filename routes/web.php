<?php

use App\Http\Controllers\Admin\ControlHorariosMaquinaController;
use App\Http\Controllers\Admin\Datos\ArticulosController;
use App\Http\Controllers\Admin\Datos\CargosController;
use App\Http\Controllers\Admin\Datos\HerramientasController;
use App\Http\Controllers\Admin\Datos\MaquinasController as DatosMaquinasController;
use App\Http\Controllers\Admin\Datos\PersonalController;
use App\Http\Controllers\Admin\Datos\TareaController;
use App\Http\Controllers\Admin\Datos\PiezaArticuloController;
use App\Http\Controllers\Admin\Datos\ProveedoresController;
use App\Http\Controllers\Admin\Datos\TareasController;
use App\Http\Controllers\Admin\EgresosYEtiquetas\ListarController;
use App\Http\Controllers\Admin\HorariosMaquinasController;
use App\Http\Controllers\Admin\Ordenes\ConstruccionController;
use App\Http\Controllers\Admin\EgresosYEtiquetas\RegistrarEgresosController;
use App\Http\Controllers\Admin\ListarFacturasController;
use App\Http\Controllers\Admin\ListaTareasController;
use App\Http\Controllers\Admin\Maquinas\MaquinaController;
use App\Http\Controllers\Admin\Maquinas\MaquinasController;
use App\Http\Controllers\Admin\Ordenes\ReparacionCompletarCancelarController;
use App\Http\Controllers\Admin\Stock\ConfeccionarDespieceController;
use App\Http\Controllers\Admin\Ordenes\ConstruccionListarCancelarController;
use App\Http\Controllers\Admin\Ordenes\EnsambleCompletarCancelarController;
use App\Http\Controllers\Admin\Ordenes\EnsambleController;
use App\Http\Controllers\Admin\Ordenes\EnsambleListarOrden;
use App\Http\Controllers\Admin\Ordenes\ReparacionListarOrden;
use App\Http\Controllers\Admin\Ordenes\ReparacionController;
use App\Http\Controllers\Admin\Pañol\PanolController;
use App\Http\Controllers\Admin\Proveedores\IngresarFacturasController;
use App\Http\Controllers\Admin\Proveedores\ListarArticulosController;
use App\Http\Controllers\Admin\Proveedores\ListarFacturasController as ProveedoresListarFacturasController;
use App\Http\Controllers\Admin\Proveedores\ListarProveedoresController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Stock\ControlStockController;
use App\Http\Controllers\Admin\Usuarios\UsuariosController as UsuariosUsuariosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return view('layouts.index');
})->name('index');

Route::get('/admin/construccion', [ConstruccionController::class, 'index'])->name('construccion.confeccionar');
Route::post('/admin/construccion', [ConstruccionController::class, 'piezas']);
Route::post('/admin/construccion/material', [ConstruccionController::class, 'material']);
Route::post('/admin/construccion/material/buscar', [ConstruccionController::class, 'buscarMaterial']);
Route::post('/admin/construccion/modificartarea', [ConstruccionController::class, 'modificarTarea']);
Route::post('/admin/construccion/agregarconstruccion', [ConstruccionController::class, 'agregarconstruccion']);

Route::get('/admin/horariosmaquinas',[HorariosMaquinasController::class,'index'])->name('horarios.maquinas');
Route::post('/admin/horariosmaquinas',[HorariosMaquinasController::class,'marcarTiempos'])->name('horarios.maquinas.tiempos');
Route::post('/admin/horariosmaquinasensamble',[HorariosMaquinasController::class,'marcarTiemposEnsamble'])->name('horarios.maquinas.tiempos.ensamble');
Route::post('/admin/horariosmaquinasreparacion',[HorariosMaquinasController::class,'marcarTiemposReparacion'])->name('horarios.maquinas.tiempos.reparacion');
//Route::get('/admin/confeccionardespiece',[ConfeccionarDespieceController::class,'index'])->name('confeccionar.despiece');





//Route::get('/admin/horariosmaquinas', [HorariosMaquinasController::class, 'index'])->name('horarios.maquinas');
Route::get('/admin/confeccionardespiece', [ConfeccionarDespieceController::class, 'index'])->name('confeccionar.despiece');
Route::post('/admin/confeccionardespiecepiezas', [ConfeccionarDespieceController::class, 'piezas']);
Route::post('/admin/confeccionardespiecetabla', [ConfeccionarDespieceController::class, 'tabla']);
Route::post('/admin/confeccionardespiecepredeterminar', [ConfeccionarDespieceController::class, 'predeterminar']);
Route::get('/admin/registraregreso', [RegistrarEgresosController::class, 'index'])->name('registrar.egresos');
Route::post('/admin/registraregresopiezas', [RegistrarEgresosController::class, 'piezas']);
Route::post('/admin/registraregresotabla', [RegistrarEgresosController::class, 'tabla']);
Route::post('/admin/registraregresoguardar', [RegistrarEgresosController::class, 'guardar']);
//Route::post('/admin/registraregresoguardar', [RegistrarEgresosController::class, 'guardar']);
Route::get('/admin/listar', [ListarController::class, 'index'])->name('listar');
Route::post('/admin/listartabla', [ListarController::class, 'tabla']);
Route::post('/admin/listarpiezas', [ListarController::class, 'piezas']);
//Route::get('/admin/controlhorariosmaquina', [ControlHorariosMaquinaController::class, 'index'])->name('control.horarios.maquina');
Route::get('/admin/confeccionardespiece',[ConfeccionarDespieceController::class,'index'])->name('confeccionar.despiece');
Route::post('/admin/confeccionardespiecepiezas',[ConfeccionarDespieceController::class,'piezas']);
Route::post('/admin/confeccionardespiecetabla',[ConfeccionarDespieceController::class,'tabla']);
Route::post('/admin/confeccionardespiecepredeterminar',[ConfeccionarDespieceController::class,'predeterminar']);
Route::get('/admin/registraregreso',[RegistrarEgresosController::class,'index'])->name('registrar.egresos');
Route::post('/admin/registraregresopiezas',[RegistrarEgresosController::class,'piezas']);
Route::post('/admin/registraregresotabla',[RegistrarEgresosController::class,'tabla']);
//Route::post('/admin/registraregresoguardar',[RegistrarEgresosController::class,'guardar']);
Route::get('/admin/listar',[ListarController::class,'index'])->name('listar');
Route::post('/admin/listarpiezas',[ListarController::class,'piezas']);
Route::post('/admin/listarmodificar',[ListarController::class,'modificar']);
Route::post('/admin/listareliminar',[ListarController::class,'eliminar']);
Route::post('/admin/listartablaEtiqueta',[ListarController::class,'tablaEtiqueta']);
Route::get('/admin/controlhorariosmaquina',[ControlHorariosMaquinaController::class,'index'])->name('control.horarios.maquina');
//Route::get('/admin/controlmaquina',[ControlHorariosMaquinaController::class,'indexControl'])->name('control.maquina');
//Route::get('/admin/tiemposmaquina',[ControlHorariosMaquinaController::class,'indexTiempos'])->name('tiempos.maquina');
Route::get('/admin/pdf/{id}', [ListarController::class,'PDF'])->name('descargarPDF');
Route::post('/admin/exel', [ListarController::class,'Exel'])->name('descargarExelEgresos');
Route::post('/admin/etchicaspdf', [ListarController::class,'etChicasPDF'])->name('etChicasPDF');
Route::post('/admin/etgrandespdf', [ListarController::class,'etGrandesPDF'])->name('etGrandesPDF');
Route::post('/admin/imprimirtodo', [ListarController::class,'imprimirTodo'])->name('todoPDF');


Route::get('/admin/listarcancelar', [ListarCancelarController::class, 'index'])->name('construccion.listarcancelar');
Route::post('/admin/listarcancelar/piezas', [ListarCancelarController::class, 'piezas']);
Route::post('/admin/listarcancelar/ordenes', [ListarCancelarController::class, 'ordenes']);
Route::post('/admin/listarcancelar/detalles', [ListarCancelarController::class, 'detalles']);

Route::post('/admin/listarcancelar/cancelar', [ListarCancelarController::class, 'cancelar']);
Route::post('/admin/listarcancelar/excel', [ListarCancelarController::class, 'excel']);
Route::get('/admin/listarcancelar/exportExcel', [ListarCancelarController::class, 'exportExcel']);


Route::get('/admin/listarcancelar', [ConstruccionListarCancelarController::class, 'index'])->name('construccion.listarcancelar');
Route::post('/admin/listarcancelar/piezas', [ConstruccionListarCancelarController::class, 'piezas']);
Route::post('/admin/listarcancelar/ordenes', [ConstruccionListarCancelarController::class, 'ordenes']);
Route::post('/admin/listarcancelar/detalles', [ConstruccionListarCancelarController::class, 'detalles']);
Route::post('/admin/listarcancelar/cancelar', [ConstruccionListarCancelarController::class, 'cancelar']);
Route::post('/admin/listarcancelar/exportExcel', [ConstruccionListarCancelarController::class, 'exportExcel'])->name('piezaExcel');
Route::post('/admin/listarcancelar/exportExcelFechas', [ConstruccionListarCancelarController::class, 'exportExcelFechas'])->name('fechaExcel');
Route::post('/admin/listarcancelar/exportExcelNumero', [ConstruccionListarCancelarController::class, 'exportExcelNumero'])->name('numeroExcel');
Route::post('/admin/listarcancelar/ordenPDF', [ConstruccionListarCancelarController::class, 'ordenPDF'])->name('ordenPDF');
Route::post('/admin/listarcancelar/ordenRepPDF', [ReparacionListarOrden::class, 'ordenRepPDF'])->name('ordenRepPDF');
Route::post('/admin/listarcancelar/ordenEnsPDF', [EnsambleListarOrden::class, 'ordenEnsPDF'])->name('ordenEnsPDF');
Route::post('/admin/listarcancelar/modificarOC', [ConstruccionListarCancelarController::class, 'modificarOC']);
Route::post('/admin/listarcancelar/agregarTarea', [ConstruccionListarCancelarController::class, 'agregarTarea']);
Route::post('/admin/listarcancelar/eliminarTarea', [ConstruccionListarCancelarController::class, 'eliminarTarea']);



Route::get('/admin/reparacion/confeccionar', [ReparacionController::class, 'index'])->name('reparacion.confeccionar');
Route::post('/admin/reparacion/conjuntos', [ReparacionController::class, 'conjuntos']);
Route::post('/admin/reparacion/guardar', [ReparacionController::class, 'guardar']);

Route::get('/admin/reparacion/completarcancelar', [ReparacionCompletarCancelarController::class, 'index'])->name('reparacion.completarcancelar');
Route::post('/admin/reparacion/ordenpendiente', [ReparacionCompletarCancelarController::class, 'ordenpendiente']);
Route::post('/admin/reparacion/ordenpieza', [ReparacionCompletarCancelarController::class, 'ordenpieza']);
Route::post('/admin/reparacion/cancelarorden', [ReparacionCompletarCancelarController::class, 'cancelarorden']);
Route::post('/admin/reparacion/agregarorden', [ReparacionCompletarCancelarController::class, 'agregarorden']);

Route::get('/admin/reparacion/listar', [ReparacionListarOrden::class, 'index'])->name('reparacion.listar');
Route::post('/admin/reparacion/listarherramientas', [ReparacionListarOrden::class, 'listarherramientas']);
Route::post('/admin/reparacion/listarordenes', [ReparacionListarOrden::class, 'listarordenes']);
Route::post('/admin/reparacion/listardetalles', [ReparacionListarOrden::class, 'listardetalles']);
/* Route::post('/admin/reparacion/exportExcel', [ReparacionListarOrden::class, 'exportExcel'])->name('reparacionPiezaExcel');
Route::post('/admin/reparacion/exportExcelFechas', [ReparacionListarOrden::class, 'exportExcelFechas'])->name('reparacionFechaExcel');
Route::post('/admin/reparacion/exportExcelNumero', [ReparacionListarOrden::class, 'exportExcelNumero'])->name('reparacionNumeroExcel'); */
Route::post('/admin/reparacion/modificarorden', [ReparacionListarOrden::class, 'modificarorden']);
Route::post('/admin/reparacion/guardarorden', [ReparacionListarOrden::class, 'guardarorden']);


Route::get('/admin/ensamble/confeccionar', [EnsambleController::class, 'index'])->name('ensamble.confeccionar');
Route::post('/admin/ensamble/conjuntos', [EnsambleController::class, 'conjuntos']);
Route::post('/admin/ensamble/guardar', [EnsambleController::class, 'guardar']);

Route::get('/admin/ensamble/completarcancelar', [EnsambleCompletarCancelarController::class, 'index'])->name('ensamble.completarcancelar');
Route::post('/admin/ensamble/ordenpendiente', [EnsambleCompletarCancelarController::class, 'ordenpendiente']);
Route::post('/admin/ensamble/cancelarorden', [EnsambleCompletarCancelarController::class, 'cancelarorden']);
Route::post('/admin/ensamble/ordenpieza', [EnsambleCompletarCancelarController::class, 'ordenpieza']); 
Route::post('/admin/ensamble/agregarorden', [EnsambleCompletarCancelarController::class, 'agregarorden']);

Route::get('/admin/ensamble/listar', [EnsambleListarOrden::class, 'index'])->name('ensamble.listar');
Route::post('/admin/ensamble/listarordenes', [EnsambleListarOrden::class, 'listarordenes']);
Route::post('/admin/ensamble/listarmodificar', [EnsambleListarOrden::class, 'modificar']);
Route::post('/admin/ensamble/listarguardar', [EnsambleListarOrden::class, 'guardar']);

Route::post('/admin/confeccionardespiecepiezas', [ConfeccionarDespieceController::class, 'piezas']);
Route::post('/admin/confeccionardespiecetabla', [ConfeccionarDespieceController::class, 'tabla']);
Route::post('/admin/confeccionardespiecepredeterminar', [ConfeccionarDespieceController::class, 'predeterminar']);
Route::post('/admin/registraregresopiezas', [RegistrarEgresosController::class, 'piezas']);
Route::post('/admin/registraregresotabla', [RegistrarEgresosController::class, 'tabla']);
//Route::get('/admin/controlhorariosmaquina', [ControlHorariosMaquinaController::class, 'index'])->name('control.horarios.maquina');

Route::get('/admin/datos/piezasconjuntos', [PiezaArticuloController::class, 'index'])->name('datos.piezasconjuntos');
Route::post('/admin/datos/buscarpiezas', [PiezaArticuloController::class, 'buscarpiezas']);
Route::post('/admin/datos/store', [PiezaArticuloController::class, 'store']);
Route::post('/admin/datos/show', [PiezaArticuloController::class, 'show']);
Route::post('/admin/datos/update', [PiezaArticuloController::class, 'update']);

//Route::get('/admin/datos/tareas', [TareaController::class, 'index'])->name('datos.tareas');

Route::get('/admin/listarproveedores', [ListarProveedoresController::class, 'index'])->name('listar.proveedores');
Route::post('/admin/listarproveedoreslistar', [ListarProveedoresController::class, 'listar']);
Route::post('/admin/listarproveedoresarticulos', [ListarProveedoresController::class, 'listarArticulos']);

Route::get('/admin/listararticulos', [ListarArticulosController::class, 'index'])->name('listar.articulos');
Route::post('/admin/listararticuloslistar', [ListarArticulosController::class, 'listarArticulos']);
Route::post('/admin/listararticuloslistarproveedores', [ListarArticulosController::class, 'listarProveedores']);

Route::resource('usuarios', UsuariosUsuariosController::class)->names('usuarios');
Route::resource('roles', RoleController::class)->names('roles');
Route::resource('maquinas',MaquinasController::class)->names('maquinas');
/* Route::post('maquina.asignar',MaquinaController::class,'asignar')->names('maquina.asignar'); */

Route::get('/admin/controlstock', [ControlStockController::class, 'index'])->name('stock');
Route::get('/admin/controlstockegreso/{id}/{tipo}', [ControlStockController::class, 'egreso'])->name('stockEgreso');
Route::get('/admin/listatareas/{id}', [ListaTareasController::class, 'index'])->name('listaTareas');
Route::get('/admin/listapausas/{id}', [ListaTareasController::class, 'pausas'])->name('listaPausas');

Route::get('/admin/listarfacturas', [ProveedoresListarFacturasController::class, 'index'])->name('listar.facturas');
Route::post('/admin/listarfacturaslistar', [ProveedoresListarFacturasController::class, 'listarFacturas']);
Route::post('/admin/listarfacturaslistararticulos', [ProveedoresListarFacturasController::class, 'listarArticulos']);
Route::post('/admin/listarfacturasllenarmodal', [ProveedoresListarFacturasController::class, 'llenarModal']);
Route::post('/admin/listarfacturasguardar', [ProveedoresListarFacturasController::class, 'guardarFactura']);
Route::post('/admin/listarfacturasbuscarproducto', [ProveedoresListarFacturasController::class, 'buscarProducto']);

Route::resource('personal', PersonalController::class)->names('datos.personal');
Route::resource('cargos', CargosController::class)->names('datos.cargos');
Route::resource('datosmaquinas', DatosMaquinasController::class)->names('datos.maquinas');
Route::resource('proveedores', ProveedoresController::class)->names('datos.proveedores');
Route::resource('articulos', ArticulosController::class)->names('datos.articulos');
Route::resource('tareas', TareasController::class)->names('datos.tareas');
Route::resource('herramientas', HerramientasController::class)->names('datos.herramientas');

Route::get('/admin/ingrasarfacturas', [IngresarFacturasController::class, 'index'])->name('ingresar.facturas');
Route::post('/admin/facturaobtenerproveedor', [IngresarFacturasController::class, 'getProveedor']);
Route::post('/admin/ingresarfacturasllenarmodal', [IngresarFacturasController::class, 'getArticulos']);
Route::post('/admin/ingresarfacturasgetart', [IngresarFacturasController::class, 'getArticulo']);
Route::post('/admin/ingresarfacturassave', [IngresarFacturasController::class, 'saveFactura']);
Route::post('/admin/ingresarfacturasgetcolada', [IngresarFacturasController::class, 'getColada']);

Route::get('/admin/pañol', [PanolController::class, 'index'])->name('panol');
Route::get('/admin/pañol/prestar/{id}', [PanolController::class, 'prestar'])->name('panol.prestar');
Route::post('/admin/pañol/save', [PanolController::class, 'save'])->name('panol.prestar.save');
