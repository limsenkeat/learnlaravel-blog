<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        
        return $this->belongsTo('App\Role');
    }

    public function setPasswordAttribute($password){
        
        if(!empty($password)){
            $this->attributes['password'] = Hash::make($password);
        }
    }

    public function getImageAttribute($image){

        return 'storage/'.$image;
    }

    public function isAdmin(){

        if($this->role_id == 1){
            return true;
        }

        return false;
    }

    public function posts(){
        
        return $this->hasMany('App\Post');
    }

}
