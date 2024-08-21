<?php
namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\inventarios;
use App\Models\marcas;
use App\Models\productos;
use App\Models\sucursales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 


class ProductosController extends Controller
{

    public function export()
    {
        return Excel::download(new ProductsExport, 'productos.csv');
    }
    public function index()
    {
        $productos = productos::where('Activo', 1)->with('marca')->paginate(15);
        $marcas = marcas::where('Activo', 1)->get();
        return view('productos.index', compact('productos', 'marcas'));
    }

    public function catalogo()
    {
        $productos = productos::where('Activo', 1)->with('marca')->paginate(40);
        $marcas = marcas::where('Activo', 1)->get();
        return view('productos.catalogo', compact('productos', 'marcas'));
    }

    
    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->Activo = 0;
        $producto->save();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function create()
    {
        $marcas = Marcas::where('Activo', 1)->get();
        return view('productos.create', compact('marcas'));
    }

    public function store(Request $request)
{
    $request->validate([
        'Nombre' => 'required|string|max:50',
        'Precio' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/|max:1000000000|min:0',
        'Descripcion' => 'required|string|max:200',
        'Modelo' => 'required|string|max:100',
        'MarcaId' => 'required|exists:marcas,MarcaId',
        'ImagenUrl' => 'nullable|file|max:2048', // Validar como archivo
    ], [
        'Nombre.required' => 'El campo Nombre es obligatorio.',
        'Nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
        'Nombre.max' => 'El campo Nombre no debe tener más de 50 caracteres.',
        'Precio.required' => 'El campo Precio es obligatorio.',
        'Precio.regex' => 'El campo Precio debe ser un número con hasta dos decimales.',
        'Precio.max' => 'El campo Precio debe ser de 10 digitos como maximo.',
        'Precio.min' => 'El campo Precio debe ser al menos 0.',
        'Descripcion.required' => 'El campo Descripción es obligatorio.',
        'Descripcion.string' => 'El campo Descripción debe ser una cadena de texto.',
        'Descripcion.max' => 'El campo Descripción no debe tener más de 200 caracteres.',
        'Modelo.required' => 'El campo Modelo es obligatorio.',
        'Modelo.string' => 'El campo Modelo debe ser una cadena de texto.',
        'Modelo.max' => 'El campo Modelo no debe tener más de 100 caracteres.',
        'MarcaId.required' => 'El campo Marca es obligatorio.',
        'MarcaId.exists' => 'La marca seleccionada no es válida.',
        'ImagenUrl.file' => 'El archivo debe ser válido.',
        'ImagenUrl.max' => 'La imagen no debe ser mayor a 2MB.',
    ]);

    $data = $request->only('Nombre', 'Precio', 'Descripcion', 'Modelo', 'MarcaId');

    // Convertir campos a mayúsculas
    $data['Nombre'] = strtoupper($data['Nombre']);
    $data['Descripcion'] = strtoupper($data['Descripcion']);
    $data['Modelo'] = strtoupper($data['Modelo']);

    if ($request->hasFile('ImagenUrl')) {
        $file = $request->file('ImagenUrl');

        // Validar manualmente si el archivo es una imagen
        $mimeType = $file->getMimeType();
        $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        if (!in_array($mimeType, $validMimeTypes)) {
            return back()->withErrors(['ImagenUrl' => 'El archivo debe ser una imagen (jpeg, png, jpg, gif, svg).'])->withInput();
        }

        $dirPath = public_path('assets/images/imgCatalogo');
        if (!File::exists($dirPath)) {
            File::makeDirectory($dirPath, 0755, true, true);
        }

        // Guardar el archivo en la carpeta especificada
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($dirPath, $filename);

        $data['ImagenUrl'] = 'assets/images/imgCatalogo/' . $filename;
    }

    $sucursales = sucursales::where('Activo', 1)->get();
    $producto = Productos::create($data);
    foreach($sucursales as $sucursal){
        inventarios::create([
            'ProductoId' => $producto->ProductoId,
            'SucursalId' => $sucursal->SucursalId,
            'Cantidad' => 0, 
        ]);
    }

    return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
}

    public function distribucion(string $id){
        $producto = Productos::findOrFail($id);
        $inventarios = inventarios::where('Activo', 1)->where('ProductoId', $id)->with('sucursal')->get();
        return view('productos.inventario', compact('producto', 'inventarios'));
    }

    public function updateDistribucion(Request $request, string $id)
    {
        $producto = Productos::findOrFail($id);
        $inventariosInput = $request->input('inventarios', []);
        if (empty($inventariosInput)) {
            return redirect()->route('productos.index')->with('error', 'No se realizo cambios datos de inventarios.');
        }
        // Validar que la suma de inventarios no exceda la cantidad del producto
        $totalInventarios = array_sum($request->input('inventarios', []));
        if ($totalInventarios > $producto->Cantidad) {
            return back()->withErrors(['La suma de los inventarios no puede superar la cantidad del producto.'])->withInput();
        }

        // Actualizar los inventarios
        foreach ($request->inventarios as $sucursalId => $cantidad) {
            $inventario = inventarios::where('ProductoId', $producto->ProductoId)
                                     ->where('SucursalId', $sucursalId)
                                     ->first();

            if ($inventario) {
                $inventario->update(['Cantidad' => $cantidad]);
            } else {
                // Si no existe un inventario para esta sucursal, crear uno nuevo
                inventarios::create([
                    'ProductoId' => $producto->ProductoId,
                    'SucursalId' => $sucursalId,
                    'Cantidad' => $cantidad,
                ]);
            }
        }

        return redirect()->route('productos.index')->with('success', 'Inventarios actualizados correctamente.');
    }

    public function show(string $id)
    {
        $producto = Productos::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = Productos::findOrFail($id);
        $marcas = Marcas::where('Activo', 1)->get();
        return view('productos.edit', compact('producto', 'marcas'));
    }

    public function update(Request $request, string $id)
{
    $request->validate([
        'Nombre' => 'required|string|max:50',
        'Precio' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/|max:1000000000|min:0',
        'Descripcion' => 'required|string|max:200',
        'Modelo' => 'required|string|max:100',
        'MarcaId' => 'required|exists:marcas,MarcaId',
        'ImagenUrl' => 'nullable|file|max:2048', // Validar como archivo
    ], [
        'Nombre.required' => 'El campo Nombre es obligatorio.',
        'Nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
        'Nombre.max' => 'El campo Nombre no debe tener más de 50 caracteres.',
        'Precio.required' => 'El campo Precio es obligatorio.',
        'Precio.regex' => 'El campo Precio debe ser un número con hasta dos decimales.',
        'Precio.max' => 'El campo Precio debe ser de 10 digitos como maximo.',
        'Precio.min' => 'El campo Precio debe ser al menos 0.',
        'Descripcion.required' => 'El campo Descripción es obligatorio.',
        'Descripcion.string' => 'El campo Descripción debe ser una cadena de texto.',
        'Descripcion.max' => 'El campo Descripción no debe tener más de 200 caracteres.',
        'Modelo.required' => 'El campo Modelo es obligatorio.',
        'Modelo.string' => 'El campo Modelo debe ser una cadena de texto.',
        'Modelo.max' => 'El campo Modelo no debe tener más de 100 caracteres.',
        'MarcaId.required' => 'El campo Marca es obligatorio.',
        'MarcaId.exists' => 'La marca seleccionada no es válida.',
        'ImagenUrl.file' => 'El archivo debe ser válido.',
        'ImagenUrl.max' => 'La imagen no debe ser mayor a 2MB.',
    ]);

    $producto = Productos::findOrFail($id);
    $data = $request->only('Nombre', 'Precio', 'Descripcion', 'Modelo', 'MarcaId');

    // Convertir campos a mayúsculas
    $data['Nombre'] = strtoupper($data['Nombre']);
    $data['Descripcion'] = strtoupper($data['Descripcion']);
    $data['Modelo'] = strtoupper($data['Modelo']);

    if ($request->hasFile('ImagenUrl')) {
        // Borra la imagen anterior si existe
        if ($producto->ImagenUrl && File::exists(public_path($producto->ImagenUrl))) {
            File::delete(public_path($producto->ImagenUrl));
        }

        $file = $request->file('ImagenUrl');

        // Validar manualmente si el archivo es una imagen
        $mimeType = $file->getMimeType();
        $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
        if (!in_array($mimeType, $validMimeTypes)) {
            return back()->withErrors(['ImagenUrl' => 'El archivo debe ser una imagen (jpeg, png, jpg, gif, svg).'])->withInput();
        }

        $dirPath = public_path('assets/images/imgCatalogo');
        if (!File::exists($dirPath)) {
            File::makeDirectory($dirPath, 0755, true, true);
        }

        // Guardar el archivo en la carpeta especificada
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($dirPath, $filename);

        $data['ImagenUrl'] = 'assets/images/imgCatalogo/' . $filename;
    }

    $producto->update($data);

    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
}

}
