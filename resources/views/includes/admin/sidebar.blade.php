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
                    <a href="index.html" id="site-logo-inner">
                        <img class="w-75" id="logo" alt=""
                            src="{{ asset('assets/admins/images/logo/logo3.png') }}"
                            data-light="{{ asset('assets/admins/images/logo/logo3.png') }}"
                            data-dark="{{ asset('assets/admins/images/logo/logo3.png') }}">
                    </a>
                    <div class="button-show-hide">
                        <i class="icon-menu-left"></i>
                    </div>
                </div>
                <div class="center">
                    <div class="center-item">
                        <div class="center-heading">Main Home</div>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="index.html" class="">
                                    <div class="icon"><i class="icon-grid"></i></div>
                                    <div class="text">Dashboard</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="center-item">
                        <ul class="menu-list">
                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-shopping-cart"></i></div>
                                    <div class="text">Products</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('san_phams.create') }}" class="">
                                            <div class="text">Add Product</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('san_phams.index') }}" class="">
                                            <div class="text">Products</div>
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
                                    <div class="text">Category</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('danh_mucs.create') }}" class="">
                                            <div class="text">New Category</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('danh_mucs.index') }}" class="">
                                            <div class="text">Categories</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-file-plus"></i></div>
                                    <div class="text">Order</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="orders.html" class="">
                                            <div class="text">Orders</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="order-tracking.html" class="">
                                            <div class="text">Order tracking</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item has-children">
                                <a href="javascript:void(0);" class="menu-item-button">
                                    <div class="icon"><i class="icon-layers"></i></div>
                                    <div class="text">Post</div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a href="{{ route('bai_viets.create') }}" class="">
                                            <div class="text">New Post</div>
                                        </a>
                                    </li>
                                    <li class="sub-menu-item">
                                        <a href="{{ route('bai_viets.index') }}" class="">
                                            <div class="text">Post</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="slider.html" class="">
                                    <div class="icon"><i class="icon-image"></i></div>
                                    <div class="text">Slider</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="coupons.html" class="">
                                    <div class="icon"><i class="icon-grid"></i></div>
                                    <div class="text">Coupons</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="users.html" class="">
                                    <div class="icon"><i class="icon-user"></i></div>
                                    <div class="text">User</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="settings.html" class="">
                                    <div class="icon"><i class="icon-settings"></i></div>
                                    <div class="text">Settings</div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <form action="{{ route('logout') }}" method="post" id="logout-form">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                                        class="">
                                        <div class="icon"><i class="icon-log-out"></i></div>
                                        <div class="text">Logout</div>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
