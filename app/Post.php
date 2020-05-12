<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'user_id', 'category_id', 'title', 'body', 
    // ];

    protected $guarded = [];

    public function user(){
        
        return $this->belongsTo('App\User');
    }

    public function category(){

        return $this->belongsTo('App\Category');
    }

    public function getImageAttribute($image){

        return 'storage/'.$image;
    }

    public function comments(){

        return $this->hasMany('App\Comment');
    }
}
