<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eps extends Model
{
    use HasFactory;

    protected $table = 'eps';
    
    protected $fillable = [
        'nombre',
        'nit',
        'direccion',
        'telefono',
        'email',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación con pacientes
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
