<?php

namespace App\Http\Controllers;
use App\Models\Avaluos;
use Inertia\Inertia;

use Illuminate\Http\Request;

class AvaluosController extends Controller
{
    //
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->query('search');

        // Consulta base
        $query = Avaluos::with('cliente'); // Incluir la relación con el cliente

        // Aplicar búsqueda si hay un término
        if ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhereHas('cliente', function ($q) use ($search) {
                      $q->where('nombre', 'LIKE', "%{$search}%");
                  });
        }

        // Paginar los resultados y conservar el parámetro de búsqueda
        $avaluos = $query->paginate(10)->appends(['search' => $search]);
        //dd($avaluos);
        // Retornar la vista de Inertia con los datos
        return Inertia::render('Avaluos/Index', [
            'avaluos' => $avaluos,
            'filters' => $request->only(['search']),
        ]);
    }
}
