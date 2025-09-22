<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasApiScopes;

class Role extends Model
{
    use HasApiScopes;

    protected $fillable = ['nombre','permisos'];

    protected $allowIncluded = ['users'];
    protected $allowFilter   = ['id','nombre'];
    protected $allowSort     = ['id','nombre'];

    // Relaciones
    public function users() { return $this->hasMany(User::class); }

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
