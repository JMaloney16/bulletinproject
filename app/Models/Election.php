<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'open'
    ];

    public function candidates(){
        return $this->hasMany('App\Models\Candidate');
    }
}
