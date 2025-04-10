<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{

    protected $fillable= [
        'email',
        'newsletter_id',
    ];

    public function newsletter(){
        return $this->belongsToMany(NewsLetter::class);
    }
}
