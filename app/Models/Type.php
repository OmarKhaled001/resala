<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    
    protected $table = 'types';
    
    public $timestamps = true;

    protected $fillable = [
        'name',
        'value',
        'is_active',
    
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function categories()
    { 
        return $this->belongsToMany(Category::class ,'category_type')->withTimestamps(); 
    }
}
