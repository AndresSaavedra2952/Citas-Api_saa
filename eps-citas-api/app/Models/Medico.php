<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'numero_licencia',
        'especialidad_id',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
