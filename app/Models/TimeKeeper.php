<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeKeeper extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function employee(){
        return $this->belongsTo('App\Models\Employee','Empid');
    }
    public function client(){
        return $this->belongsTo('App\Models\Client','Clientid');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project','Projectid');
    }
}