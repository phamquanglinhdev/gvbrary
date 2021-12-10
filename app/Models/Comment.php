<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $guarded=["id"];
    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function Product(){
        return $this->belongsTo(Product::class,"product_id","id");
    }
}
