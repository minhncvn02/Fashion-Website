<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getTotalOrder(){
        return self::select('id')
        ->where('is_payment', '=', 1)
        ->where('is_delete', '=', 0)
        ->count();
    }

    static public function getTotalTodayOrder(){
        return self::select('id')
        ->where('is_payment', '=', 1)
        ->where('is_delete', '=', 0)
        ->whereDate('created_at', '=', date('Y-m-d'))
        ->count();
    }

    static public function getLatestOrders(){
        return Order::select('orders.*')
        ->where('is_payment', '=', 1)
        ->where('is_delete', '=', 0)
        ->whereDate('created_at', '=', date('Y-m-d'))
        ->get();
    }

    static public function getRecordUser($user_id){
        return Order::select('orders.*')
        ->where('user_id','=', $user_id)
        ->where('is_payment', '=', 1)
        ->where('is_delete','=', 0)
        ->orderBy('id','desc')
        ->get();
    }

    static public function getSingleOrder($user_id, $id){
        return Order::select('orders.*')
        ->where('user_id','=', $user_id)
        ->where('id','=', $id)
        ->where('is_payment', '=', 1)
        ->where('is_delete','=', 0)
        ->orderBy('id','desc')
        ->first();
    }

    static public function getRecord(){
        return Order::select('orders.*')
        ->where('is_payment', '=', 1)
        ->where('is_delete', '=', 0)
        ->orderBy('id', 'desc')
        ->get();
    }

    public function getShipping(){
        return $this->belongsTo(ShippingCharge::class,'shipping_id');
    }

    public function getItem(){
        return $this->hasMany(OrderItem::class,'order_id');
    }
}
