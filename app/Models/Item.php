<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = 'item';
    use HasFactory;

    /**
     * Get the category that owns the comment.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lists()
    {
        return $this->belongsToMany(Lista::class,'item_list')->withPivot('quantity');
    }

}
