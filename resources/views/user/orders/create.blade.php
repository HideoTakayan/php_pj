@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <div class="checkout-steps">
                <a href="{{ route('cart.list') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Giỏ hàng</span>
                        <em>Quản lý danh sách sản phẩm</em>
                    </span>
                </a>
                <a href="#" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Vận chuyển và Thanh toán</span>
                        <em>Thanh toán đơn hàng của bạn</em>
                    </span>
                </a>
                </a>
            </div>
            
            <form name="checkout-form" action="{{ route('donhangs.store') }}" method="POST" novalidate>
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>THÔNG TIN GIAO HÀNG</h4>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="ten_nguoi_nhan" value="{{ old('ten_nguoi_nhan', Auth::user()->name) }}">
                                    <label for="name">Họ và tên *</label>
                                    @error('ten_nguoi_nhan') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="sdt_nguoi_nhan" value="{{ old('sdt_nguoi_nhan', Auth::user()->mobile) }}">
                                    <label for="phone">Số điện thoại *</label>
                                    @error('sdt_nguoi_nhan') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="email_nguoi_nhan" value="{{ old('email_nguoi_nhan', Auth::user()->email) }}">
                                    <label for="zip">Email *</label>
                                    @error('email_nguoi_nhan') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="{{ old('dia_chi_nguoi_nhan', Auth::user()->dia_chis->first()?->dia_chi ?? '') }}">
                                    <label for="state">Địa chỉ *</label>
                                    @error('dia_chi_nguoi_nhan') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="ghi_chu" value="{{ old('ghi_chu') }}">
                                    <label for="ghi_chu">Ghi chú (Tùy chọn)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Đơn hàng của bạn</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>SẢN PHẨM</th>
                                            <th align="right">THÀNH TIỀN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ $item['ten'] }} x {{ $item['so_luong'] }}
                                                </td>
                                                <td align="right">
                                                    {{ number_format($item['gia'] * $item['so_luong']) }}đ
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>TẠM TÍNH</th>
                                            <td align="right">
                                                {{ number_format($subTotal) }}đ
                                                <input type="hidden" name="tien_hang" value="{{ $subTotal }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PHÍ VẬN CHUYỂN</th>
                                            <td align="right">
                                                {{ number_format($shipping) }}đ
                                                <input type="hidden" name="tien_ship" value="{{ $shipping }}">
                                            </td>
                                        </tr>
                                        @if(isset($discount) && $discount > 0)
                                        <tr>
                                            <th class="text-success">GIẢM GIÁ ({{ $couponCode }})</th>
                                            <td align="right" class="text-success">
                                                -{{ number_format($discount) }}đ
                                                <input type="hidden" name="tien_giam_gia" value="{{ $discount }}">
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>TỔNG CỘNG</th>
                                            <td align="right" class="text-red">
                                                <b>{{ number_format($total) }}đ</b>
                                                <input type="hidden" name="tong_tien" value="{{ $total }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="coupon-section mt-4 pt-3 border-top">
                                    @if(!session()->has('coupon'))
                                        <div class="input-group">
                                            <input type="text" id="coupon_code_input" class="form-control" placeholder="Nhập mã giảm giá">
                                            <button class="btn btn-dark" type="button" id="apply_coupon_btn">Áp dụng</button>
                                        </div>
                                    @else
                                        <div class="alert alert-success d-flex justify-content-between align-items-center p-2 mb-0">
                                            <small>Mã <strong>{{ session('coupon.code') }}</strong> ({{ number_format($discount) }}đ) đã áp dụng</small>
                                            <a href="{{ route('donhangs.coupon.remove') }}" class="text-danger fw-bold small ms-2">Gỡ bỏ</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="checkout__payment-methods mt-4">
                                <div class="payment-options">
                                    <div class="payment-option mb-3">
                                        <div class="form-check p-3 border rounded">
                                            <input class="form-check-input" type="radio" value="COD" name="phuong_thuc_thanh_toan" id="payment_cod" checked>
                                            <label class="form-check-label w-100 cursor-pointer ps-2" for="payment_cod">
                                                <span class="fw-bold text-dark">Thanh toán khi nhận hàng (COD)</span>
                                                <small class="d-block text-muted">Thanh toán bằng tiền mặt khi giao hàng.</small>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="payment-option mb-3">
                                        <div class="form-check p-3 border rounded">
                                            <input class="form-check-input" type="radio" value="Banking" name="phuong_thuc_thanh_toan" id="payment_banking">
                                            <label class="form-check-label w-100 cursor-pointer ps-2" for="payment_banking">
                                                <span class="fw-bold text-dark">Chuyển khoản (VNPAY/Momo)</span>
                                                <small class="d-block text-muted">Thanh toán qua tài khoản ngân hàng.</small>
                                            </label>
                                        </div>
                                        
                                        <div id="banking-info" class="mt-2 p-3 border rounded bg-light shadow-sm" style="display: none;">
                                            <p class="mb-2 fw-bold text-dark border-bottom pb-1">THÔNG TIN CHUYỂN KHOẢN</p>
                                            <div class="row align-items-center">
                                                <div class="col-7">
                                                    <ul class="list-unstyled mb-0" style="font-size: 0.85rem;">
                                                        <li>Ngân hàng: <strong>MB Bank</strong></li>
                                                        <li>STK: <strong class="text-primary">9999999999</strong></li>
                                                        <li>Chủ TK: <strong>UOMO SHOP</strong></li>
                                                        <li>Nội dung: <strong>[Tên] + [SĐT]</strong></li>
                                                    </ul>
                                                </div>
                                                <div class="col-5">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=example" alt="QR" class="img-fluid border p-1 bg-white">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="policy-text small text-muted mt-3">
                                    Dữ liệu của bạn được bảo mật theo <a href="#" target="_blank">chính sách bảo mật</a> của chúng tôi.
                                </div>
                            </div>
                            
                            @if(isset($selectedIds) && count($selectedIds) > 0)
                                @foreach($selectedIds as $id)
                                    <input type="hidden" name="selected_products[]" value="{{ $id }}">
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-primary btn-checkout w-100 mt-4">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    {{-- Hidden Form for Coupon Actions (to avoid nesting) --}}
    <form id="coupon_form_submit" action="{{ route('donhangs.coupon.apply') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="coupon_code" id="hidden_coupon_code">
        {{-- Preserve selections --}}
        @if(isset($selectedIds) && count($selectedIds) > 0)
            @foreach($selectedIds as $id)
                <input type="hidden" name="selected_products[]" value="{{ $id }}">
            @endforeach
        @endif
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('input[name="phuong_thuc_thanh_toan"]').change(function() {
            if ($(this).val() === 'Banking') {
                $('#banking-info').slideDown();
            } else {
                $('#banking-info').slideUp();
            }
        });

        $('#apply_coupon_btn').click(function() {
            var code = $('#coupon_code_input').val();
            if(code.trim() !== '') {
                $('#hidden_coupon_code').val(code);
                $('#coupon_form_submit').submit();
            } else {
                toastr.warning('Vui lòng nhập mã giảm giá');
            }
        });
    });
</script>
@endsection
