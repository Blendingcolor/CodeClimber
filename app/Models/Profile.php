<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    //Relacion muchos a muchos
    public function modules(){
        return $this->belongsToMany('App\Models\Module');
    }

    public function c_answers(){
        return $this->hasMany('App\Models\C_Answer');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
}