<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use Inertia\Inertia;

class ClientesController extends Controller
{
    //
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->query('search');

        // Consulta base 
        $query = Clientes::query();

        // Aplicar búsqueda si hay un término
        if ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")
            ->orWhere('ciudad', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('telefono', 'LIKE', "%{$search}%");
        }

        // Paginar los resultados
        //$clientes = $query->paginate(10);
        // Paginar los resultados y conservar el parámetro de búsqueda
        $clientes = $query->paginate(10)->appends(['search' => $search]);

        // Retornar la vista de Inertia con los datos
        return Inertia::render('Clientes/Index', [
            'clientes' => $clientes,
            'filters' => $request->only(['search']),
        ]);
    }
}
