<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    
    public $timestamps = true;

    protected $fillable = [
        'name',
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

    public function branches()
    { 
        return $this->belongsToMany(Branch::class ,'branch_activity')->withTimestamps(); 
    }

    public function categories()
    { 
        return $this->belongsToMany(Section::class ,'activity_section')->withTimestamps(); 
    }
    
    function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
