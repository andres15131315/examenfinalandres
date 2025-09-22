<?php
// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasApiScopes;

class Appointment extends Model
{
    use HasApiScopes;

    protected $fillable = [
        'business_id','user_id','service_id','status_id',
        'nota','fecha','fecha_fin','hora_inicio','hora_limite','descripcion_cancelacion'
    ];

    protected $allowIncluded = ['business','user','service','status'];
    protected $allowFilter   = ['id','fecha','business_id'];
    protected $allowSort     = ['id','fecha'];

    // Relaciones
    public function business() { return $this->belongsTo(Business::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function status() { return $this->belongsTo(Status::class); }

    
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
