<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $directory = '/images/';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file'
    ];

    public function getFileAttribute($photo){

        return $this->directory.$photo;
    }
}
