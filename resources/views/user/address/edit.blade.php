@extends('layouts.user')

@section('title')
    Địa chỉ
@endsection

@section('content')
    <div class="page-content my-account__address">
        <div class="my-account__address-list row">
            <h5>Cập nhật địa chỉ</h5>
            <form action="{{ route('address.update', $diaChi->id) }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')

                <div class="form-floating mb-3">
                    <input id="ho_ten" type="text" class="form-control @error('ho_ten') is-invalid @enderror"
                        name="ho_ten" required value="{{ old('ho_ten', $diaChi->ho_ten) }}">
                    <label for="customerPasswodInput">Họ tên *</label>
                    @error('ho_ten')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="so_dien_thoai" type="number"
                        class="form-control @error('so_dien_thoai') is-invalid @enderror" name="so_dien_thoai" required
                        value="{{ old('so_dien_thoai', $diaChi->so_dien_thoai) }}">
                    <label for="customerPasswodInput">Số điện thoại *</label>
                    @error('so_dien_thoai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="dia_chi" type="text" class="form-control @error('dia_chi') is-invalid @enderror"
                        name="dia_chi" required value="{{ old('dia_chi', $diaChi->dia_chi) }}">
                    <label for="customerPasswodInput">Địa chỉ *</label>
                    @error('dia_chi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="thanh_pho" type="text" class="form-control @error('thanh_pho') is-invalid @enderror"
                        name="thanh_pho" required value="{{ old('thanh_pho', $diaChi->thanh_pho) }}">
                    <label for="customerPasswodInput">Tỉnh (thành phố ) *</label>
                    @error('thanh_pho')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="quan" type="text" class="form-control @error('quan') is-invalid @enderror"
                        name="quan" required value="{{ old('quan', $diaChi->quan) }}">
                    <label for="customerPasswodInput">Quận (huyện) *</label>
                    @error('quan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="phuong" type="text" class="form-control @error('phuong') is-invalid @enderror"
                        name="phuong" required value="{{ old('phuong', $diaChi->phuong) }}">
                    <label for="customerPasswodInput">Phường (xã) *</label>
                    @error('phuong')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-primary w-25 text-uppercase" type="submit">Lưu</button>
            </form>

        </div>
    </div>
@endsection
