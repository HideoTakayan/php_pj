@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Tài khoản của tôi</h2>
            <div class="row">
                @include('user.account-nav')
                <div class="col-lg-9">
                    <div class="page-content my-account__dashboard">
                        <p>Xin chào <strong>{{ $user->name }}</strong></p>
                        <p>Từ bảng điều khiển tài khoản, bạn có thể xem <a class="unerline-link"
                                href="{{ route('donhangs.index') }}">đơn hàng gần đây</a>, quản lý <a class="unerline-link" href="{{ route('address.index') }}">địa chỉ giao hàng</a>, và <a class="unerline-link" href="#">chỉnh sửa mật khẩu và thông tin tài khoản.</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
