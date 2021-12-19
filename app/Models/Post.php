<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'posts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function Accept()
    {
        return $this->showBtnAccept($this->status, $this->id);
    }

    public function showBtnAccept($status, $id)
    {
        if ($status == 0) {
            $value = 1;
            return "<a class='btn btn-sm btn-link' href='" . route("post.change-status", ['id' => $this->id, 'status' => $value]) . "'><i class ='las la-check'></i> Đăng tải</a>";
        }
    }
    public function Draft()
    {
        return $this->showBtnDraft($this->status, $this->id);
    }

    public function showBtnDraft($status, $id)
    {
        if ($status == 1) {
            $value = 0;
            return "<a class='btn btn-sm btn-link' href='" . route("post.change-status", ['id' => $this->id, 'status' => $value]) . "'><i class ='las la-ban'></i> Ẩn bài </a>";
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function User()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function Crawler(){
        require_once "simple_html_dom.php";
        $html = str_get_html($this->content);
        if($ret = $html->find('<img>',0)){
            return $ret->src;
        }else{
            $search_query = $this->name;
            $search_query = urlencode( $search_query );
            $html = file_get_html( "https://www.google.com/search?q=$search_query&tbm=isch" );
//            $image_container = $html->find('div#rcnt', 0);
            $rs=$html->find("<img>",random_int(2,10));
            return $rs->src;
//            $images = $image_container->find('img');
//            $image_count = 10; //Enter the amount of images to be shown
//            $i = 0;
//            foreach($images as $image){
//                if($i == $image_count) break;
//                $i++;
//                // DO with the image whatever you want here (the image element is '$image'):
//                echo $image;
//            }
        }
    }
    public function ContentTrim(){
        $data = preg_replace('/<[^>]*>/', '', $this->content);
//        return $data;
        return substr($data, 0, 200)."...";
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
