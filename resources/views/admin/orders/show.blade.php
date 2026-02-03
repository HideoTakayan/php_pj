@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Chi tiết đơn hàng: {{ $donHang->ma_don_hang }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Thông tin khách hàng</h5>
                            <p><strong>Tên:</strong> {{ $donHang->ten_nguoi_nhan }}</p>
                            <p><strong>Email:</strong> {{ $donHang->email_nguoi_nhan }}</p>
                            <p><strong>SĐT:</strong> {{ $donHang->sdt_nguoi_nhan }}</p>
                            <p><strong>Địa chỉ:</strong> {{ $donHang->dia_chi_nguoi_nhan }}</p>
                            <p><strong>Ghi chú:</strong> {{ $donHang->ghi_chu }}</p>
                            <p><strong>Phương thức:</strong> {{ $donHang->phuong_thuc_thanh_toan }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Cập nhật trạng thái</h5>
                            <form action="{{ route('admin.orders.update', $donHang->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái đơn hàng</label>
                                    <select name="trang_thai_don_hang" class="form-control border px-2">
                                        @foreach (\App\Models\DonHang::TRANG_THAI_DON_HANG as $key => $value)
                                            <option value="{{ $key }}" {{ $donHang->trang_thai_don_hang == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái thanh toán</label>
                                    <select name="trang_thai_thanh_toan" class="form-control border px-2">
                                        @foreach (\App\Models\DonHang::TRANG_THAI_THANH_TOAN as $key => $value)
                                            <option value="{{ $key }}" {{ $donHang->trang_thai_thanh_toan == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
                            </form>
                        </div>
                    </div>

                    <h5>Danh sách sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-4">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sản phẩm</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donHang->chiTietDonHang as $detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $detail->sanPham->ten ?? 'Sản phẩm đã xóa' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ number_format($detail->don_gia, 0, ',', '.') }}đ</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $detail->so_luong }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ number_format($detail->thanh_tien, 0, ',', '.') }}đ</span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-end font-weight-bold">Tổng tiền (bao gồm ship):</td>
                                    <td class="text-center font-weight-bold text-red">{{ number_format($donHang->tong_tien, 0, ',', '.') }}đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
