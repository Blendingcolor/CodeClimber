<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    //Relacion uno a muchos
    public function modules()
    {
        return $this->hasMany('App\Models\Module');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
}
