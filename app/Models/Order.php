<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
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
    public function AcceptOrder()
    {
        return $this->showBtnAccept($this->status,$this->id);
    }
    public function DoneOrder()
    {
        return $this->showBtnDone($this->status,$this->id);
    }

    public function CancelOrder()
    {
        return $this->showBtnCancel($this->status,$this->id);
    }
    public function showBtnAccept($status,$id){
        if($status==0) {
            return "<a class='btn btn-sm btn-link' href='".route("order.change",['id'=>$this->id,'value'=>1])."'><i class ='las la-check'></i> Xác nhận </a>";
        }
    }
    public function showBtnDone($status,$id){
        if($status==1) {
            return "<a class='btn btn-sm btn-link' href='".route("order.change",['id'=>$this->id,'value'=>2])."'><i class ='las la-check'></i> Đã giao</a>";
        }
    }
    public function showBtnCancel($status,$id){
        if($status!=3 && $status!=2) {
            return "<a class='btn btn-sm btn-link' href='".route("order.change",['id'=>$this->id,'value'=>3])."'><i class ='las la-check'></i> Hủy</a>";
        }
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function Customer()
    {
        return $this->belongsTo(User::class, "customer_id", "id");
    }
    public function Request(){
        return $this->hasMany(Request::class,"order_id","id");
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
