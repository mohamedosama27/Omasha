<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function images()
    {
        return $this->hasMany(image::class);
    }
    public function orders()
    {
        return $this->belongsToMany(order::class);
    }
}
