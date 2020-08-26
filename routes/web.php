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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

/*Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
*/
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


//rutas para conseguir los menus
//Route::get('/home', 'MenuController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

// rutas de competidores
Route::group(['middleware' => 'auth'], function () {
	Route::resource('competencia','CompetitionController');
	Route::post('competencia/create','CompetitionController@create');
	Route::get('competencia/edit/{id}','CompetitionController@edit')->name('competencia.edit');
	Route::post('competencia/update/{id}','CompetitionController@update')->name('competencia.update');
	Route::post('competencia/store','CompetitionController@store');
	Route::post('competencia/edit', 'CompetitionController@edit');
});

// rutas de registro fleteras
Route::group(['middleware' => 'auth'], function () {
	Route::resource('registro_fleteras','NameFreightController');
	Route::post('registro_fleteras/create','NameFreightController@create');
	//Route::get('registro_fleteras/edit/{id}','NameFreightController@edit')->name('registro_fleteras.edit');
	//Route::post('registro_fleteras/update/{id}','NameFreightController@update')->name('registro_fleteras.update');
	Route::post('registro_fleteras/store','NameFreightController@store');
	Route::post('registro_fleteras/edit', 'NameFreightController@edit');
});

// rutas de fleteras
Route::group(['middleware' => 'auth'], function () {
	Route::resource('fleteras','FreightController');
	Route::post('fleteras/create','FreightController@create');
	Route::get('fleteras/edit/{id}','FreightController@edit')->name('fleteras.edit');
	Route::post('fleteras/update/{id}','FreightController@update')->name('fleteras.update');
	Route::post('fleteras/store','FreightController@store');
	Route::post('fleteras/edit', 'FreightController@edit');
});

// rutas de pedidos 
Route::group(['middleware' => 'auth'], function () {
	Route::resource('pedidos','OrderController');
	Route::post('pedidos/update/{id}','OrderController@update')->name('pedidos.update');
	Route::post('pedidos/seleccionado', 'OrderController@seleccionado');
	Route::post('pedidos/create','OrderController@create');
	Route::post('pedidos/store','OrderController@store');
	Route::post('pedidos/edit', 'OrderController@edit');
	Route::get('pedidos/cambiar_status/{id}', 'OrderController@cambiar_status')->name('pedidos.cambiar_status');
	Route::delete('pedidos/destroy/{id}','OrderController@destroy')->name('pedidos.destroy');
	Route::delete('pedidos/destroy_order/{id}','OrderController@destroy_order')->name('pedidos.destroy_order');
	Route::post('pedidos/liberar_flete','OrderController@liberar_flete')->name('pedidos.liberar_flete');
	Route::post('pedidos/sonomber', 'OrderController@sonomber');
	Route::post('pedidos/individual','OrderController@individual')->name('pedidos.individual');
	Route::post('pedidos/emergencia','OrderController@emergencia')->name('pedidos.emergencia');
	Route::post('pedidos/updateEstatus','OrderController@updateEstatus');

	/*Route::post('pedidos/create_flete','OrderController@create_flete')->name('pedidos.crete_flete');
	Route::post('pedidos/store_flete', 'OrderController@store_flete');*/
});
 
// rutas de control
Route::group(['middleware' => 'auth'], function () {
	Route::resource('control','ControlController');
	Route::post('control/create','ControlController@create');
	Route::post('control/store','ControlController@store');
	Route::post('control/seleccionar_tractor','ControlController@seleccionar_tractor');
	Route::post('control/seleccionar_pipa','ControlController@seleccionar_pipa');
	Route::post('control/fletes_contador','ControlController@fletes_contador');
});

// rutas de facturas
Route::group(['middleware' => 'auth'], function () {
	Route::resource('facturas','InvoiceController');
	Route::post('facturas/create','InvoiceController@create');
	Route::post('facturas/store','InvoiceController@store');
});

// rutas de abonos
Route::group(['middleware' => 'auth'], function () {
	Route::resource('abonos','PaymentController');
	Route::post('abonos/create','PaymentController@create');
	Route::post('abonos/store','PaymentController@store');
	Route::delete('abonos/destroy/{id}','PaymentController@destroy')->name('abonos.destroy');
	Route::post('abonos/sal_o_cre', 'PaymentController@sal_o_cre');
});

// rutas de estaciones
Route::group(['middleware' => 'auth'], function () {
	Route::resource('estaciones','EstacionController');
	Route::post('estaciones/update/{id}','EstacionController@update')->name('estaciones.update');
	Route::get('estaciones/{id}', 'EstacionController@show');
	//Route::get('estaciones/show/{id}','EstacionController@show')->name('estaciones.show');
	Route::post('estaciones/create','EstacionController@create');
	Route::post('estaciones/store','EstacionController@store');
	Route::post('estaciones/edit', 'EstacionController@edit');
	Route::delete('estaciones/destroy/{id}','EstacionController@destroy')->name('estaciones.destroy');
});

// rutas de conductores
Route::group(['middleware' => 'auth'], function () {
	Route::resource('conductores','DriverController');
	Route::post('conductores/update/{id}','DriverController@update')->name('conductores.update');
	Route::get('conductores/{id}', 'DriverController@show');
	Route::post('conductores/create','DriverController@create');
	Route::post('conductores/store','DriverController@store');
	Route::post('conductores/edit', 'DriverController@edit');
	Route::delete('conductores/destroy/{id}','DriverController@destroy')->name('conductores.destroy');
});

// rutas de precios
Route::group(['middleware' => 'auth'], function () {
	Route::resource('precio','PriceController');
	Route::post('precio/store', 'PriceController@store');
});

// rutas de pipas
Route::group(['middleware' => 'auth'], function () {
	Route::resource('pipas','PipeController');
	Route::post('pipas/update/{id}','PipeController@update')->name('pipas.update');
	Route::post('pipas/create','PipeController@create');
	Route::post('pipas/store','PipeController@store');
	Route::post('pipas/edit', 'PipeController@edit');
	Route::delete('pipas/destroy/{id}','PipeController@destroy')->name('pipas.destroy');
});

// rutas de tractores
Route::group(['middleware' => 'auth'], function () {
	Route::resource('tractores','TractorController');
	Route::post('tractores/update/{id}','TractorController@update')->name('tractores.update');
	Route::post('tractores/create','TractorController@create');
	Route::post('tractores/store','TractorController@store');
	Route::post('tractores/edit', 'TractorController@edit');
	Route::delete('tractores/destroy/{id}','TractorController@destroy')->name('tractores.destroy');
});

// rutas terminales
Route::group(['middleware' => 'auth'], function () {
	Route::resource('terminales','TerminalController');
	Route::post('terminales/update/{id}','TerminalController@update')->name('terminales.update');
	Route::post('terminales/create','TerminalController@create');
	Route::post('terminales/store','TerminalController@store');
	Route::delete('terminales/destroy/{id}','TerminalController@destroy')->name('terminales.destroy');
});

//rutas pemex
Route::group(['middleware' => 'auth'], function () {
	Route::resource('pemex','PemexController');
	Route::post('pemex/create','PemexController@create');
	Route::post('pemex/store','PemexController@store');
});

// rutas terminales
Route::group(['middleware' => 'auth'], function () {
	Route::resource('fits','FitController');
	Route::post('fits/update/{id}','FitController@update')->name('fits.update');
	Route::post('fits/create','FitController@create');
	Route::post('fits/store','FitController@store');
	Route::delete('fits/destroy/{id}','FitController@destroy')->name('fits.destroy');
});

//rutas cotizador
Route::group(['middleware' => 'auth'], function () {
	Route::resource('cotizador','QuoteController');
	Route::post('cotizador/store','QuoteController@store');
	Route::any('cotizador_sele', 'QuoteController@cotizador_sele');
	Route::any('calendario_selec', 'QuoteController@calendario_selec');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('table_descount','DiscountController');
	Route::post('table_descount/create','DiscountController@create');
	Route::post('table_descount/store','DiscountController@store');
});


//Route::get('estaciones', ['as' => 'estaciones.index', 'uses' => 'EstacionController@index']);
//Route::group(['middleware' => 'auth'], function () {
	//Route::resource('user', 'UserController', ['except' => ['show']]);
	//Route::get('estaciones', ['as' => 'estaciones.index', 'uses' => 'EstacionController@index']);
	//Route::get('estaciones', ['as' => 'estaciones.edit', 'uses' => 'EstacionController@edit']);
	//Route::put('estaciones', ['as' => 'estaciones.update', 'uses' => 'ProfileController@update']);
//});

