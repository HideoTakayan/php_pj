@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Cập nhật tài khoản</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Tài khoản</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="fieldset">
                        <div class="body-title mb-10">Tên hiển thị <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" name="name" placeholder="Tên hiển thị" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="fieldset">
                        <div class="body-title mb-10">Avatar</div>
                        <input type="file" name="avatar" class="mb-10">
                        @if(Auth::user()->avatar)
                            <div class="mb-10">
                                <img src="{{ asset('uploads/users/' . Auth::user()->avatar) }}" alt="Avatar" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            </div>
                        @endif
                        @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-20">Đổi mật khẩu (Bỏ trống nếu không đổi)</h5>

                    <div class="fieldset">
                        <div class="body-title mb-10">Mật khẩu cũ</div>
                        <input class="mb-10" type="password" name="old_password" placeholder="Mật khẩu cũ">
                        @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="fieldset">
                        <div class="body-title mb-10">Mật khẩu mới</div>
                        <input class="mb-10" type="password" name="new_password" placeholder="Mật khẩu mới">
                        @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="fieldset">
                        <div class="body-title mb-10">Xác nhận mật khẩu mới</div>
                        <input class="mb-10" type="password" name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới">
                    </div>

                    <div class="bot">
                        <button class="tf-button w208" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
