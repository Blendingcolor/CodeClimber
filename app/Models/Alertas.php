<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertas extends Model
{
    use HasFactory;

    protected $table = 'alertas';

    protected $primaryKey='id';

    public $timestamps = true;

    protected $fillable=[
        'ruta',
        'problema',
        'descripcion_del_problema',
        'fecha_del_problema',
        'usuario_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
