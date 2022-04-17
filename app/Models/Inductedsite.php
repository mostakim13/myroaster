<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inductedsite extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
}
