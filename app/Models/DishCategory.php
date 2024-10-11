<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{
    use HasFactory;

    protected $table = 'dish_categories';

    protected $fillable = [
        'category_name',
        'category_description',
    ];

    // One category can have many dishes
    public function dishes()
    {
        return $this->hasMany(Dish::class, 'dish_category_id', 'dish_category_id');
    }
}
