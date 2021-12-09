<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected $table = 'requests';
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

    public function acceptRequest(){
        return "<a class='btn btn-sm btn-link'  href='".route("request.accept",$this->id)."'><i class ='nav-icon las la-check'></i> Đồng ý</a>";

    }
    public function cancelRequest(){
        return "<a class='btn btn-sm btn-link' href='".route("request.cancel",$this->id)."'><i class ='nav-icon las la-ban'></i>Từ chối</a>";

    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function Product(){
        return $this->belongsTo(Product::class,"product_id","id");
    }
    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function Owner(){
        return $this->belongsTo(User::class,"owner_id","id");
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
