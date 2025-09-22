<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'apellidos',
        'telefono',
        'direccion',
        'password'
    ];

     // RELACIONES
    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function business() {
        return $this->belongsTo(Business::class);
    }


    
    protected $allowIncluded = ['services','business'];
    protected $allowFilter   = ['id','name','email'];
    protected $allowSort     = ['id','name','email'];


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
