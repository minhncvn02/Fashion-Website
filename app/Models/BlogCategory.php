<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'blog_category';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getSingleSlug($slug){
        return self::where('slug','=', $slug)
        ->where('blog_category.status', '=',1)
        ->where('blog_category.is_delete', '=',0)
        ->first();
    }

    static public function getRecord(){
        return self::select('blog_category.*')
        ->where('blog_category.is_delete', '=',0)
        ->orderBy('blog_category.id', 'asc')
        ->get();
    }

    static public function getRecordActive(){
        return self::select('blog_category.*')
        ->where('blog_category.is_delete', '=',0)
        ->where('blog_category.status', '=',1)
        ->orderBy('blog_category.name', 'asc')
        ->get();
    }

    static public function getRecordActiveHome(){
        return self::select('blog_category.*')
        ->where('blog_category.is_delete', '=',0)
        ->where('blog_category.is_home', '=',1)
        ->where('blog_category.status', '=',1)
        ->orderBy('blog_category.name', 'asc')
        ->get();
    }

}
