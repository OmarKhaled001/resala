<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';
    
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function activities()
    { 
        return $this->belongsToMany(Activity::class ,'branch_activity')->withTimestamps(); 
    }

    function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
