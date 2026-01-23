@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Thông tin tài khoản</h2>
            <div class="row">
                @include('user.account-nav')
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')

                                @if(session('success'))
                                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" name="name" placeholder="Họ và tên" value="{{ old('name', $user->name) }}" required>
                                            <label for="name">Họ và tên *</label>
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <label for="avatar" class="form-label">Ảnh đại diện</label>
                                            <input type="file" class="form-control" name="avatar">
                                            @if($user->avatar)
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/users/' . $user->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
                                            @endif
                                            @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h4 class="mt-4 mb-3">Đổi mật khẩu</h4>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu cũ">
                                            <label for="old_password">Mật khẩu cũ</label>
                                            @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="form-control" name="new_password" placeholder="Mật khẩu mới">
                                            <label for="new_password">Mật khẩu mới</label>
                                            @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="password" class="form-control" name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới">
                                            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button type="submit" class="btn btn-primary btn-lg">Cập nhật thông tin</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
