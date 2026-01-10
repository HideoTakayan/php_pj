@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Thêm mã giảm giá mới</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Mã Code (Ví dụ: SALE50)</label>
                        <input type="text" name="code" class="form-control border px-2" value="{{ old('code') }}" required>
                        @error('code') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại giảm giá</label>
                        <select name="type" class="form-control border px-2">
                            <option value="percent">Phần trăm (%)</option>
                            <option value="fixed">Số tiền cố định</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá trị (Số % hoặc số tiền)</label>
                        <input type="number" name="value" class="form-control border px-2" value="{{ old('value') }}" required min="0">
                        @error('value') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày hết hạn (Để trống nếu không giới hạn)</label>
                        <input type="date" name="expiry_date" class="form-control border px-2 border-radius-lg" value="{{ old('expiry_date') }}">
                        @error('expiry_date') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
