@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Sản phẩm yêu thích</h2>
            <div class="row">
                @include('user.account-nav')
                <div class="col-lg-9">
                    <div class="page-content my-account__wishlist">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        @if($items->count() > 0)
                            <div class="products-list-grid">
                                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                                    @foreach($items as $item)
                                        <div class="col">
                                            <div class="product-card-wrapper">
                                                <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                                    <div class="pc__img-wrapper">
                                                        <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide">
                                                                    <a href="{{ route('product.detail', ['slug' => $item->product->slug]) }}">
                                                                        <img loading="lazy" src="{{ check_image_url($item->product->main_image) }}" width="330" height="400" alt="{{ $item->product->ten }}" class="pc__img">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('wishlist.remove', ['id' => $item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-remove-from-wishlist">
                                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <use href="#icon_close" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
        
                                                    <div class="pc__info position-relative">
                                                        <p class="pc__category">{{ $item->product->danh_muc->ten }}</p>
                                                        <h6 class="pc__title"><a href="{{ route('product.detail', ['slug' => $item->product->slug]) }}">{{ $item->product->ten }}</a></h6>
                                                        <div class="product-card__price d-flex">
                                                            <span class="money price">{{ number_format($item->product->gia, 2) }} $</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">Chưa có sản phẩm nào trong danh sách yêu thích.</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <style>
        .btn-remove-from-wishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .btn-remove-from-wishlist:hover {
            background: #ff4d4d;
            color: #fff;
        }
    </style>
@endsection
