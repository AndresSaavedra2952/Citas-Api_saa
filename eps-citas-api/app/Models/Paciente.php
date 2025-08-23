<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'fecha_nacimiento',
        'tipo_documento',
        'numero_documento',
        'direccion',
        'activo'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo' => 'boolean'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
