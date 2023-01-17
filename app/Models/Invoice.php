<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
        protected $fillable =['amount','appointment_id','date'];

            public function rendezvous()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
     public function Doctor(){
		return $this->belongsTo(User::class,'doctor_id');
	}
}
