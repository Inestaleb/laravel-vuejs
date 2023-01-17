<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Time;
use App\Models\Prescriptions;
class Appointment extends Model
{

    
    use HasFactory;
        protected $fillable = ['date','time_id','type','doctor_id','patient_id'];
    public function Doctor(){
		return $this->belongsTo(User::class,'doctor_id');
	}
    public function Patient(){
		return $this->belongsTo(User::class,'patient_id');
	}
	
	public function temps(){
    	return $this->belongsTo(Time::class,'time_id');
    }
	public function prescreption(){
    	return $this->hasOne(Prescriptions::class);
    }
}