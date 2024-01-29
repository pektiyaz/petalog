<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function members(){
        return $this->hasMany(TeamMember::class, 'team_id','id');
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
