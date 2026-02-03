@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <div class="checkout-steps">
                <a href="#" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Giỏ hàng</span>
                        <em>Quản lý danh sách sản phẩm</em>
                    </span>
                </a>
                <a href="#" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Vận chuyển và Thanh toán</span>
                        <em>Thanh toán đơn hàng của bạn</em>
                    </span>
                </a>
            </div>

            {{-- NEW LOGIC: Single Main Form --}}
            <form id="main-cart-form" action="{{ route('cart.update') }}" method="POST">
                @csrf
                <div class="shopping-cart">
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">
                                        <input type="checkbox" id="select-all-products" checked>
                                    </th>
                                    <th>Sản phẩm</th>
                                    <th></th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $key => $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_products[]" class="product-item-checkbox" value="{{ $key }}" checked>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                <a href="{{ route('product.detail', $item['slug']) }}">
                                                    <img loading="lazy" src="{{ check_image_url($item['hinh_anh']) }}"
                                                        width="120" height="120" alt="" />
                                                </a>
                                            </div>
                                            {{-- Hidden data for update --}}
                                            <input type="hidden" name="cart[{{ $key }}][hinh_anh]" value="{{ $item['hinh_anh'] }}">
                                            <input type="hidden" name="cart[{{ $key }}][slug]" value="{{ $item['slug'] }}">
                                            <input type="hidden" name="cart[{{ $key }}][ten]" value="{{ $item['ten'] }}">
                                            <input type="hidden" name="cart[{{ $key }}][gia]" value="{{ $item['gia'] }}">
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 150px;">
                                                <a href="{{ route('product.detail', $item['slug']) }}" class="fs-6">{{ $item['ten'] }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price text-red">{{ number_format($item['gia'], 0, ',', '.') }}đ</span>
                                        </td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <input type="number" name="cart[{{ $key }}][so_luong]"
                                                    value="{{ $item['so_luong'] }}" min="1"
                                                    class="qty-control__number text-center">
                                                <div class="qty-control__reduce">-</div>
                                                <div class="qty-control__increase">+</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal text-red">{{ number_format($item['gia'] * $item['so_luong'], 0, ',', '.') }}đ</span>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="remove-cart-item text-danger" data-id="{{ $key }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="cart-table-footer justify-content-end">
                            <button type="submit" class="btn btn-light border">CẬP NHẬT GIỎ HÀNG</button>
                        </div>
                    </div>

                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Tổng giỏ hàng</h3>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr>
                                            <th>Tạm tính</th>
                                            <td class="text-red">{{ number_format($subTotal, 0, ',', '.') }}đ</td>
                                        </tr>
                                        <tr>
                                            <th>Phí vận chuyển</th>
                                            <td>
                                                <div class="text-red fw-bold">{{ number_format($ship_fee, 0, ',', '.') }}đ</div>
                                                <div class="small">Vận chuyển toàn quốc</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tổng cộng</th>
                                            <td class="text-red fs-4"><strong>{{ number_format($total, 0, ',', '.') }}đ</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobile_fixed-btn_wrapper mt-3">
                                <div class="button-wrapper container">
                                    {{-- Use formaction to submit the SAME form data to a different route --}}
                                    <button type="submit" formaction="{{ route('donhangs.create') }}" 
                                            class="btn btn-primary w-100 py-3 fs-5" id="btn-final-checkout">
                                        TIẾN HÀNH THANH TOÁN
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    {{-- Clean Remove Item Form --}}
    <form id="remove-cart-form" action="{{ route('cart.remove') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="cart_id" id="remove-cart-id">
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Simple Select All
        $('#select-all-products').on('change', function() {
            $('.product-item-checkbox').prop('checked', $(this).is(':checked'));
        });

        $('.product-item-checkbox').on('change', function() {
            if ($('.product-item-checkbox:not(:checked)').length === 0) {
                $('#select-all-products').prop('checked', true);
            } else {
                $('#select-all-products').prop('checked', false);
            }
        });

        // Simple Remove
        $('.remove-cart-item').on('click', function() {
            if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                $('#remove-cart-id').val($(this).data('id'));
                $('#remove-cart-form').submit();
            }
        });

        // Prevention against theme.js hijacking
        $('#btn-final-checkout').on('click', function(e) {
            if ($('.product-item-checkbox:checked').length === 0) {
                e.preventDefault();
                toastr.error('Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
            }
        });
    });
</script>
@endsection
