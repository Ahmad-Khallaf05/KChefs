<?php
// Chef Model
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Chef extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'chef_id', 'chef_id');
    }

    public function specialties()
    {
        return $this->belongsToMany(ChefSpecialty::class, 'chef_chef_specialty', 'chef_id', 'chef_specialty_id'); // Fixed foreign key names
    }
}
