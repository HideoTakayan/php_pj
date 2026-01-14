@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @if (count($galleryImages) > 0)
                                        @foreach ($galleryImages as $image)
                                            <div class="swiper-slide product-single__image-item h-100">
                                                <img loading="lazy" class="h-max" src="{{ check_image_url($image) }}"
                                                    width="674" height="550" alt="" />
                                                {{-- <a data-fancybox="gallery" href="../images/products/product_0.html"
                                                    data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_zoom" />
                                                    </svg>
                                                </a> --}}
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide product-single__image-item h-100">
                                            <img loading="lazy" class="h-max" src="{{ check_image_url($sanPham->hinh_anh) }}"
                                                width="674" height="550" alt="" />
                                        </div>
                                    @endif
                                </div>
                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                @foreach ($galleryImages as $image)
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                class="h-max" src="{{ check_image_url($image) }}" width="104"
                                                height="104" alt="" /></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Trang chủ</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Cửa hàng</a>
                        </div><!-- /.breadcrumb -->
                    </div>
                    <h1 class="product-single__name">{{ $sanPham->ten }}</h1>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star" />
                            </svg>
                        </div>
                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ đánh giá</span>
                    </div>
                    <div class="product-card__price d-flex">
                        @if ($sanPham->gia_giam)
                            <span
                                class="price me-1 pc__category text-decoration-line-through fs-3">${{ floor($sanPham->gia) }}</span>
                            <span class="money price text-red fs-3">${{ floor($sanPham->gia_giam) }}</span>
                        @else
                            <span class="money price text-red fs-3">${{ floor($sanPham->gia) }}</span>
                        @endif
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $sanPham->mo_ta_ngan }}</p>
                    </div>
                    <form action="{{ route('cart.add') }}" name="addtocart-form" method="post">
                        @csrf
                        <div class="product-single__addtocart">
                            <div class="qty-control position-relative">
                                <input type="number" name="quantity" value="1" min="1"
                                    class="qty-control__number text-center">
                                <div class="qty-control__reduce">-</div>
                                <div class="qty-control__increase">+</div>
                                <input type="hidden" name="product_id" value="{{ $sanPham->id }}">
                            </div><!-- .qty-control -->
                            <button type="submit" class="btn btn-primary btn-addtocart">Thêm vào giỏ</button>
                        </div>
                    </form>
                    <div class="product-single__addtolinks">
                        <share-button class="share-button">
                            <button
                                class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_sharing" />
                                </svg>
                                <span>Chia sẻ</span>
                            </button>
                            <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                <div id="Article-share-template__main"
                                    class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                                    <div class="field grow mr-4">
                                        <label class="field__label sr-only" for="url">Link</label>
                                        <input type="text" class="field__input w-full" id="url"
                                            value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                            placeholder="Link" onclick="this.select();" readonly="">
                                    </div>
                                    <button class="share-button__copy no-js-hidden">
                                        <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13"
                                            fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            focusable="false" viewBox="0 0 11 13">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <span class="sr-only">Copy link</span>
                                    </button>
                                </div>
                            </details>
                        </share-button>
                        <script src="js/details-disclosure.html" defer="defer"></script>
                        <script src="js/share.html" defer="defer"></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU:</label>
                            <span>{{ $sanPham->ma_sp }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Danh mục:</label>
                            <span>{{ $sanPham->danh_muc->ten }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Mô tả</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Đánh giá
                            (2)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            {!! $sanPham->mo_ta !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Đánh giá</h2>
                        <div class="product-single__reviews-list">
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Janice Miller</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                            minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Benjam Porter</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                            minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form">
                                <h5>Hãy là người đầu tiên đánh giá “{{ $sanPham->ten }}”</h5>
                                <p>Email của bạn sẽ không được hiển thị. Các trường bắt buộc được đánh dấu *</p>
                                <div class="select-star-rating">
                                    <label>Đánh giá của bạn *</label>
                                    <span class="star-rating">
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                    </span>
                                    <input type="hidden" id="form-input-rating" value="" />
                                </div>
                                <div class="mb-4">
                                    <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Nội dung đánh giá" cols="30"
                                        rows="8"></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label">Tên *</label>
                                    <input id="form-input-name" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">Email *</label>
                                    <input id="form-input-email" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                                        id="remember_checkbox">
                                    <label class="form-check-label" for="remember_checkbox">
                                        Lưu tên và email của tôi cho lần bình luận sau.
                                    </label>
                                </div>
                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Sản phẩm <strong>liên quan</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider"
                    data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach ($relatedProducts as $r_sp)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{ route('product.detail', ['slug' => $r_sp->slug]) }}">
                                        <img loading="lazy" src="{{ check_image_url($r_sp->hinh_anh) }}" width="330"
                                            height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                                        <img loading="lazy" src="{{ check_image_url($r_sp->hinh_anh) }}" width="330"
                                            height="400" alt="Cropped Faux leather Jacket"
                                            class="pc__img pc__img-second">
                                    </a>
                                    {{-- <button
                                        class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside"
                                        data-aside="cartDrawer" title="Add To Cart">Add To Cart</button> --}}
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $r_sp->danh_muc->ten }}</p>
                                    <h6 class="pc__title text-truncate"><a
                                            href="{{ route('product.detail', ['slug' => $r_sp->slug]) }}">{{ $r_sp->ten }}</a>
                                        {{-- <a href="{{ route('product.detail', ['slug' => $r_sp->slug]) }}">detail</a> --}}
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        @if ($r_sp->gia_giam)
                                            <span
                                                class="price me-1 pc__category text-decoration-line-through">${{ floor($r_sp->gia) }}</span>
                                            <span class="money price text-red">${{ floor($r_sp->gia_giam) }}</span>
                                        @else
                                            <span class="money price text-red">${{ floor($r_sp->gia) }}</span>
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
                                            <input type="hidden" name="product_id" value="{{ $r_sp->id }}">
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
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>
@endsection
