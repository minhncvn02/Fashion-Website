<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        $data['TotalOrder'] = Order::getTotalOrder();
        $data['TotalTodayOrder'] = Order::getTotalTodayOrder();
        $data['getLatestOrders'] = Order::getLatestOrders();
        $data['getRecord'] = Order::getRecord();
        return view('admin.dashboard', $data);
    }

    public function notification(){
        $data['getRecord'] = Notification::getRecord();
        return view('admin.notification.list', $data);
    }


}
