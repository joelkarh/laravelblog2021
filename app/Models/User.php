<?php

namespace App\Models;

use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'is_active',
        'email',
        'photo_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // deze functie zorgt voor verbinding tussen 1 rol en veel users
    // public function role(){
    //     return $this->belongsTo(Role::class);
    // }
    //een veel op veel relatie related en table.
    // Related verwijst naar de verbonden tabel.
    // Table verwijst naar de tussentabel. Let op voor de schrijfwijze van de tussentabel: 
    // ENKELVOUD en EEN SAMENTREKKING van het user model en het role model met een underscore ertussen.
    public function roles(){
        return $this->belongsToMany('App\Models\Role','user_role' );
    }
}
