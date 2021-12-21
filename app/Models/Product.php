<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
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
    public function setSlugAttribute()
    {

        $this->attributes['slug'] = Str::slug($this->name, "-") . ".aspx";
    }

    public function viewOnWeb()
    {
        return "<a class='btn btn-sm btn-link' target='_blank' href='" . route("product", $this->slug) . "'><i class ='la la-eye'></i>Preview</a>";
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function Category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function Published()
    {
        return $this->belongsTo(User::class, "published_id", "id");
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class, "product_id", "id");
    }

    public function Tags()
    {
        return $this->belongsToMany(Tag::class, "product_tag", "product_id","tag_id");
    }
    public function guide(){
        return "<a href='https://youtu.be/apiztfHdRZA' class='btn btn-primary text-white'>Xem hướng dẫn đăng ấn phẩm đẹp</a>";
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

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
