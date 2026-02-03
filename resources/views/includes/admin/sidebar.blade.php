<div id="wrapper">
    <div id="page" class="">
        <div class="layout-wrap">

            <!-- <div id="preload" class="preload-container">
<div class="preloading">
    <span></span>
</div>
</div> -->

            <div class="section-menu-left">
                <div class="box-logo">
                    <a href="{{ route('home.index') }}" id="site-logo-inner">
                        <img id="logo" style="max-height: 50px; width: auto;" alt="Logo"
                            src="{{ asset('assets/images/logo.svg') }}"
                            data-light="{{ asset('assets/images/logo.svg') }}"
                            data-dark="{{ asset('assets/images/logo.svg') }}">
                    </a>
                    <div class="button-show-hide">
                        <i class="icon-menu-left"></i>
                    </div>
                </div>
                <div class="center">
                    <div class="center-item">
                        <div class="center-heading">Trang chủ</div>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="{{ route('admin.index') }}" class="">
                                    <div class="icon"><i class="icon-grid"></i></div>
                                    <div class="text">Bảng điều khiển</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="center-item">
                        <ul class="menu-list">
                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-shopping-cart"></i></div>
                                    <div class="text">Sản phẩm</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('san_phams.create') }}" class="">
                                            <div class="text">Thêm sản phẩm</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('san_phams.index') }}" class="">
                                            <div class="text">Danh sách sản phẩm</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-layers"></i></div>
                                    <div class="text">Brand</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="add-brand.html" class="">
                                            <div class="text">New Brand</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="brands.html" class="">
                                            <div class="text">Brands</div>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-layers"></i></div>
                                    <div class="text">Danh mục</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('danh_mucs.create') }}" class="">
                                            <div class="text">Thêm danh mục</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('danh_mucs.index') }}" class="">
                                            <div class="text">Danh sách danh mục</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-file-plus"></i></div>
                                    <div class="text">Đơn hàng</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('admin.orders.index') }}" class="">
                                            <div class="text">Danh sách đơn hàng</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('admin.orders.track') }}" class="">
                                            <div class="text">Theo dõi đơn hàng</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-layers"></i></div>
                                    <div class="text">Bài viết</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('bai_viets.create') }}" class="">
                                            <div class="text">Thêm bài viết</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('bai_viets.index') }}" class="">
                                            <div class="text">Danh sách bài viết</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.sliders.index') }}" class="">
                                    <div class="icon"><i class="icon-image"></i></div>
                                    <div class="text">Quản lý Slider</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.coupons.index') }}" class="">
                                    <div class="icon"><i class="icon-grid"></i></div>
                                    <div class="text">Mã giảm giá</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('admin.users.index') }}" class="">
                                    <div class="icon"><i class="icon-user"></i></div>
                                    <div class="text">Người dùng</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('admin.lien_hes.index') }}" class="">
                                    <div class="icon"><i class="icon-mail"></i></div>
                                    <div class="text">Liên hệ</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="#" onclick="alert('Tính năng đang phát triển'); return false;" class="">
                                    <div class="icon"><i class="icon-settings"></i></div>
                                    <div class="text">Cài đặt</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <form action="{{ route('logout') }}" method="post" id="logout-form-admin-sidebar" style="display: none;">
                                    @csrf
                                </form>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-admin-sidebar').submit()"
                                    class="">
                                    <div class="icon"><i class="icon-log-out"></i></div>
                                    <div class="text">Đăng xuất</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
