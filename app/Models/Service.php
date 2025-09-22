<?php
// app/Models/Service.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasApiScopes;

class Service extends Model
{
    use HasApiScopes;

    protected $fillable = [
        'business_id','category_id','nombre','descripcion',
        'duracion','precio','status_id'
    ];

    protected $allowIncluded = ['business','category','status','appointments','agendas'];
    protected $allowFilter   = ['id','nombre','business_id','category_id'];
    protected $allowSort     = ['id','nombre','precio'];

    // Relaciones
    public function business() { return $this->belongsTo(Business::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function status() { return $this->belongsTo(Status::class); }
    public function appointments() { return $this->hasMany(Appointment::class); }
    public function agendas() { return $this->hasMany(Agenda::class); }


    
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
