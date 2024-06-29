<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ClasificatorioUsuario extends Model
{
    protected $table = 'clasificatorio_usuario';

    protected $primaryKey ='id';

    protected $fillable = [
        'user_id',
        'puntaje',
        'examen_completado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public $timestamps = false;

}
