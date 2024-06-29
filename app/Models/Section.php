<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function content()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }
}

