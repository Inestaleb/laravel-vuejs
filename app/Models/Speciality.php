<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table='specialities';
    protected $fillable = [
        'name',
        'image'
    ];
    public function doctor(){
        return $this->hasMany(User::class);
    }
}
