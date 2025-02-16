<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionVisita extends Model
{
    /** @use HasFactory<\Database\Factories\InformacionVisitaFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'avaluo_id',
        'visitador_id',
        'celular',
        'direccion',
        'ciudad',
        'fecha_visita',
        'observaciones',

    ];

    public function visitadores(){
        return $this->belongsTo(Visitadores::class);
    }

    public function avaluos(){
        return $this->belongsTo(Avaluos::class);
    }
}
