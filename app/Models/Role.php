<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
    //deze functie zorgt voor  veel op één verbinding
    // Omgekeerd kan in ons voorbeeld een user MEERDERE ROLLEN krijgen

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
    public function users(){
        return $this->belongsToMany('App\Models\User', 'user_role');
    }
}
