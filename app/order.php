<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function items()
    {
        return $this->belongsToMany(item::class)->withPivot('quantity', 'style', 'size', 'note', 'color', 'price', 'color_ar', 'style_ar');;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
