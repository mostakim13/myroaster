<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public   $rules = [

        'name' => 'required',
    ];
    protected $fillable = [

        'name',
        'email',
        'password',
        'super_admin',
        'is_admin',
        'created_at',
        'status',
        'job_type',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'id', 'user_id');
    }
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'id', 'userID');
    }
}