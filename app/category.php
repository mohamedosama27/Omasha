<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name', 'is_child', 'parent_category_id'];

    // Relationship to define the parent of this category
    public function parent()
    {
        return $this->belongsTo(category::class, 'parent_category_id');
    }

    // Relationship to define the children of this category
    public function children()
    {
        return $this->hasMany(category::class, 'parent_category_id');
    }
}
