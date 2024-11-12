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
        'branch_id',
        'section_id',
        'activity_id',
        'phone',
        'gender',
        'birth_date',
        'vol_date',
        'address',
        'status',
        'type',
        'email',
        'password',
        't-shirt',
        'mine_camp',
        'camp_48',
    
    ];

    protected $casts = [
        't-shirt' => 'boolean',
        'mine_camp' => 'boolean',
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
    
    public function branch()
    { 
        return $this->belongsTo(Branch::class); 
    }
    
    public function activity()
    { 
        return $this->belongsTo(Activity::class); 
    }
}
