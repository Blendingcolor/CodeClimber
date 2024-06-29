<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';


    protected $primaryKey='id';

    public $timestamps = true;

    protected $fillable=[
        'descripcion',
        'course_id',
    ];

    //Relacion de uno a mucho(inversa)
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
    public function exam(){
        return $this->hasOne('App\Models\Exam');
    }

    public function profiles(){
        return $this->belongsToMany('App\Models\Profile');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'module_id');
    }
}
