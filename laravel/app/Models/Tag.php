<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getHashTagAttribute()
    {
        return '#'.$this->name;
    }
    
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article')->withTimestamps();
    }


}
