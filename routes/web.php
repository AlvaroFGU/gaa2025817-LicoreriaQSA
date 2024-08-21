<?php
use App\Http\Controllers\AdelantosController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\EmpleadoVMController;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\SueldossalariosController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresVMController;
use App\Http\Controllers\TransaccionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


// Ruta pública del catálogo
Route::get('/catalogo', [ProductosController::class, 'catalogo'])->name('catalogo.index');

// Redirigir la ruta raíz (/) al catálogo
Route::get('/', function () {
    return redirect()->route('catalogo.index');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de restablecimiento de contraseña
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::view('/acceso-denegado', 'access_denied')->name('access.denied');

// Agrupar las rutas protegidas por el middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('layouts.inicio');
    })->name('inicio')->middleware('check.permission:0');

    Route::prefix('personas')->group(function () {
        Route::get('/', [PersonasController::class, 'index'])->name('personas.index')->middleware('check.permission:0');
        Route::get('/create', [PersonasController::class, 'create'])->name('personas.create')->middleware('check.permission:0');
        Route::post('/', [PersonasController::class, 'store'])->name('personas.store')->middleware('check.permission:0');
        Route::get('/{id}', [PersonasController::class, 'show'])->name('personas.show')->middleware('check.permission:0');
        Route::get('/{id}/edit', [PersonasController::class, 'edit'])->name('personas.edit')->middleware('check.permission:0');
        Route::put('/{id}', [PersonasController::class, 'update'])->name('personas.update')->middleware('check.permission:0');
    });

    Route::prefix('sueldossalarios')->group(function () {
        Route::get('/', [SueldossalariosController::class, 'index'])->name('sueldossalarios.index')->middleware('check.permission:36');
        Route::get('/create', [SueldossalariosController::class, 'create'])->name('sueldossalarios.create')->middleware('check.permission:37');
        Route::post('/', [SueldossalariosController::class, 'store'])->name('sueldossalarios.store')->middleware('check.permission:37');
        Route::get('/{sueldossalario}', [SueldossalariosController::class, 'show'])->name('sueldossalarios.show')->middleware('check.permission:36');
        Route::get('/{sueldossalario}/edit', [SueldossalariosController::class, 'edit'])->name('sueldossalarios.edit')->middleware('check.permission:38');
        Route::put('/{sueldossalario}', [SueldossalariosController::class, 'update'])->name('sueldossalarios.update')->middleware('check.permission:38');
        Route::delete('/{sueldossalario}', [SueldossalariosController::class, 'destroy'])->name('sueldossalarios.destroy')->middleware('check.permission:39');
    });

    Route::prefix('sucursales')->group(function () {
        Route::get('/', [SucursalesController::class, 'index'])->name('sucursales.index')->middleware('check.permission:26');
        Route::get('/create', [SucursalesController::class, 'create'])->name('sucursales.create')->middleware('check.permission:27');
        Route::post('/', [SucursalesController::class, 'store'])->name('sucursales.store')->middleware('check.permission:27');
        Route::get('/{sucursal}', [SucursalesController::class, 'show'])->name('sucursales.show')->middleware('check.permission:26');
        Route::get('/{sucursal}/edit', [SucursalesController::class, 'edit'])->name('sucursales.edit')->middleware('check.permission:28');
        Route::put('/{sucursal}', [SucursalesController::class, 'update'])->name('sucursales.update')->middleware('check.permission:28');
        Route::delete('/{sucursal}', [SucursalesController::class, 'destroy'])->name('sucursales.destroy')->middleware('check.permission:29');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('roles.index')->middleware('check.permission:31');
        Route::get('/create', [RolesController::class, 'create'])->name('roles.create')->middleware('check.permission:32');
        Route::post('/', [RolesController::class, 'store'])->name('roles.store')->middleware('check.permission:32');
        Route::get('/{rol}', [RolesController::class, 'show'])->name('roles.show')->middleware('check.permission:31');
        Route::get('/{rol}/edit', [RolesController::class, 'edit'])->name('roles.edit')->middleware('check.permission:33');
        Route::put('/{rol}', [RolesController::class, 'update'])->name('roles.update')->middleware('check.permission:33');
        Route::delete('/{rol}', [RolesController::class, 'destroy'])->name('roles.destroy')->middleware('check.permission:34');
    });

    Route::prefix('empleados')->group(function () {
        Route::get('/', [EmpleadoVMController::class, 'index'])->name('empleados.index')->middleware('check.permission:6');
        Route::get('/create', [EmpleadoVMController::class, 'create'])->name('empleados.create')->middleware('check.permission:7');
        Route::post('/', [EmpleadoVMController::class, 'store'])->name('empleados.store')->middleware('check.permission:7');
        Route::get('/{id}', [EmpleadoVMController::class, 'show'])->name('empleados.show')->middleware('check.permission:6');
        Route::get('/{id}/edit', [EmpleadoVMController::class, 'edit'])->name('empleados.edit')->middleware('check.permission:8');
        Route::put('/{id}', [EmpleadoVMController::class, 'update'])->name('empleados.update')->middleware('check.permission:8');
        Route::delete('/{id}', [EmpleadoVMController::class, 'destroy'])->name('empleados.destroy')->middleware('check.permission:9');
        Route::get('/{id}/adelanto', [AdelantosController::class, 'create'])->name('empleados.adelanto')->middleware('check.permission:10');
        Route::post('/{id}/adelanto', [AdelantosController::class, 'store'])->name('adelantos.store')->middleware('check.permission:10');
    });

    Route::prefix('marcas')->group(function () {
        Route::get('/', [MarcasController::class, 'index'])->name('marcas.index')->middleware('check.permission:16');
        Route::get('/create', [MarcasController::class, 'create'])->name('marcas.create')->middleware('check.permission:17');
        Route::post('/', [MarcasController::class, 'store'])->name('marcas.store')->middleware('check.permission:17');
        Route::get('/{id}', [MarcasController::class, 'show'])->name('marcas.show')->middleware('check.permission:16');
        Route::get('/{id}/edit', [MarcasController::class, 'edit'])->name('marcas.edit')->middleware('check.permission:18');
        Route::put('/{id}', [MarcasController::class, 'update'])->name('marcas.update')->middleware('check.permission:18');
        Route::delete('/{id}', [MarcasController::class, 'destroy'])->name('marcas.destroy')->middleware('check.permission:19');
    });

    Route::prefix('proveedores')->group(function () {
        Route::get('/', [ProveedoresVMController::class, 'index'])->name('proveedores.index')->middleware('check.permission:21');
        Route::get('/create', [ProveedoresVMController::class, 'create'])->name('proveedores.create')->middleware('check.permission:22');
        Route::post('/', [ProveedoresVMController::class, 'store'])->name('proveedores.store')->middleware('check.permission:22');
        Route::get('/{id}', [ProveedoresVMController::class, 'show'])->name('proveedores.show')->middleware('check.permission:21');
        Route::get('/{id}/edit', [ProveedoresVMController::class, 'edit'])->name('proveedores.edit')->middleware('check.permission:23');
        Route::put('/{id}', [ProveedoresVMController::class, 'update'])->name('proveedores.update')->middleware('check.permission:23');
        Route::delete('/{id}', [ProveedoresVMController::class, 'destroy'])->name('proveedores.destroy')->middleware('check.permission:24');
    });

    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductosController::class, 'index'])->name('productos.index')->middleware('check.permission:11');

        Route::get('/export', [ProductosController::class, 'export'])->name('productos.export')->middleware('check.permission:11');

        Route::get('/create', [ProductosController::class, 'create'])->name('productos.create')->middleware('check.permission:12');
        Route::post('/', [ProductosController::class, 'store'])->name('productos.store')->middleware('check.permission:12');
        Route::get('/{id}', [ProductosController::class, 'show'])->name('productos.show')->middleware('check.permission:11');
        Route::get('/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit')->middleware('check.permission:13');
        Route::put('/{id}', [ProductosController::class, 'update'])->name('productos.update')->middleware('check.permission:13');
        Route::delete('/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy')->middleware('check.permission:14');
        Route::get('/{id}/distribucion', [ProductosController::class, 'distribucion'])->name('productos.distribucion')->middleware('check.permission:14');

        Route::post('/{id}/distribucion', [ProductosController::class, 'distribuido'])->name('productos.distribuido')->middleware('check.permission:14');
        Route::put('/{id}/distribucion', [ProductosController::class, 'updateDistribucion'])->name('productos.updateDistribucion')->middleware('check.permission:14');
    });

    Route::prefix('compras')->group(function () {
        Route::get('/', [ComprasController::class, 'index'])->name('compras.index')->middleware('check.permission:41');
        Route::get('/create', [ComprasController::class, 'create'])->name('compras.create')->middleware('check.permission:42');
        Route::post('/', [ComprasController::class, 'store'])->name('compras.store')->middleware('check.permission:42');
        Route::get('/{id}', [ComprasController::class, 'show'])->name('compras.show')->middleware('check.permission:41');
        Route::get('/{id}/edit', [ComprasController::class, 'edit'])->name('compras.edit')->middleware('check.permission:43');
        Route::put('/{id}', [ComprasController::class, 'update'])->name('compras.update')->middleware('check.permission:43');
        Route::delete('/{id}', [ComprasController::class, 'destroy'])->name('compras.destroy')->middleware('check.permission:44');
    });

    Route::prefix('transacciones')->group(function () {
        Route::get('/', [TransaccionesController::class, 'index'])->name('transacciones.index')->middleware('check.permission:46');
        Route::get('/export', [TransaccionesController::class, 'export'])->name('transacciones.export')->middleware('check.permission:46');

        Route::get('/create', [TransaccionesController::class, 'create'])->name('transacciones.create')->middleware('check.permission:47');
        Route::post('/', [TransaccionesController::class, 'store'])->name('transacciones.store')->middleware('check.permission:47');
        Route::get('/{id}', [TransaccionesController::class, 'show'])->name('transacciones.show')->middleware('check.permission:46');
        Route::get('/{id}/edit', [TransaccionesController::class, 'edit'])->name('transacciones.edit')->middleware('check.permission:48');
        Route::put('/{id}', [TransaccionesController::class, 'update'])->name('transacciones.update')->middleware('check.permission:48');
        Route::delete('/{id}', [TransaccionesController::class, 'destroy'])->name('transacciones.destroy')->middleware('check.permission:49');
    });

    Route::prefix('inventarios')->group(function () {
        Route::get('/', [InventariosController::class, 'index'])->name('inventarios.index')->middleware('check.permission:41');
        Route::get('/create', [InventariosController::class, 'create'])->name('inventarios.create')->middleware('check.permission:42');
        Route::post('/', [InventariosController::class, 'store'])->name('inventarios.store')->middleware('check.permission:42');
        Route::get('/{id}', [InventariosController::class, 'show'])->name('inventarios.show')->middleware('check.permission:41');
        Route::get('/{id}/edit', [InventariosController::class, 'edit'])->name('inventarios.edit')->middleware('check.permission:43');
        Route::put('/{id}', [InventariosController::class, 'update'])->name('inventarios.update')->middleware('check.permission:43');
        Route::delete('/{id}', [InventariosController::class, 'destroy'])->name('inventarios.destroy')->middleware('check.permission:44');
    });

    Route::prefix('pagos')->group(function () {
        Route::get('/', [PagosController::class, 'index'])->name('pagos.index')->middleware('check.permission:41');
        Route::get('/create', [PagosController::class, 'create'])->name('pagos.create')->middleware('check.permission:42');
        Route::post('/', [PagosController::class, 'store'])->name('pagos.store')->middleware('check.permission:42');
        Route::get('/{id}', [PagosController::class, 'show'])->name('pagos.show')->middleware('check.permission:41');
        Route::get('/{id}/edit', [PagosController::class, 'edit'])->name('pagos.edit')->middleware('check.permission:43');
        Route::put('/{id}', [PagosController::class, 'update'])->name('pagos.update')->middleware('check.permission:43');
        Route::delete('/{id}', [PagosController::class, 'destroy'])->name('pagos.destroy')->middleware('check.permission:44');
    });
    // Ruta para servir el PDF
Route::get('descargar-pdf', function () {
    $pdfPath = session('pdf_path');
    if ($pdfPath && Storage::exists('public/' . $pdfPath)) {
        $fullPath = storage_path('app/public/' . $pdfPath);
        return response()->download($fullPath)->deleteFileAfterSend(true);
    }
    return redirect()->route('transacciones.index');
})->name('descargar.pdf');

});
