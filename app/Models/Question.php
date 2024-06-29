<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;








    protected $table = 'questions';


    protected $primaryKey='id';

    public $timestamps = true;

    protected $fillable=[
        'question',
        'exam_id',
    ];

    public function exam(){
        return $this->belongsTo('App\Models\Exam');
    }
    public function alternatives(){
        return $this->hasMany('App\Models\Alternative');
    }
}
