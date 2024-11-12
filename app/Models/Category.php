<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    
    public $timestamps = true;

    protected $fillable = [
        'name',
        'notes',
        'is_active',
    
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function sections()
    { 
        return $this->belongsToMany(Section::class ,'category_section')->withTimestamps(); 
    }

    public function types()
    { 
        return $this->belongsToMany(Type::class ,'category_type')->withTimestamps(); 
    }
    
    function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
