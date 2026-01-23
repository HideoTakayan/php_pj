@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-3">
                        <h5 class="mb-0 text-dark">Theo dõi đơn hàng</h5>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="p-4">
                            <form action="{{ route('admin.orders.track') }}" method="GET" class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label text-dark fw-bold">Nhập Mã đơn hàng, Số điện thoại hoặc ID</label>
                                        <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mt-3">Tra cứu</button>
                                </div>
                            </form>

                            @if(request('keyword'))
                                @if($donHang)
                                    <hr class="my-4">
                                    <h5 class="mb-3">Kết quả tra cứu cho: "{{ request('keyword') }}"</h5>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h6 class="text-dark">Thông tin đơn hàng #{{ $donHang->ma_don_hang ?? $donHang->id }}</h6>
                                            <p class="text-dark"><strong>Ngày đặt hàng:</strong> {{ $donHang->created_at->format('d/m/Y H:i') }}</p>
                                            <p class="text-dark"><strong>Trạng thái:</strong> 
                                                <span class="badge bg-{{ $donHang->trang_thai_don_hang == 'hoan_thanh' ? 'success' : ($donHang->trang_thai_don_hang == 'huy' ? 'danger' : 'warning') }}">
                                                    {{ $donHang->trang_thai_don_hang }}
                                                </span>
                                            </p>
                                            <p class="text-dark"><strong>Thanh toán:</strong> {{ $donHang->trang_thai_thanh_toan }}</p>
                                            <a href="{{ route('admin.orders.show', $donHang->id) }}" class="btn btn-sm btn-info">Xem chi tiết & Cập nhật</a>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-dark">Thông tin người nhận</h6>
                                            <p class="text-dark"><strong>Họ tên:</strong> {{ $donHang->ten_nguoi_nhan }}</p>
                                            <p class="text-dark"><strong>SĐT:</strong> {{ $donHang->sdt_nguoi_nhan }}</p>
                                            <p><strong>Địa chỉ:</strong> {{ $donHang->dia_chi_nguoi_nhan }}</p>
                                        </div>
                                    </div>

                                    <h6 class="text-dark">Chi tiết sản phẩm</h6>
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sản phẩm</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donHang->chiTietDonHang as $detail)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm text-dark">{{ $detail->sanPham->ten ?? 'SP đã xóa' }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $detail->so_luong }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ number_format($detail->thanh_tien) }}đ</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2" class="text-end font-weight-bold text-dark">Tổng cộng:</td>
                                                    <td class="text-center font-weight-bold text-dark">{{ number_format($donHang->tong_tien) }}đ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Không tìm thấy đơn hàng nào với thông tin: <strong>{{ request('keyword') }}</strong>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
