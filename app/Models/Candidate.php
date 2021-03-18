<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function election(){
        return $this->belongsTo('App\Models\Election');
    }

    public function votes(){
        return $this->hasMany('App\Models\Vote');
    }
}
