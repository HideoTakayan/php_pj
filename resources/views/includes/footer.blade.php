<footer class="footer footer_type_2">
    <div class="footer-middle container">
        <div class="row row-cols-lg-5 row-cols-2">
            <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
                <div class="logo">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="SurfsideMedia" class="logo__image d-block" />
                    </a>
                </div>
                <p class="footer-address">Ha Noi, VietNam</p>
                <p class="m-0"><strong class="fw-medium">minhhieued245@gmail.com</strong></p>
                <p><strong class="fw-medium">+84 09876754321</strong></p>

                <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_facebook" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_twitter" width="14" height="13" viewBox="0 0 14 13"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_twitter" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_instagram" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_youtube" width="16" height="11" viewBox="0 0 16 11"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_pinterest" width="14" height="15" viewBox="0 0 14 15"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_pinterest" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Công ty</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('about.index') }}" class="menu-link menu-link_us-s">Về chúng tôi</a></li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Tuyển dụng</a>
                    </li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Liên kết</a></li>
                    <li class="sub-menu__item"><a href="{{ route('post.index') }}" class="menu-link menu-link_us-s">Blog</a></li>
                    <li class="sub-menu__item"><a href="{{ route('contact.index') }}" class="menu-link menu-link_us-s">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Cửa hàng</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('shop.index') }}" class="menu-link menu-link_us-s">Hàng mới về</a></li>
                    <li class="sub-menu__item"><a href="{{ route('shop.index') }}" class="menu-link menu-link_us-s">Phụ kiện</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('shop.index') }}" class="menu-link menu-link_us-s">Nam</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('shop.index') }}" class="menu-link menu-link_us-s">Nữ</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('shop.index') }}" class="menu-link menu-link_us-s">Tất cả sản phẩm</a></li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Trợ giúp</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Dịch vụ khách hàng</a></li>
                    <li class="sub-menu__item"><a href="{{ route('user.index') }}" class="menu-link menu-link_us-s">Tài khoản của tôi</a>
                    </li>
                    <li class="sub-menu__item"><a href="store_location.html" class="menu-link menu-link_us-s">Tìm cửa hàng</a>
                    </li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Pháp lý & Bảo mật</a></li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Thẻ quà tặng</a></li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Danh mục</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Áo sơ mi</a>
                    </li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Quần Jeans</a>
                    </li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Giày dép</a>
                    </li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Túi xách</a>
                    </li>
                    <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Tất cả sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container d-md-flex align-items-center">
            <span class="footer-copyright me-auto">©2025 Uniqlo</span>
            <div class="footer-settings d-md-flex align-items-center">
                <a href="privacy-policy.html">Chính sách bảo mật</a> &nbsp;|&nbsp; <a href="terms-conditions.html">Điều khoản & Điều kiện</a>
            </div>
        </div>
    </div>
</footer>


<footer class="footer-mobile container w-100 px-5 d-md-none bg-body">
    <div class="row text-center">
        <div class="col-4">
            <a href="index.html" class="footer-mobile__link d-flex flex-column align-items-center">
                <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_home" />
                </svg>
                <span>Trang chủ</span>
            </a>
        </div>

        <div class="col-4">
            <a href="index.html" class="footer-mobile__link d-flex flex-column align-items-center">
                <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_hanger" />
                </svg>
                <span>Cửa hàng</span>
            </a>
        </div>

        <div class="col-4">
            <a href="index.html" class="footer-mobile__link d-flex flex-column align-items-center">
                <div class="position-relative">
                    <svg class="d-block" width="18" height="18" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_heart" />
                    </svg>
                    <span class="wishlist-amount d-block position-absolute js-wishlist-count">3</span>
                </div>
                <span>Yêu thích</span>
            </a>
        </div>
    </div>
</footer>

<div id="scrollTop" class="visually-hidden end-0"></div>
<div class="page-overlay"></div>
<script>
    (function($) {
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right",
                "closeButton": true
            };

            <?php if ($errors->any()): ?>
                <?php foreach ($errors->all() as $error): ?>
                    toastr.error('{{ $error }}', 'Lỗi');
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (session()->has('success')): ?>
                toastr.success("{!! session('success') !!}", 'Thông báo');
            <?php endif; ?>
        });
    })(jQuery);
</script>
