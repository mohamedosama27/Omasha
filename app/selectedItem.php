<?php

namespace App;
use Illuminate\Support\Str; 


class selectedItem
{
    public $id;
    public $item;
    public $Quantity = 0;
    public $price;
    public $style;
    public $style_ar;
    public $size;
    public $color;
    public $color_ar;
    public $note;

    public function __construct($id)
    {
        $this->id = uniqid();

        $this->item =\App\item::find($id);
    }
}
