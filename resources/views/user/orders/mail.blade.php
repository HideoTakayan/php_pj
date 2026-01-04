@component('mail::message')
    $$$ Xác nhận đơn hàng

    Hi {{ $donHang->ten_nguoi_nhan }},

    Cảm ơn bạn đã đặt hàng. Đây là thông tin đơn hàng của bạn:

    *** Mã đơn hàng *** {{ $donHang->ma_don_hang }}

    *** Sản phẩm đã đặt ***
    @foreach ($donHang->chiTietDonHang as $chiTiet)
        {{ $chiTiet->sanPham->ten }} x {{ $chiTiet->so_luong }}: ${{ number_format($chiTiet->thanh_tien) }}
    @endforeach

    *** Tổng tiền: *** ${{ number_format($donHang->tong_tien) }}

    Cảm ơn bạn đã mua hàng ^_^

    Trân trọng,
    {{-- {{ config('app.name') }} --}}
@endcomponent
