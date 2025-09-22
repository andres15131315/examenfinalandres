<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'estado_id',
        'tipo_servicio_id',
        'planes_id',
    ];

    // =====================
    // INCLUSIONES
    // =====================
  public function scopeIncluded($query)
{
    if (!request()->has('included')) {
        return $query;
    }

    $relations = explode(',', request('included'));
    return $query->with($relations);
}


   
    // FILTROS
   public function scopeFilter($query)
{
    if (!request()->has('filter')) {
        return $query;
    }

    foreach (request('filter') as $field => $value) {
        if ($field && $value) {
            $query->where($field, 'LIKE', "%$value%");
        }
    }

    return $query;
}

    // =====================
    // RELACIONES
    // =====================
    public function customizations()
    {
        return $this->hasMany(Customization::class, 'negocios_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'negocios_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'negocios_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'negocios_id');
    }
}
