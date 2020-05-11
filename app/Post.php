<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['judul', 'category_id', 'content', 'gambar', 'slug', 'users_id'];

    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
    
    public function users(){
        return $this->belongsTo('App\User');
    }
}
