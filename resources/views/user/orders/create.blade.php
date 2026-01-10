@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            {{-- <h2 class="page-title">Shipping and Checkout</h2> --}}
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
                <a href="order-confirmation.html" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Xác nhận</span>
                        <em>Xem lại và gửi đơn hàng</em>
                    </span>
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
                            <div class="col-6">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="ten_nguoi_nhan" value="{{ Auth::user()->name }}">
                                    <label for="name">Họ và tên *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="sdt_nguoi_nhan" value="{{ Auth::user()->mobile }}">
                                    <label for="phone">Số điện thoại *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="email_nguoi_nhan" value="{{ Auth::user()->email }}">
                                    <label for="zip">Email *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="{{ Auth::user()->dia_chis->first()?->dia_chi ?? '' }}">
                                    <label for="state">Địa chỉ *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="address" required="">
                                    <label for="address">House no, Building Name *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="locality" required="">
                                    <label for="locality">Road Name, Area, Colony *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="ghi_chu" required="">
                                    <label for="ghi_chu">Ghi chú *</label>
                                    <span class="text-danger"></span>
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
                                            <th align="right">GIÁ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ $item['ten'] }} x {{ $item['so_luong'] }}
                                                </td>
                                                <td align="right">
                                                    ${{ number_format($item['gia'] * $item['so_luong']) }}
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
                                                ${{ $subTotal }}
                                                <input type="hidden" name="tien_hang" value="{{ $subTotal }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PHÍ VẬN CHUYỂN</th>
                                            <td align="right">
                                                ${{ $shipping }}
                                                <input type="hidden" name="tien_ship" value="{{ $shipping }}">
                                            </td>
                                        </tr>
                                        @if(isset($discount) && $discount > 0)
                                        <tr>
                                            <th class="text-success">GIẢM GIÁ ({{ $couponCode }})</th>
                                            <td align="right" class="text-success">
                                                -${{ number_format($discount) }}
                                                <input type="hidden" name="tien_giam_gia" value="{{ $discount }}">
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>TỔNG CỘNG</th>
                                            <td align="right" class="text-red">
                                                <b>${{ $total }}</b>
                                                <input type="hidden" name="tong_tien" value="{{ $total }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                @if(!session()->has('coupon'))
                                <div class="mt-3">
                                    <div class="input-group">
                                        <input type="text" id="coupon_code_input" class="form-control" placeholder="Nhập mã giảm giá">
                                        <button class="btn btn-dark" type="button" id="apply_coupon_btn">Áp dụng</button>
                                    </div>
                                </div>
                                <form id="coupon_form" action="{{ route('donhangs.coupon.apply') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="coupon_code" id="hidden_coupon_code">
                                </form>
                                @else
                                <div class="mt-3">
                                    <div class="alert alert-success d-flex justify-content-between align-items-center p-2">
                                        <small>Mã <strong>{{ session('coupon.code') }}</strong> đang được áp dụng.</small>
                                        <a href="{{ route('donhangs.coupon.remove') }}" class="text-danger fw-bold text-xs">Gỡ bỏ</a>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                            <div class="checkout__payment-methods">
                                <div class="payment-options">
                                    <div class="payment-option mb-3">
                                        <div class="form-check p-3 border rounded shadow-sm">
                                            <input class="form-check-input" type="radio" value="COD" name="phuong_thuc_thanh_toan" id="payment_cod" checked>
                                            <label class="form-check-label w-100 cursor-pointer ps-2" for="payment_cod">
                                                <span class="fw-bold text-dark">Thanh toán khi nhận hàng (COD)</span>
                                                <small class="d-block text-muted mt-1">Thanh toán bằng tiền mặt khi giao hàng.</small>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="payment-option mb-3">
                                        <div class="form-check p-3 border rounded shadow-sm">
                                            <input class="form-check-input" type="radio" value="Banking" name="phuong_thuc_thanh_toan" id="payment_banking">
                                            <label class="form-check-label w-100 cursor-pointer ps-2" for="payment_banking">
                                                <span class="fw-bold text-dark">Chuyển khoản ngân hàng (VNPAY/Momo)</span>
                                                <small class="d-block text-muted mt-1">Thanh toán qua tài khoản ngân hàng hoặc ví điện tử.</small>
                                            </label>
                                        </div>
                                        
                                        <div id="banking-info" class="mt-2 p-3 border rounded bg-white shadow-sm" style="display: none;">
                                            <p class="mb-2 fw-bold text-dark border-bottom pb-2">THÔNG TIN CHUYỂN KHOẢN</p>
                                            <div class="row align-items-center">
                                                <div class="col-md-7">
                                                    <ul class="list-unstyled mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.8;">
                                                        <li>Ngân hàng: <strong class="text-primary">MB Bank</strong></li>
                                                        <li>Số tài khoản: <strong class="text-primary fs-5">9999999999</strong></li>
                                                        <li>Chủ tài khoản: <strong>UOMO SHOP</strong></li>
                                                        <li>Nội dung: <strong>[Tên] + [SĐT]</strong></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-5 text-center border-start">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=00020101021138570010A0000007270127000697042501130099999999990208QRIBFTTA53037045802VN630456C8" alt="QR Code" class="img-fluid border p-1 bg-white rounded" style="max-width: 120px;">
                                                    <p class="mt-1 small text-muted fst-italic">Quét mã để thanh toán nhanh</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="policy-text">
                                    Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, hỗ trợ trải nghiệm của bạn trên trang web và cho các mục đích khác được mô tả trong <a href="terms.html"
                                        target="_blank">chính sách bảo mật</a>.
                                </div>
                            </div>
                            @if(isset($selectedIds) && count($selectedIds) > 0)
                                @foreach($selectedIds as $id)
                                    <input type="hidden" name="selected_products[]" value="{{ $id }}">
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-primary btn-checkout">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

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
                    $('#coupon_form').submit();
                }
            });
        });
    </script>
    @endsection
@endsection
