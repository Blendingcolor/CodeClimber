<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleProfile extends Model
{
    use HasFactory;

    protected $table = 'module_profile';

    protected $fillable = [
        'module_id',
        'profile_id',
        'exam_status',
        'start_date',
        'end_date'
    ];

    // Relaciones
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
