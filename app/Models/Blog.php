<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getSingleSlug($slug){
        return self::where('slug','=', $slug)
        ->where('blog.status', '=',1)
        ->where('blog.is_delete', '=',0)
        ->first();
    }

    static public function getRecord(){
        return self::select('blog.*')
        ->where('blog.is_delete', '=',0)
        ->orderBy('blog.id', 'asc')
        ->get();
    }

    static public function getRecordActive(){
        return self::select('blog.*')
        ->where('blog.is_delete', '=',0)
        ->where('blog.status', '=',1)
        ->orderBy('blog.name', 'asc')
        ->get();
    }

    static public function getRecordActiveHome(){
        return self::select('blog.*')
        ->where('blog.is_delete', '=',0)
        ->where('blog.status', '=',1)
        ->orderBy('blog.id', 'desc')
        ->limit(3)
        ->get();
    }



    static public function getBlog(){
        return self::select('blog.*')
        ->where('blog.is_delete', '=',0)
        ->where('blog.status', '=',1)
        ->orderBy('blog.id', 'asc')
        ->paginate(6);
    }


    static public function getPopular(){
        return self::select('blog.*')
        ->where('blog.is_delete', '=',0)
        ->where('blog.status', '=',1)
        ->orderBy('blog.total_view', 'desc')
        ->limit(5)
        ->get();
    }

    public function getImg(){
        if(!empty($this->image_name) && file_exists('upload/blog/'.$this->image_name)){
            return url('upload/blog/'.$this->image_name);
        } else {
            return "";
        }
    }

}
