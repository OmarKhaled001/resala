<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    
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
        return $this->belongsToMany(Branche::class ,'branche_section')->withTimestamps(); 
    }

    public function categories()
    { 
        return $this->belongsToMany(Category::class ,'category_section')->withTimestamps(); 
    }
    
    function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
