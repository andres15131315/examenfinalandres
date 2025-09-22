<?php
// app/Models/Agenda.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasApiScopes;

class Agenda extends Model
{
    use HasApiScopes;

    protected $fillable = ['nombre','horarios','active','business_id','service_id','user_id'];

    protected $allowIncluded = ['business','service','user'];
    protected $allowFilter   = ['id','nombre','business_id'];
    protected $allowSort     = ['id','nombre'];

    // Relaciones
    public function business() { return $this->belongsTo(Business::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function user() { return $this->belongsTo(User::class); }

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
