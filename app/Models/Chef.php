<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'phone',
        'bio',
        'profile_picture',
    ];

    protected $table = 'chefs';
    protected $primaryKey = 'chef_id';

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'chef_id', 'chef_id');
    }
}
