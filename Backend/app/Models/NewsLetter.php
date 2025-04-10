<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];

    public function subscribers()
    {
        return $this->hasMany(Subscribers::class);
    }
}
