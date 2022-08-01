<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    public $table = 'list';
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class,'item_list')->withPivot('quantity');
    }
}
