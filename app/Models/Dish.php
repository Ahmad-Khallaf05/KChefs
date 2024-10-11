<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes';
    protected $primaryKey = 'dishe_id';

    // Mass assignable attributes
    protected $fillable = [
        'dishe_title',
        'dishe_description',
        'price',
        'image',
        'chef_id',
        'dish_category_id',
    ];

    // A dish belongs to one chef
    public function chef()
    {
        return $this->belongsTo(Chef::class, 'chef_id', 'chef_id');
    }

    // A dish belongs to one dish category
    public function Category()
    {
        return $this->belongsTo(DishCategory::class, 'dish_category_id', 'dish_category_id');
    
    }
}
