<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteers';
    
    public $timestamps = true;

    protected $fillable = [
        'name',
        'notes',
        'branche_id',
        'section_id',
        'category_id',
        'phone',
        'gender',
        'birthdate',
        'voldate',
        'address',
        'status',
        'type',
        'email',
        'password',
        'ashbal',
        'tshirt',
        'meni_camp',
        'camp_48',
    
    ];

    protected $casts = [
        'ashbal' => 'boolean',
        'tshirt' => 'boolean',
        'meni_camp' => 'boolean',
        'camp_48' => 'boolean',
        'email_verified_at' => 'datetime',

    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    public function section()
    { 
        return $this->belongsTo(Section::class); 
    }
    
    public function branche()
    { 
        return $this->belongsTo(Branche::class); 
    }
    
    public function category()
    { 
        return $this->belongsTo(Category::class); 
    }
}
