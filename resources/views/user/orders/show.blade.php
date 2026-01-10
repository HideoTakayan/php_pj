@extends('layouts.app')

@section('content')
<div class="mb-4 pb-4"></div>
<section class="my-account container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Chi tiết đơn hàng #{{ $order->ma_don_hang }}</h2>
        <a href="{{ route('donhangs.index') }}" class="btn btn-outline-secondary">Quay lại danh sách</a>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Danh sách sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->chiTietDonHang as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->sanPham)
                                            <img src="{{ check_image_url($item->sanPham->hinh_anh) }}" alt="{{ $item->sanPham->ten }}" width="60" class="me-3 rounded">
                                            <div>
                                                <h6 class="mb-0"><a href="{{ route('product.detail', $item->sanPham->slug) }}">{{ $item->sanPham->ten }}</a></h6>
                                            </div>
                                            @else
                                                <span>{{ $item->san_pham_id }} (Sản phẩm đã bị xóa)</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>${{ number_format($item->don_gia) }}</td>
                                    <td>{{ $item->so_luong }}</td>
                                    <td class="text-end">${{ number_format($item->thanh_tien) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Tạm tính:</td>
                                    <td class="text-end">${{ number_format($order->tien_hang) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Phí vận chuyển:</td>
                                    <td class="text-end">${{ number_format($order->tien_ship) }}</td>
                                </tr>
                                @if($order->tien_giam_gia > 0)
                                <tr>
                                    <td colspan="3" class="text-end fw-bold text-success">Giảm giá:</td>
                                    <td class="text-end text-success">-${{ number_format($order->tien_giam_gia) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-end fw-bold fs-5">Tổng cộng:</td>
                                    <td class="text-end fw-bold fs-5 text-red">${{ number_format($order->tong_tien) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Trạng thái:</strong> 
                        @php
                            $statusLabel = '';
                            $statusClass = '';
                            switch($order->trang_thai_don_hang) {
                                case 'cho_xac_nhan': $statusLabel = 'Chờ xác nhận'; $statusClass = 'text-warning'; break;
                                case 'da_xac_nhan': $statusLabel = 'Đã xác nhận'; $statusClass = 'text-info'; break;
                                case 'dang_chuan_bi': $statusLabel = 'Đang chuẩn bị'; $statusClass = 'text-info'; break;
                                case 'dang_van_chuyen': $statusLabel = 'Đang vận chuyển'; $statusClass = 'text-primary'; break;
                                case 'da_giao_hang': $statusLabel = 'Đã giao hàng'; $statusClass = 'text-success'; break;
                                case 'huy_don_hang': $statusLabel = 'Đã hủy'; $statusClass = 'text-danger'; break;
                                default: $statusLabel = $order->trang_thai_don_hang;
                            }
                        @endphp
                        <span class="fw-bold {{ $statusClass }}">{{ $statusLabel }}</span>
                    </p>
                    <p><strong>Phương thức thanh toán:</strong> 
                        @if($order->phuong_thuc_thanh_toan == 'COD')
                            Thanh toán khi nhận hàng (COD)
                        @else
                            Chuyển khoản ({{ $order->phuong_thuc_thanh_toan }})
                        @endif
                    </p>
                    <p><strong>Trạng thái thanh toán:</strong> {{ $order->trang_thai_thanh_toan == 'da_thanh_toan' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người nhận:</strong> {{ $order->ten_nguoi_nhan }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->sdt_nguoi_nhan }}</p>
                    <p><strong>Email:</strong> {{ $order->email_nguoi_nhan }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->dia_chi_nguoi_nhan }}</p>
                    @if($order->ghi_chu)
                    <p><strong>Ghi chú:</strong> {{ $order->ghi_chu }}</p>
                    @endif
                </div>
            </div>
            
            @if($order->trang_thai_don_hang == 'da_giao_hang')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('donhangs.reorder', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Mua lại đơn hàng này</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
