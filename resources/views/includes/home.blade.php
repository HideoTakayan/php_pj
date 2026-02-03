@extends('layouts.app')

@section('content')
    <main>

        <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" style="padding-top: 100px;"
            data-settings='{
        "autoplay": {
            "delay": 5000
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
    }'>
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            {{-- Image handling: check if external URL or local storage --}}
                            <img loading="lazy" src="{{ \Illuminate\Support\Str::startsWith($slider->image, 'http') ? $slider->image : Storage::url($slider->image) }}"
                                width="542" height="733" alt="{{ $slider->title }}"
                                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto"
                                style="max-height: 80vh; object-fit: contain;" />
                                
                            @if($slider->tagline)
                            <div class="character_markup type2">
                                <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">{{ $slider->tagline }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            @if($slider->subtitle)
                            <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                {{ $slider->subtitle }}
                            </h6>
                            @endif
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">{{ $slider->title }}</h2>
                            {{-- <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Theme text?</h2> --}}
                            <a href="{{ $slider->link }}"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Mua ngay</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="container">
                <div
                    class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
                </div>
            </div>
        </section>

        <div class="container mw-1620 bg-white border-radius-10">
            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <section class="category-carousel container">
                <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4">Danh mục</h2>

                <div class="position-relative">
                    <div class="swiper-container js-swiper-slider"
                        data-settings='{
            "autoplay": { "delay": 5000 },
            "slidesPerView": 3,
            "slidesPerGroup": 1,
            "effect": "none",
            "loop": false,
            "breakpoints": {
              "320": { "slidesPerView": 3, "spaceBetween": 15 },
              "768": { "slidesPerView": 3, "spaceBetween": 30 },
              "992": { "slidesPerView": 3, "spaceBetween": 45, "pagination": false }
            }
          }'>
                        <div class="swiper-wrapper justify-content-center">
                            @php
                                $cats = [
                                    ['name' => 'Nam', 'icon' => 'cat-men.svg', 'param' => 'nam'],
                                    ['name' => 'Nữ', 'icon' => 'cat-women.svg', 'param' => 'nu'],
                                    ['name' => 'Phụ kiện', 'icon' => 'cat-accessories.svg', 'param' => 'phu-kien'],
                                ];
                            @endphp
                            @foreach ($cats as $c)
                                <div class="swiper-slide d-flex flex-column align-items-center">
                                    <div class="rounded-circle overflow-hidden mb-3 d-flex align-items-center justify-content-center"
                                         style="width: 124px; height: 124px; padding: 30px; background-color: #1a1a1a;">
                                        <img loading="lazy" src="{{ asset('assets/images/categories/' . $c['icon']) }}"
                                            class="w-100 h-100 object-fit-contain" alt="{{ $c['name'] }}" />
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('shop.index', ['category_group' => $c['param']]) }}"
                                            class="menu-link fw-bold fs-5 text-uppercase">{{ $c['name'] }}<br /></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25"><use href="#icon_prev_md" /></svg>
                    </div>
                    <div class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25"><use href="#icon_next_md" /></svg>
                    </div>
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <section class="products-grid container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Sản phẩm nổi bật</h2>

                <div class="row">
                    @foreach ($featuredProducts as $item)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <a href="{{ route('product.detail', ['slug' => $item->slug]) }}">
                                        <img loading="lazy" src="{{ check_image_url($item->main_image) }}" width="330"
                                            height="400" alt="{{ $item->ten }}" class="pc__img">
                                    </a>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $item->danh_muc->ten }}</p>
                                    <h6 class="pc__title text-truncate"><a
                                            href="{{ route('product.detail', ['slug' => $item->slug]) }}">{{ $item->ten }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        @if ($item->gia_giam)
                                            <span class="price me-1 pc__category text-decoration-line-through">{{ number_format($item->gia, 0, ',', '.') }}đ</span>
                                            <span class="money price text-red">{{ number_format($item->gia_giam, 0, ',', '.') }}đ</span>
                                        @else
                                            <span class="money price text-red">{{ number_format($item->gia, 0, ',', '.') }}đ</span>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-primary w-100 py-2 fs-6">Thêm vào giỏ</button>
                                        </form>
                                    </div>

                                    <form action="{{ route('wishlist.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist">
                                            <svg width="16" height="16"><use href="#icon_heart" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-2">
                    <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium"
                        href="{{ route('shop.index') }}">Xem tất cả</a>
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <section class="minimal-duo container">
                <div class="row g-4 h-100 align-items-stretch">
                    @foreach ($promoBanners as $item)
                        <div class="col-md-6 d-flex">
                            <div class="minimal-card d-flex align-items-center bg-light border-radius-10 overflow-hidden transform-hover w-100" style="min-height: 350px;">
                                <div class="minimal-card__img w-50 h-100 bg-black d-flex align-items-center justify-content-center">
                                    <img loading="lazy" src="{{ check_image_url($item->main_image) }}" 
                                         class="w-100 h-100 object-fit-contain" alt="{{ $item->ten }}" />
                                </div>
                                <div class="minimal-card__content w-50 p-4">
                                    <span class="text-uppercase text-secondary tracking-widest small d-block mb-2">Deal tốt nhất</span>
                                    <h4 class="fw-bold mb-3">{{ $item->ten }}</h4>
                                    <div class="mb-4">
                                        <span class="fs-4 fw-bold text-red">{{ number_format($item->gia_giam ?? $item->gia, 0, ',', '.') }}đ</span>
                                    </div>
                                    <a href="{{ route('product.detail', ['slug' => $item->slug]) }}" 
                                       class="btn btn-dark text-uppercase fs-xs fw-bold px-4 py-2">Khám phá</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <section class="hot-deals container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Khuyến mãi hot</h2>
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-20per d-flex flex-column justify-content-center py-4">
                        <div class="mb-4">
                            <span class="text-uppercase tracking-widest text-secondary fs-xs mb-1 d-block">Ưu đãi hữu hạn</span>
                            <h2 class="fw-bold mb-0">Giảm giá cực sốc</h2>
                        </div>

                        <div class="position-relative d-flex align-items-center text-center js-countdown mb-4"
                            data-date="30-12-2026" data-time="23:59">
                            <div class="day countdown-unit me-2"><span class="countdown-num d-block fs-4 fw-bold"></span><span class="countdown-word text-uppercase text-secondary fs-xs">Ngày</span></div>
                            <div class="hour countdown-unit me-2"><span class="countdown-num d-block fs-4 fw-bold"></span><span class="countdown-word text-uppercase text-secondary fs-xs">Giờ</span></div>
                            <div class="min countdown-unit me-2"><span class="countdown-num d-block fs-4 fw-bold"></span><span class="countdown-word text-uppercase text-secondary fs-xs">Phút</span></div>
                            <div class="sec countdown-unit"><span class="countdown-num d-block fs-4 fw-bold"></span><span class="countdown-word text-uppercase text-secondary fs-xs">Giây</span></div>
                        </div>

                        <a href="{{ route('shop.index') }}" class="btn btn-outline-dark btn-sm text-uppercase fw-bold">Xem tất cả</a>
                    </div>
                    <div class="col-md-8 col-lg-9 col-xl-80per">
                        <div class="position-relative">
                            <div class="swiper-container js-swiper-slider"
                                data-settings='{
                        "autoplay": { "delay": 5000 },
                        "slidesPerView": 4,
                        "slidesPerGroup": 1,
                        "loop": false,
                        "breakpoints": {
                          "320": { "slidesPerView": 2, "spaceBetween": 14 },
                          "768": { "slidesPerView": 2, "spaceBetween": 24 },
                          "992": { "slidesPerView": 3, "spaceBetween": 30 },
                          "1200": { "slidesPerView": 4, "spaceBetween": 30 }
                        }
                      }'>
                                <div class="swiper-wrapper">
                                    @foreach ($hotDeals as $item)
                                        <div class="swiper-slide product-card product-card_style3">
                                            <div class="pc__img-wrapper">
                                                <a href="{{ route('product.detail', ['slug' => $item->slug]) }}">
                                                    <img loading="lazy" src="{{ check_image_url($item->main_image) }}"
                                                        width="258" height="313" alt="{{ $item->ten }}"
                                                        class="pc__img">
                                                </a>
                                            </div>

                                            <div class="pc__info position-relative">
                                                <p class="pc__category">{{ $item->danh_muc->ten }}</p>
                                                <h6 class="pc__title text-truncate"><a
                                                        href="{{ route('product.detail', ['slug' => $item->slug]) }}">{{ $item->ten }}</a>
                                                </h6>
                                                <div class="product-card__price d-flex">
                                                    @if ($item->gia_giam)
                                                        <span class="price me-1 pc__category text-decoration-line-through">{{ number_format($item->gia, 0, ',', '.') }}đ</span>
                                                        <span class="money price text-red">{{ number_format($item->gia_giam, 0, ',', '.') }}đ</span>
                                                    @else
                                                        <span class="money price text-red">{{ number_format($item->gia, 0, ',', '.') }}đ</span>
                                                    @endif
                                                </div>
                                                <div class="mt-3">
                                                    <form action="{{ route('cart.add') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                        <button type="submit" class="btn btn-primary w-100 py-2 fs-6">Thêm vào giỏ</button>
                                                    </form>
                                                </div>

                                                <form action="{{ route('wishlist.add') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit"
                                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist">
                                                        <svg width="16" height="16"><use href="#icon_heart" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

        <!-- SERVICE HIGHLIGHTS BAR MOVED TO BOTTOM -->
        <section class="service-promotion py-5 bg-light border-top border-bottom">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="service-item">
                            <svg width="40" height="40" class="mb-3 text-primary"><use href="#icon_shipping" /></svg>
                            <h5 class="fw-bold mb-1">Giao hàng nhanh</h5>
                            <p class="text-secondary small mb-0">Phí cố định 36,000đ toàn quốc</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="service-item">
                            <svg width="40" height="40" class="mb-3 text-primary"><use href="#icon_support" /></svg>
                            <h5 class="fw-bold mb-1">Hỗ trợ 24/7</h5>
                            <p class="text-secondary small mb-0">Giải đáp mọi thắc mắc của bạn</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-item">
                            <svg width="40" height="40" class="mb-3 text-primary"><use href="#icon_return" /></svg>
                            <h5 class="fw-bold mb-1">Đổi trả 30 ngày</h5>
                            <p class="text-secondary small mb-0">Hoàn toàn yên tâm mua sắm</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <style>
        .transform-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .transform-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .minimal-card {
            border: 1px solid #eee;
            display: flex;
            align-items: stretch; /* Ensure children stretch to parent height */
        }
        .minimal-card__img {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #000; /* Black background for letterboxing */
        }
        .minimal-card__img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Professional letterboxing */
        }
    </style>
@endsection
