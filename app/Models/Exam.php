<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;



    protected $table = 'exams';


    protected $primaryKey='id';

    public $timestamps = true;

    protected $fillable=[
        'descripcion',
        'module_id',
    ];






    public function module(){
        return $this->belongsTo('App\Models\Module');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }
}
