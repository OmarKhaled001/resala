<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    protected $table = 'branches';
    
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
    
    public function sections()
    { 
        return $this->belongsToMany(Section::class ,'branche_section')->withTimestamps(); 
    }

    function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
