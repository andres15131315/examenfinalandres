<?php
// app/Models/Customization.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasApiScopes;

class Customization extends Model
{
    use HasApiScopes;

    protected $fillable = [
        'business_id','nombre','eslogan','descripcion','color_principal',
        'color_secundario','color_texto','color_fondo','logo_p','logo_s',
        'favicon','duracion_sesion','anticipacion_minima','horario_inicio',
        'horario_atencion','dias_laborales','maximo_citas','titulo',
        'mensaje_bienvenida','mensaje_confirmacion','texto_footer'
    ];

    protected $allowIncluded = ['business'];
    protected $allowFilter   = ['id','nombre','business_id'];
    protected $allowSort     = ['id','nombre'];

    // Relaciones
    public function business() { return $this->belongsTo(Business::class); }

    
      public function scopeFilter(Builder $query) {
        if(empty(request('filter'))) return;
        foreach(request('filter') as $field => $value){
            if(in_array($field,$this->allowFilter)){
                $query->where($field,'LIKE',"%$value%");
            }
        }
    }

    public function scopeIncluded(Builder $query){
        if(empty(request('included'))) return;
        $relations = explode(',',request('included'));
        $relations = array_intersect($relations,$this->allowIncluded);
        $query->with($relations);
    }
}
