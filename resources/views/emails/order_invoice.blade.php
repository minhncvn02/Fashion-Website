@component('mail::message')
<p>Chào <b>{{$order->name}}</b></p>
<p>Cảm ơn bạn đã đặt hàng tại Mango Store. Dưới đây là thông tin chi tiết đơn hàng của bạn:</p>
<ul>
    <li><b>Mã đơn hàng:</b> {{$order->order_number}}</li>
    <li><b>Ngày đặt hàng:</b> {{date('d/m/Y', strtotime($order->created_at))}}</li>
</ul>
<table style="width:100%;border-collapse:collapse;margin-bottom:20px">
    <thead>
        <tr>
            <th style="border-bottom:1px solid #ddd;padding:8px;text-align:left">Sản phẩm</th>
            <th style="border-bottom:1px solid #ddd;padding:8px;text-align:left">Giá (VNĐ)</th>
            <th style="border-bottom:1px solid #ddd;padding:8px;text-align:left">Số lượng</th>
            <th style="border-bottom:1px solid #ddd;padding:8px;text-align:left">Tổng (VNĐ)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->getItem as $item)
        <tr>
            <td style="border-bottom:1px solid #ddd;padding:8px;">
                {{$item->getProduct->title}}
                <br>
                Màu: {{$item->color_name}}
                <br>
                Kích cỡ: {{$item->size_name}}
            </td>
            <td style="border-bottom:1px solid #ddd;padding:8px;">{{number_format($item->price)}}</td>
            <td style="border-bottom:1px solid #ddd;padding:8px;">{{$item->quantity}}</td>
            <td style="border-bottom:1px solid #ddd;padding:8px;">{{number_format($item->total_price)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@if (!empty($order->discount_code))
<p><b>Mã giảm giá:</b> {{$order->discount_code}}</p>
<p><b>Giá trị giảm:</b> {{number_format($order->discount_amount)}} VNĐ</p>
@endif
<p><b>Phương thức giao hàng:</b> {{$order->getShipping->name}}</p>
<p><b>Phí giao hàng:</b> {{number_format($order->shipping_amount)}} VNĐ</p>
<p><b>Tổng tiền:</b> {{number_format($order->total_amount)}} VNĐ</p>
<p><b>Phương thức thanh toán:</b> {{($order->payment_method == 'cash') ? 'Thanh toán khi nhận hàng' : ''}}</p>
<p>Cảm ơn bạn đã lựa chọn <b>Mango Store</b></p>
@endcomponent
