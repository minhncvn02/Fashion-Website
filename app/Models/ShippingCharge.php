<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;

    protected $table = 'shipping_charge';

    static public function getSingle($id){
        return self::find($id);
    }
    static public function getRecord(){
        return self::select('shipping_charge.*')
        ->where('shipping_charge.status', '=',1)
        ->where('shipping_charge.is_delete', '=',0)
        ->orderBy('shipping_charge.id', 'asc')
        ->get();
    }

    static public function getRecordActive(){
        return self::select('shipping_charge.*')
        ->where('shipping_charge.status', '=',1)
        ->where('shipping_charge.is_delete', '=',0)
        ->orderBy('shipping_charge.id', 'asc')
        ->get();
    }


}
