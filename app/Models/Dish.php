<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes';
    protected $primaryKey = 'dishe_id';

    protected $fillable = [
        'dishe_title',
        'dishe_description',
        'price',
        'image_id', 
        'chef_id',
        'dish_category_id',
    ];

    public function chef()
    {
        return $this->belongsTo(Chef::class, 'chef_id', 'chef_id');
    }

    public function category() 
    {
        return $this->belongsTo(DishCategory::class, 'dish_category_id', 'dish_category_id');
    }

    public function images()
    {
        return $this->hasMany(DishImage::class, 'dishe_id', 'dishe_id'); 
    }

    public function primaryImage()
    {
        return $this->belongsTo(DishImage::class, 'image_id', 'image_id'); 
    }
}
