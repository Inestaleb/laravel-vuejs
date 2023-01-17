<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
class time extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='times';
       protected $fillable = [
        'doctor_id',
        'time',
        'date'
    ];
    public function appointement()
    {
        return $this->hasOne(Appointment::class,);
    }
}
