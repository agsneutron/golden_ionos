<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses'=> 'Auth\LoginController@getLogin',
    'as' => 'login'
]);

Route::get('/privacyPolicies', ['as' => 'users.privacyPolicies', 'uses' => 'UsersController@privacyPolicies']);
Route::get('/marketing', ['as' => 'users.marketing', 'uses' => 'UsersController@marketing']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);


    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'users', 'uses' => 'UsersController@index']);
        Route::post('/tablaUsuarios', ['as' => 'users.table', 'uses' => 'UsersController@table']);
        Route::post('/editarUsuario', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
        Route::post('/guardarUsuario', ['as' => 'users.save', 'uses' => 'UsersController@save']);
        Route::post('/cambiarPasswordUsuario', ['as' => 'users.changePassword', 'uses' => 'UsersController@changePassword']);
        Route::post('/eliminarUsuario', ['as' => 'users.delete', 'uses' => 'UsersController@delete']);
    });

    Route::group(['prefix' => 'permits'], function () {
        Route::get('/', ['as' => 'permits', 'uses' => 'PermitsController@index']);
        Route::post('/editarPermisos', ['as' => 'permits.editPermits', 'uses' => 'PermitsController@editPermits']);
        Route::post('/cambiarPermiso', ['as' => 'permits.changePermission', 'uses' => 'PermitsController@changePermission']);
        Route::post('/cambiarBandera', ['as' => 'permits.changeFlag', 'uses' => 'PermitsController@changeFlag']);
        Route::post('/guardarPerfil', ['as' => 'permits.saveProfile', 'uses' => 'PermitsController@saveProfile']);
    });

    Route::group(['prefix' => 'branch_offices'], function () {
        Route::get('/', ['as' => 'branch_offices', 'uses' => 'BranchOfficesController@index']);
        Route::post('/tablaSucursales', ['as' => 'branch_offices.table', 'uses' => 'BranchOfficesController@table']);
        Route::post('/editarSucursal', ['as' => 'branch_offices.edit', 'uses' => 'BranchOfficesController@edit']);
        Route::post('/guardarSucursal', ['as' => 'branch_offices.save', 'uses' => 'BranchOfficesController@save']);
        Route::post('/eliminarSucursal', ['as' => 'branch_offices.delete', 'uses' => 'BranchOfficesController@delete']);
    });

    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', ['as' => 'clients', 'uses' => 'ClientsController@index']);
        Route::post('/tablaClientes', ['as' => 'clients.table', 'uses' => 'ClientsController@table']);
        Route::post('/editarClientes', ['as' => 'clients.edit', 'uses' => 'ClientsController@edit']);
        Route::post('/guardarCliente', ['as' => 'clients.save', 'uses' => 'ClientsController@save']);
        Route::post('/cambiarPasswordCliente', ['as' => 'clients.changePassword', 'uses' => 'ClientsController@changePassword']);
        Route::post('/eliminarCliente', ['as' => 'clients.delete', 'uses' => 'ClientsController@delete']);
        Route::post('/unificarClientes', ['as' => 'clients.unifyClients', 'uses' => 'ClientsController@unifyClients']);
    });

    Route::group(['prefix' => 'services'], function () {
        Route::get('/', ['as' => 'services', 'uses' => 'ServicesController@index']);
        Route::post('/tablaCategorias', ['as' => 'services.tableCategories', 'uses' => 'ServicesController@tableCategories']);
        Route::post('/tablaServicios', ['as' => 'services.tableServices', 'uses' => 'ServicesController@tableServices']);
        Route::post('/editarCategoria', ['as' => 'services.editCategory', 'uses' => 'ServicesController@editCategory']);
        Route::post('/guardarCategoria', ['as' => 'services.saveCategory', 'uses' => 'ServicesController@saveCategory']);
        Route::post('/eliminarCategoría', ['as' => 'services.deleteCategory', 'uses' => 'ServicesController@deleteCategory']);
        Route::post('/editarServicio', ['as' => 'services.editService', 'uses' => 'ServicesController@editService']);
        Route::post('/guardarServicio', ['as' => 'services.saveService', 'uses' => 'ServicesController@saveService']);
        Route::post('/eliminarServicio', ['as' => 'services.deleteService', 'uses' => 'ServicesController@deleteService']);
        Route::post('/unificarServicios', ['as' => 'services.unifyServices', 'uses' => 'ServicesController@unifyServices']);
    });

    Route::group(['prefix' => 'articles'], function () {
        Route::get('/', ['as' => 'articles', 'uses' => 'ArticlesController@index']);
        Route::post('/tablaArticulos', ['as' => 'articles.table', 'uses' => 'ArticlesController@table']);
        Route::post('/editarArticulo', ['as' => 'articles.edit', 'uses' => 'ArticlesController@edit']);
        Route::post('/guardarArticulo', ['as' => 'articles.save', 'uses' => 'ArticlesController@save']);
        Route::post('/eliminarArticulo', ['as' => 'articles.delete', 'uses' => 'ArticlesController@delete']);
    });

    Route::group(['prefix' => 'prints'], function () {
        Route::get('/', ['as' => 'prints', 'uses' => 'PrintsController@index']);
        Route::post('/tablaEstampados', ['as' => 'prints.table', 'uses' => 'PrintsController@table']);
        Route::post('/editarEstampado', ['as' => 'prints.edit', 'uses' => 'PrintsController@edit']);
        Route::post('/guardarEstampado', ['as' => 'prints.save', 'uses' => 'PrintsController@save']);
        Route::post('/eliminarEstampado', ['as' => 'prints.delete', 'uses' => 'PrintsController@delete']);
    });

    Route::group(['prefix' => 'defects'], function () {
        Route::get('/', ['as' => 'defects', 'uses' => 'DefectsController@index']);
        Route::post('/tablaDefectos', ['as' => 'defects.table', 'uses' => 'DefectsController@table']);
        Route::post('/editarDefecto', ['as' => 'defects.edit', 'uses' => 'DefectsController@edit']);
        Route::post('/guardarDefecto', ['as' => 'defects.save', 'uses' => 'DefectsController@save']);
        Route::post('/eliminarDefecto', ['as' => 'defects.delete', 'uses' => 'DefectsController@delete']);
    });

    Route::group(['prefix' => 'colors'], function () {
        Route::get('/', ['as' => 'colors', 'uses' => 'ColorsController@index']);
        Route::post('/tablaColores', ['as' => 'colors.table', 'uses' => 'ColorsController@table']);
        Route::post('/editarColor', ['as' => 'colors.edit', 'uses' => 'ColorsController@edit']);
        Route::post('/guardarColor', ['as' => 'colors.save', 'uses' => 'ColorsController@save']);
        Route::post('/eliminarColor', ['as' => 'colors.delete', 'uses' => 'ColorsController@delete']);
    });

    Route::group(['prefix' => 'payment_methods'], function () {
        Route::get('/', ['as' => 'payment_methods', 'uses' => 'PaymentMethodsController@index']);
        Route::post('/tablaMetodosPago', ['as' => 'payment_methods.table', 'uses' => 'PaymentMethodsController@table']);
        Route::post('/editarMetodoPago', ['as' => 'payment_methods.edit', 'uses' => 'PaymentMethodsController@edit']);
        Route::post('/guardarMetodoPago', ['as' => 'payment_methods.save', 'uses' => 'PaymentMethodsController@save']);
        Route::post('/eliminarMetodoPago', ['as' => 'payment_methods.delete', 'uses' => 'PaymentMethodsController@delete']);
    });

    Route::group(['prefix' => 'expense_concepts'], function () {
        Route::get('/', ['as' => 'expense_concepts', 'uses' => 'ExpenseConceptsController@index']);
        Route::post('/tablaConceptosDeGastos', ['as' => 'expense_concepts.table', 'uses' => 'ExpenseConceptsController@table']);
        Route::post('/editarConceptoDeGasto', ['as' => 'expense_concepts.edit', 'uses' => 'ExpenseConceptsController@edit']);
        Route::post('/guardarConceptoDeGasto', ['as' => 'expense_concepts.save', 'uses' => 'ExpenseConceptsController@save']);
        Route::post('/eliminarConceptoDeGasto', ['as' => 'expense_concepts.delete', 'uses' => 'ExpenseConceptsController@delete']);
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'orders', 'uses' => 'OrdersController@index']);
        Route::post('/buscarOrdenes', ['as' => 'orders.searchOrders', 'uses' => 'OrdersController@searchOrders']);
        Route::post('/editarOrden', ['as' => 'orders.edit', 'uses' => 'OrdersController@edit']);
        Route::post('/guardarOrden', ['as' => 'orders.save', 'uses' => 'OrdersController@save']);
        Route::post('/detalleDeOrden', ['as' => 'orders.loadDetailOrder', 'uses' => 'OrdersController@loadDetailOrder']);
        Route::get('/ver_orden/{uid}', ['as' => 'orders.view_order', 'uses' => 'OrdersController@view_order']);
        Route::post('/tablaDetalleDeOrden', ['as' => 'orders.loadTableDetailOrder', 'uses' => 'OrdersController@loadTableDetailOrder']);
        Route::post('/cargarClientes', ['as' => 'orders.loadClients', 'uses' => 'OrdersController@loadClients']);
        Route::post('/cargarServicios', ['as' => 'orders.loadServices', 'uses' => 'OrdersController@loadServices']);
        Route::post('/guardarDetalle', ['as' => 'orders.saveDetail', 'uses' => 'OrdersController@saveDetail']);
        Route::post('/editarDetalle', ['as' => 'orders.editDetail', 'uses' => 'OrdersController@editDetail']);
        Route::post('/guardarEstatusDetalle', ['as' => 'orders.saveDetailStatus', 'uses' => 'OrdersController@saveDetailStatus']);
        Route::post('/guardarEstatusMasivo', ['as' => 'orders.saveStatusMasive', 'uses' => 'OrdersController@saveStatusMasive']);
        Route::post('/historialDetalle', ['as' => 'orders.showDetailHistory', 'uses' => 'OrdersController@showDetailHistory']);
        Route::post('/registrarPago', ['as' => 'orders.saveOrderPayment', 'uses' => 'OrdersController@saveOrderPayment']);
        Route::post('/marcarComoEntregada', ['as' => 'orders.markAsDelivered', 'uses' => 'OrdersController@markAsDelivered']);
        Route::post('/marcarComoPendiente', ['as' => 'orders.markAsPending', 'uses' => 'OrdersController@markAsPending']);
        Route::post('/registrarEntrega', ['as' => 'orders.saveRegisterDelivery', 'uses' => 'OrdersController@saveRegisterDelivery']);
        Route::post('/reprogramarEntrega', ['as' => 'orders.saveReprogramDelivery', 'uses' => 'OrdersController@saveReprogramDelivery']);
        Route::post('/consultarFechaEntrega', ['as' => 'orders.requestDeliveryDate', 'uses' => 'OrdersController@requestDeliveryDate']);
        Route::post('/consultarPrecio', ['as' => 'orders.requestPrice', 'uses' => 'OrdersController@requestPrice']);
        Route::post('/consultarMontoRestante', ['as' => 'orders.requestRemaining', 'uses' => 'OrdersController@requestRemaining']);
        Route::post('/consultarIndicadores', ['as' => 'orders.requestIndicators', 'uses' => 'OrdersController@requestIndicators']);
        Route::post('/cancelarOrdenes', ['as' => 'orders.cancelOrder', 'uses' => 'OrdersController@cancelOrder']);
        Route::post('/eliminarItem', ['as' => 'orders.deleteDetail', 'uses' => 'OrdersController@deleteDetail']);
        Route::post('/consultarPagosDeOrden', ['as' => 'orders.loadTablePaymentsOrder', 'uses' => 'OrdersController@loadTablePaymentsOrder']);
        Route::get('/imprimirNota/{cve}', ['as' => 'orders.printOrder', 'uses' => 'OrdersController@printOrder']);
        Route::post('/guardarMonederoElectronico', ['as' => 'orders.savePurse', 'uses' => 'OrdersController@savePurse']);
        Route::post('/eliminarPago', ['as' => 'orders.deletePayment', 'uses' => 'OrdersController@deletePayment']);
        Route::post('/guardarObservaciones', ['as' => 'orders.saveObservations', 'uses' => 'OrdersController@saveObservations']);
        Route::post('/guardarNuevoMetodoPago', ['as' => 'orders.savePaymentMethod', 'uses' => 'OrdersController@savePaymentMethod']);
        Route::post('/guardarNuevoCliente', ['as' => 'orders.saveNewClient', 'uses' => 'OrdersController@saveNewClient']);
    });

    Route::group(['prefix' => 'expenses'], function () {
        Route::get('/', ['as' => 'expenses', 'uses' => 'ExpensesController@index']);
        Route::post('/buscarGastos', ['as' => 'expenses.searchExpenses', 'uses' => 'ExpensesController@searchExpenses']);
        Route::post('/editarGasto', ['as' => 'expenses.edit', 'uses' => 'ExpensesController@edit']);
        Route::post('/guardarGasto', ['as' => 'expenses.save', 'uses' => 'ExpensesController@save']);
    });

    Route::group(['prefix' => 'deliveries'], function () {
        Route::get('/', ['as' => 'deliveries', 'uses' => 'DeliveriesController@index']);
        Route::post('/buscarEntregas', ['as' => 'deliveries.searchDeliveries', 'uses' => 'DeliveriesController@searchDeliveries']);
        Route::post('/editarEntrega', ['as' => 'deliveries.edit', 'uses' => 'DeliveriesController@edit']);
        Route::post('/guardarEntrega', ['as' => 'deliveries.save', 'uses' => 'DeliveriesController@save']);
        Route::post('/tablaEntregas', ['as' => 'deliveries.loadTableDeliveries', 'uses' => 'DeliveriesController@loadTableDeliveries']);
        Route::post('/cancelarEntrega', ['as' => 'deliveries.cancelDelivery', 'uses' => 'DeliveriesController@cancelDelivery']);
        Route::post('/entregaCompleta', ['as' => 'deliveries.completeDelivery', 'uses' => 'DeliveriesController@completeDelivery']);
    });

    Route::group(['prefix' => 'harvest'], function () {
        Route::get('/', ['as' => 'harvest', 'uses' => 'HarvestController@index']);
        Route::post('/buscarRecolecciones', ['as' => 'harvest.searchHarvest', 'uses' => 'HarvestController@searchHarvest']);
        Route::post('/guardarRecoleccion', ['as' => 'harvest.save', 'uses' => 'HarvestController@save']);
        Route::post('/tablaRecolecciones', ['as' => 'harvest.load_table', 'uses' => 'HarvestController@load_table']);
        Route::post('/reprogramar_recoleccion', ['as' => 'harvest.reschedule', 'uses' => 'HarvestController@reschedule']);
    });

    Route::group(['prefix' => 'purses'], function () {
        Route::get('/', ['as' => 'purses', 'uses' => 'PursesController@index']);
        Route::post('/tablaMonederos', ['as' => 'purses.table', 'uses' => 'PursesController@table']);
        Route::post('/guardarMonedero', ['as' => 'purses.save', 'uses' => 'PursesController@save']);
        Route::post('/agregarMontoAMonedero', ['as' => 'purses.add_amount', 'uses' => 'PursesController@add_amount']);
        Route::post('/editarMonedero', ['as' => 'purses.edit', 'uses' => 'PursesController@edit']);
        Route::post('/eliminarMonedero', ['as' => 'purses.delete', 'uses' => 'PursesController@delete']);
        Route::post('/verHistorialMonedero', ['as' => 'purses.showPurseHistory', 'uses' => 'PursesController@showPurseHistory']);
    });

    Route::group(['prefix' => 'daily_cut'], function () {
        Route::get('/', ['as' => 'daily_cut', 'uses' => 'DailyCutController@index']);
        Route::post('/tablaIngresosEfectivo', ['as' => 'daily_cut.tableCash', 'uses' => 'DailyCutController@tableCash']);
        Route::post('/tablaIngresosTarjeta', ['as' => 'daily_cut.tableCard', 'uses' => 'DailyCutController@tableCard']);
        Route::post('/tablaIngresosTransferencia', ['as' => 'daily_cut.tableTransfer', 'uses' => 'DailyCutController@tableTransfer']);
        Route::post('/tablaGastos', ['as' => 'daily_cut.tableExpenses', 'uses' => 'DailyCutController@tableExpenses']);
        Route::post('/obtenerTotales', ['as' => 'daily_cut.requestTotals', 'uses' => 'DailyCutController@requestTotals']);
        Route::get('/imprimirCorteDelDia/{branch}/{day}', ['as' => 'daily_cut.printDailyCut', 'uses' => 'DailyCutController@printDailyCut']);
    });
    
    Route::group(['prefix' => 'delivery_report'], function () {
        Route::get('/reporte_de_entregas', ['as' => 'delivery_report', 'uses' => 'DeliveryReportController@index']);
        Route::post('/tabla_reporte_de_entregas', ['as' => 'delivery_report.table', 'uses' => 'DeliveryReportController@table_report_deliveries']);       
    });

    Route::group(['prefix' => 'sales_report'], function () {
        Route::get('/', ['as' => 'sales_report', 'uses' => 'SalesReportController@index']);
        Route::post('/graficaVentasCategoria', ['as' => 'sales_report.loadReportCategory', 'uses' => 'SalesReportController@loadReportCategory']);
        Route::post('/graficaVentas', ['as' => 'sales_report.loadReport', 'uses' => 'SalesReportController@loadReport']);
        Route::post('/tablaVentas', ['as' => 'sales_report.table', 'uses' => 'SalesReportController@table']);
        Route::post('/tablaMejoresClientes', ['as' => 'sales_report.table_best_clients', 'uses' => 'SalesReportController@table_best_clients']);
    });

    Route::group(['prefix' => 'expense_report'], function () {
        Route::get('/', ['as' => 'expense_report', 'uses' => 'ExpenseReportController@index']);
        Route::post('/graficaGastos', ['as' => 'expense_report.loadReport', 'uses' => 'ExpenseReportController@loadReport']);
        Route::post('/tablaGastos', ['as' => 'expense_report.table', 'uses' => 'ExpenseReportController@table']);
    });
   
    Route::group(['prefix' => 'ranking'], function () {
        Route::get('/', ['as' => 'ranking', 'uses' => 'RankingController@index']);
        Route::post('/tablaCalificaciones', ['as' => 'ranking.table', 'uses' => 'RankingController@table']);
        Route::post('/tablaComentarios', ['as' => 'ranking.tableComments', 'uses' => 'RankingController@tableComments']);
    });


});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/run-calendar-seeder', function () {

    require_once base_path('database/seeds/CalendarAutoSeeder.php');

    (new CalendarAutoSeeder)->run();

    return 'Seeder ejecutado correctamente';
});

   