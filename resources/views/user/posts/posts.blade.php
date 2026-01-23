@extends('layouts.app')

@section('css')
    <style>
        header {
            background-color: #3b5998;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Định dạng nội dung */
        .post-container {
            width: 1200px;
            margin: 0 auto
        }

        .posts {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
        }

        .post {
            background-color: #fff;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 10px;
        }

        .post:hover {
            cursor: pointer;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .post-header h3 {
            margin: 0;
            font-size: 16px;
        }

        .post-image {
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
        }

        .post-content p {
            margin-top: 0;
            font-size: 14px;
            color: #333;
        }

        .post-info {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #888;
        }
    </style>
@endsection

@section('content')
    <div class="post-container">
        @if ($baiViets->isEmpty())
            <div class="alert alert-info text-center my-5" role="alert">
                <h3>Trang web hiện tại chưa có bài viết nào</h3>
            </div>
        @else
            <div class="posts">
                @foreach ($baiViets as $post)
                    <a href="{{ route('post.detail', $post->slug) }}" class="post">
                        <div class="post-header">
                            <h3>{{ $post->user->name }}</h3>
                        </div>
                        <div class="post-content">
                            <h2>{{ $post->ten }}</h2>
                            <div class="">{!! $post->noi_dung !!}</div>
                        </div>
                        <div class="post-image">
                            <img src=" {{ check_image_url($post->anh_bia) }}" alt="{{ $post->ten }}">
                        </div>
                        <div class="post-info">
                            <span>Đã đăng: {{ $post->created_at->diffForHumans() }}</span>
                            <span>Ngày tạo: {{ $post->created_at->format('d/m/Y') }}</span>
                            <span>Lượt xem: {{ $post->luot_xem }}</span>
                            <span>Lượt thích: {{ $post->luot_thich }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
