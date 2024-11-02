<?php
// ChefSpecialty Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class ChefSpecialty extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = ['name'];

    public function chefs()
    {
        return $this->belongsToMany(Chef::class, 'chef_chef_specialty', 'chef_specialty_id', 'chef_id'); // Fixed foreign key names
    }
}
