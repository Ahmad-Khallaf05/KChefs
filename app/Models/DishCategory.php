<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{
    use HasFactory;

    protected $table = 'dish_categories';

    protected $primaryKey = 'dish_category_id';

    protected $fillable = ['dish_category_name', 'description', 'image_path'];
}
