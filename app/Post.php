<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','slug','content','featured_image','category_id'];

    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    

}
