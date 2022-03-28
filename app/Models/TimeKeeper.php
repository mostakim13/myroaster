<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeKeeper extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ="time_keepers";
    public function employee(){
        return $this->belongsTo('App\Models\Employee','employeeID');
    }
    public function client(){
        return $this->belongsTo('App\Models\Client','clientID');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project','projectID');
    }
}
