<?php
// app/Models/Plan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasApiScopes;

class Plan extends Model
{
    use HasApiScopes;

    protected $fillable = ['nombre','descripcion','precio','duracion'];

    protected $allowIncluded = ['businesses'];
    protected $allowFilter   = ['id','nombre','precio'];
    protected $allowSort     = ['id','nombre','precio'];

    // Relaciones
    public function businesses() { return $this->hasMany(Business::class); }

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
