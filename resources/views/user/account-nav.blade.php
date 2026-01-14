<div class="col-lg-3">
    <ul class="account-nav">
        <li><a href="{{ route('user.index') }}" class="menu-link menu-link_us-s">Bảng điều khiển</a></li>
        <li><a href="{{ route('donhangs.index') }}" class="menu-link menu-link_us-s">Đơn hàng</a></li>
        <li><a href="{{ route('address.index') }}" class="menu-link menu-link_us-s">Địa chỉ</a></li>
        <li><a href="#" class="menu-link menu-link_us-s">Thông tin tài khoản</a></li>
        <li><a href="#" class="menu-link menu-link_us-s">Yêu thích</a></li>
        <li>
            <form action="{{ route('logout') }}" method="post" id="logout-form">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="">
                    <div class="icon"><i class="icon-log-out"></i></div>
                    <div class="text">Đăng xuất</div>
                </a>
            </form>
        </li>
    </ul>
</div>
