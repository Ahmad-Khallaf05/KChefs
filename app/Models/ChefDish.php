<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChefDish extends Model
{
    protected $table = 'chef_dish';

    public function chef()
    {
        return $this->belongsTo(Chef::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
