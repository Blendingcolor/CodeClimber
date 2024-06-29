<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $table = 'alternatives';


    protected $primaryKey='id';

    public $timestamps = true;

    protected $fillable=[
        'alternative',
        'question_id',
        'answer_id',
    ];


    public function question(){
        return $this->belongsTo('App\Models\Question');
    }

    public function answer(){
        return $this->belongsTo('App\Models\Answer');
    }
}
