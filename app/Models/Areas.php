<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado;

class Areas extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
