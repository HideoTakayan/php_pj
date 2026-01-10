@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">Danh sách mã giảm giá</h6>
                        <a href="{{ route('admin.coupons.create') }}" class="btn btn-sm btn-light me-3 mb-0">Thêm mới</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã Code</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Loại</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá trị</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hết hạn</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $coupon->code }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $coupon->type == 'percent' ? 'Phần trăm (%)' : 'Cố định' }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ number_format($coupon->value) }}
                                                {{ $coupon->type == 'percent' ? '%' : '' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $coupon->expiry_date ? $coupon->expiry_date->format('d/m/Y') : 'Không thời hạn' }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Sửa
                                            </a>
                                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger text-gradient p-0 m-0 text-xs font-weight-bold">
                                                    Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3">
                            {{ $coupons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
