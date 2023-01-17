<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Prescriptions extends Model
{
        use HasFactory;
        protected $guarded = [];
       protected $fillable = ['appointment_id','name_of_disease','signature','date','medicine','procedure_to_use_medicine'];
        public function rendezvous()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}

