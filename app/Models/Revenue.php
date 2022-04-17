<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_name');
    }
    
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_name');
    }
}
