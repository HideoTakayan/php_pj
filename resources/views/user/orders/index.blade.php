@extends('layouts.app')

@section('content')
<div class="mb-4 pb-4"></div>
<section class="my-account container">
    <h2 class="page-title">Đơn hàng của bạn</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content my-account__content">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('donhangs.index') }}">Tất cả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status == 'cho_xac_nhan' ? 'active' : '' }}" href="{{ route('donhangs.index', ['status' => 'cho_xac_nhan']) }}">Chờ xác nhận</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status == 'dang_giao' ? 'active' : '' }}" href="{{ route('donhangs.index', ['status' => 'dang_giao']) }}">Chờ giao hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status == 'da_giao' ? 'active' : '' }}" href="{{ route('donhangs.index', ['status' => 'da_giao']) }}">Đã giao</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status == 'da_huy' ? 'active' : '' }}" href="{{ route('donhangs.index', ['status' => 'da_huy']) }}">Đã hủy</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->ma_don_hang }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @php
                                        $statusLabel = '';
                                        $statusClass = '';
                                        switch($order->trang_thai_don_hang) {
                                            case 'cho_xac_nhan': $statusLabel = 'Chờ xác nhận'; $statusClass = 'badge bg-warning'; break;
                                            case 'da_xac_nhan': $statusLabel = 'Đã xác nhận'; $statusClass = 'badge bg-info'; break;
                                            case 'dang_chuan_bi': $statusLabel = 'Đang chuẩn bị'; $statusClass = 'badge bg-info'; break;
                                            case 'dang_van_chuyen': $statusLabel = 'Đang vận chuyển'; $statusClass = 'badge bg-primary'; break;
                                            case 'da_giao_hang': $statusLabel = 'Đã giao hàng'; $statusClass = 'badge bg-success'; break;
                                            case 'huy_don_hang': $statusLabel = 'Đã hủy'; $statusClass = 'badge bg-danger'; break;
                                            default: $statusLabel = $order->trang_thai_don_hang; $statusClass = 'badge bg-secondary';
                                        }
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td>${{ number_format($order->tong_tien) }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('donhangs.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                        
                                        @if($order->trang_thai_don_hang == 'da_giao_hang')
                                            <form action="{{ route('donhangs.reorder', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">Mua lại</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Chưa có đơn hàng nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center">
                    {{ $orders->appends(['status' => $status])->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
