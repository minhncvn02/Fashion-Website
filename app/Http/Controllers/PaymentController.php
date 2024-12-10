<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceMail;
use App\Models\Color;
use App\Models\DiscountCode;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ShippingCharge;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class PaymentController extends Controller
{

    public function apply_discount_code(Request $request){
        $getDiscount = DiscountCode::CheckDiscount($request->discount_code);
        if(!empty($getDiscount)){
            $total = Cart::getSubTotal();
            if(!empty($getDiscount->type == 'Tiền mặt')){
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $getDiscount->percent_amount;
            } else{
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount);
            $json['payable_total'] = $payable_total;


            $json['message'] = 'Áp dụng mã giảm giá thành công';

        }else{
            $json['status'] = false;
            $json['discount_amount'] = '0';
            $json['payable_total'] = Cart::getSubTotal();

            $json['message'] = 'Mã giảm giá không hợp lệ';
        }
        echo json_encode($json);
    }

    public function checkout(Request $request){
        $data['meta_title'] = 'Thanh toán';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getShipping'] = ShippingCharge::getRecord();

        return view('payment.checkout', $data);
    }

    public function cart(Request $request){
        $data['meta_title'] = 'Giỏ hàng';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('payment.cart', $data);
    }

    public function cart_delete($id){
        Cart::remove($id);
        return redirect()->back();
    }

    public function add_to_cart(Request $request){
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;

        if(!empty($request->size_id)){
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id,
            )
        ]);

        return redirect()->back();
    }

    public function update_cart(Request $request){

        foreach($request->cart as $cart){
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }
        return redirect()->back();
    }

    public function place_order(Request $request){
        $validate = 0;
        $message = '';

        if(!empty(Auth::check())){
            $user_id = Auth::user()->id;
        } else {
            if(!empty($request->is_create)){
                $checkEmail = User::checkEmail($request->email);
                if(!empty($checkEmail)){
                    $message = "Email đã tồn tại";
                    $validate = 1;
                } else {
                    $save = new User;
                    $save->name = trim($request->name);
                    $save->email = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();

                    $user_id = $save->id;
                }
            } else {
                $user_id = '';
            }
        }

        if(empty($validate)){
            $getShipping = ShippingCharge::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();

            $discount_amount = 0;
            $discount_code = '';

            if(!empty($request->discount_code)){
                $getDiscount = DiscountCode::CheckDiscount($request->discount_code);

                if(!empty($getDiscount)){
                    $discount_code = $request->discount_code;
                    if(!empty($getDiscount->type == 'Tiền mặt')){
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total = $payable_total - $getDiscount->percent_amount;
                    } else{
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total = $payable_total - $discount_amount;
                    }
                }
            }

            $shipping_amount = !empty($getShipping->price) ? $getShipping->price :0;
            $total_amount = $payable_total + $shipping_amount;

            $order = new Order;
            if(!empty($user_id)){
                $order->user_id = trim($user_id);
            }
            $order->name = trim($request->name);
            $order->address = trim($request->address);
            $order->city = trim($request->city);
            $order->district = trim($request->district);
            $order->ward = trim($request->ward);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->note);

            $order->discount_amount = trim($discount_amount);
            $order->discount_code = trim($discount_code);

            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);

            $order->total_amount = trim($total_amount);

            $order->payment_method = trim($request->payment_method);
            $order->order_number = mt_rand(100000000, 999999999);
            $order->save();

            foreach(Cart::getContent() as $key => $cart){
                $order_item = new OrderItem;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity = $cart->quantity;
                $order_item->price = $cart->price;

                $color_id = $cart->attributes->color_id;
                if(!empty($color_id)){
                    $getColor = Color::getSingle($color_id);
                    $order_item->color_name = $getColor->name;
                }

                $size_id = $cart->attributes->size_id;
                if(!empty($size_id)){
                    $getSize = ProductSize::getSingle($size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }

                $order_item->total_price = $cart->price * $cart->quantity;
                $order_item->save();

                $product = Product::find($cart->id);
                $product->qty -= $cart->quantity;
                $product->save();
            }
            $json['status'] = true;
            $json['message'] = "Đặt hàng thành công";
            $json['redirect'] = url('checkout/payment?order_id='.base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }
        echo json_encode($json);
    }

    public function checkout_payment(Request $request){
        if(!empty(Cart::getSubTotal()) && !empty($request->order_id)){
            $order_id = base64_decode($request->order_id);
            $getOrder = Order::getSingle($order_id);

            if(!empty($getOrder)){
                if($getOrder->payment_method == 'cash'){
                    $getOrder->is_payment = 1;
                    $getOrder->save();

                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

                    $user_id = 1;
                    $url = url('admin/order/detail/'.$getOrder->id);
                    $message = "Bạn có đơn hàng ".$getOrder->order_number;
                    Notification::insertRecord($user_id, $url, $message);

                    Cart::clear();

                    return redirect('cart')->with('success','Đặt hàng thành công');
                }

                else if($getOrder->payment_method == 'momo'){

                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

    }


}

