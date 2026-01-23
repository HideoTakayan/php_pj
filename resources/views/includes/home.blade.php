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
                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="{{ asset('assets/images/slideshow-character1.webp') }}"
                                width="542" height="733" alt="Woman Fashion 1"
                                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                            <div class="character_markup type2">
                                <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">Mới nhất</p>
                            </div>
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                Hàng mới về</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Thời trang Nam
                            </h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Thanh lịch & Hiện đại</h2>
                            <a href="{{ route('shop.index') }}"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Mua ngay</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="{{ asset('assets/images/slideshow-character2.webp') }}" width="400"
                                height="733" alt="Woman Fashion 2"
                                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                            <div class="character_markup">
                                <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">
                                    Xu hướng
                                </p>
                            </div>
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                Phong cách sống</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Tối giản
                            </h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Thoải mái mỗi ngày</h2>
                            <a href="{{ route('shop.index') }}"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Mua ngay</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="{{ asset('assets/images/slideshow-character3.webp') }}" width="400"
                                height="690" alt="Woman Fashion 3"
                                class="slideshow-character__img animate animate_fade animate_rtl animate_delay-10 w-auto h-auto" />
                            <div class="character_markup type2">
                                <p class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">Sale</p>
                            </div>
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                Khuyến mãi</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Ưu đãi mùa xuân
                            </h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Giảm đến 36%</h2>
                            <a href="{{ route('shop.index') }}"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Mua ngay</a>
                        </div>
                    </div>
                </div>
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
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 3,
            "slidesPerGroup": 1,
            "effect": "none",
            "loop": false,
            "breakpoints": {
              "320": {
                "slidesPerView": 3,
                "spaceBetween": 15
              },
              "768": {
                "slidesPerView": 3,
                "spaceBetween": 30
              },
              "992": {
                "slidesPerView": 3,
                "spaceBetween": 45,
                "pagination": false
              }
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
                        </div><!-- /.swiper-wrapper -->
                    </div><!-- /.swiper-container js-swiper-slider -->

                    <div
                        class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_md" />
                        </svg>
                    </div><!-- /.products-carousel__prev -->
                    <div
                        class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_next_md" />
                        </svg>
                    </div><!-- /.products-carousel__next -->
                </div><!-- /.position-relative -->
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="hot-deals container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Khuyến mãi hot</h2>
                <div class="row">
                    <div
                        class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
                        <h2>Sale mùa xuân</h2>
                        <h2 class="fw-bold">Giảm tới 36%</h2>

                        <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
                            data-date="18-3-2024" data-time="06:50">
                            <div class="day countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Ngày</span>
                            </div>

                            <div class="hour countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Giờ</span>
                            </div>

                            <div class="min countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Phút</span>
                            </div>

                            <div class="sec countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Giây</span>
                            </div>
                        </div>

                        <a href="#" class="btn-link default-underline text-uppercase fw-medium mt-3">Xem tất cả</a>
                    </div>
                    <div class="col-md-6 col-lg-8 col-xl-80per">
                        <div class="position-relative">
                            <div class="swiper-container js-swiper-slider"
                                data-settings='{
                        "autoplay": {
                          "delay": 5000
                        },
                        "slidesPerView": 4,
                        "slidesPerGroup": 4,
                        "effect": "none",
                        "loop": false,
                        "breakpoints": {
                          "320": {
                            "slidesPerView": 2,
                            "slidesPerGroup": 2,
                            "spaceBetween": 14
                          },
                          "768": {
                            "slidesPerView": 2,
                            "slidesPerGroup": 3,
                            "spaceBetween": 24
                          },
                          "992": {
                            "slidesPerView": 3,
                            "slidesPerGroup": 1,
                            "spaceBetween": 30,
                            "pagination": false
                          },
                          "1200": {
                            "slidesPerView": 4,
                            "slidesPerGroup": 1,
                            "spaceBetween": 30,
                            "pagination": false
                          }
                        }
                      }'>
                                <div class="swiper-wrapper">
                                    @foreach ($hots as $item)
                                        <div class="swiper-slide product-card product-card_style3">
                                            <div class="pc__img-wrapper">
                                                <a href="details.html">
                                                    <img loading="lazy" src="{{ check_image_url($item->hinh_anh) }}"
                                                        width="258" height="313" alt="{{ $item->name }}"
                                                        class="pc__img">
                                                    <img loading="lazy" src="{{ check_image_url($item->hinh_anh) }}"
                                                        width="258" height="313" alt="{{ $item->name }}"
                                                        class="pc__img pc__img-second">
                                                </a>
                                            </div>

                                            <div class="pc__info position-relative">
                                                <p class="pc__category">{{ $item->danh_muc->ten }}</p>
                                                <h6 class="pc__title text-truncate"><a
                                                        href="{{ route('product.detail', ['slug' => $item->slug]) }}">{{ $item->ten }}</a>
                                                    {{-- <a href="{{ route('product.detail', ['slug' => $item->slug]) }}">detail</a> --}}
                                                </h6>
                                                <div class="product-card__price d-flex">
                                                    @if ($item->gia_giam)
                                                        <span
                                                            class="price me-1 pc__category text-decoration-line-through">${{ floor($item->gia) }}</span>
                                                        <span
                                                            class="money price text-red">${{ floor($item->gia_giam) }}</span>
                                                    @else
                                                        <span class="money price text-red">${{ floor($item->gia) }}</span>
                                                    @endif
                                                </div>
                                                <div
                                                    class="product-card__review d-flex align-items-center justify-content-between">
                                                    <div class="d-flex">
                                                        <div class="reviews-group d-flex">
                                                            <svg class="review-star" viewBox="0 0 9 9"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <use href="#icon_star" />
                                                            </svg>
                                                        </div>
                                                        <span class="reviews-note text-lowercase text-secondary">8k+
                                                            đánh giá</span>
                                                    </div>
                                                    <form action="{{ route('cart.add') }}" name="addtocart-form"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $item->id }}">
                                                        <button class="btn btn-primary btn-buynow">Thêm vào giỏ</button>
                                                    </form>
                                                </div>

                                                <button
                                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                                    title="Thêm vào yêu thích">
                                                    <svg width="16" height="16" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!-- /.swiper-wrapper -->
                            </div><!-- /.swiper-container js-swiper-slider -->
                        </div><!-- /.position-relative -->
                    </div>
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="category-banner container">
                <div class="row">
                    @foreach ($sales as $item)
                        <div class="col-md-6">
                            <div class="category-banner__item border-radius-10 mb-5">
                                <img loading="lazy" class="h-max border-radius-10"
                                    src="{{ check_image_url($item->hinh_anh) }}" width="690" height="665"
                                    alt="" />
                                <div class="category-banner__item-mark">
                                    Chỉ từ ${{ $item->gia }}
                                </div>
                                <div class="category-banner__item-content">
                                    <h3 class="mb-0">{{ $item->ten }}</h3>
                                    <a href="{{ route('shop.index') }}"
                                        class="btn-link default-underline text-uppercase fw-medium">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="products-grid container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Sản phẩm nổi bật</h2>

                <div class="row">
                    @foreach ($sanphams as $item)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <a href="details.html">
                                        <img loading="lazy" src="{{ check_image_url($item->hinh_anh) }}" width="330"
                                            height="400" alt="{{ $item->ten }}" class="pc__img">
                                    </a>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $item->danh_muc->ten }}</p>
                                    <h6 class="pc__title text-truncate"><a
                                            href="{{ route('product.detail', ['slug' => $item->slug]) }}">{{ $item->ten }}</a>
                                        {{-- <a href="{{ route('product.detail', ['slug' => $item->slug]) }}">detail</a> --}}
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        @if ($item->gia_giam)
                                            <span
                                                class="price me-1 pc__category text-decoration-line-through">${{ floor($item->gia) }}</span>
                                            <span class="money price text-red">${{ floor($item->gia_giam) }}</span>
                                        @else
                                            <span class="money price text-red">${{ floor($item->gia) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-card__review d-flex align-items-center justify-content-between">
                                        <div class="d-flex">
                                            <div class="reviews-group d-flex">
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star" />
                                                </svg>
                                            </div>
                                            <span class="reviews-note text-lowercase text-secondary">8k+ đánh giá</span>
                                        </div>
                                        <form action="{{ route('cart.add') }}" name="addtocart-form" method="post">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-primary btn-buynow">Thêm vào giỏ</button>
                                        </form>
                                    </div>

                                    <button
                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                        title="Thêm vào yêu thích">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- /.row -->

                <div class="text-center mt-2">
                    <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium"
                        href="{{ route('shop.index') }}">Xem thêm</a>
                </div>
            </section>

        </div>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

    </main>
@endsection
