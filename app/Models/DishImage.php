<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishImage extends Model
{
    use HasFactory;

    protected $table = 'dish_images';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'image_path',
        'dishe_id', 
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dishe_id', 'dishe_id');
    }
}
