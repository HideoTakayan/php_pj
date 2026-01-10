@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Danh sách đơn hàng</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã Đơn</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Người nhận</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tổng tiền</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thanh toán</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donHangs as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->ma_don_hang }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->ten_nguoi_nhan }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->sdt_nguoi_nhan }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-success font-weight-bold">{{ number_format($item->tong_tien) }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{ $item->phuong_thuc_thanh_toan == 'Banking' ? 'bg-gradient-info' : 'bg-gradient-secondary' }}">{{ $item->phuong_thuc_thanh_toan ?? 'COD' }}</span>
                                            <br>
                                            <span class="text-xs">{{ $item->trang_thai_thanh_toan }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-success">{{ $item->trang_thai_don_hang }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.orders.show', $item->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3">
                            {{ $donHangs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
