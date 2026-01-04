@extends('layouts.app')

@section('css')
    <style>
        .post-container {
            max-width: 1200px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Post header */
        .post-header {
            padding: 20px;
            border-bottom: 1px solid #e6e6e6;
        }

        .post-header h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .post-header .post-meta {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        /* Post content */
        .post-content {
            padding: 20px;
        }

        .post-content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .post-content img {
            height: 300px;
            max-width: 100%;
            height: auto;
            margin-bottom: 16px;
        }

        /* Post footer */
        .post-footer {
            padding: 20px;
            border-top: 1px solid #e6e6e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-footer .post-stats {
            font-size: 14px;
            color: #666;
        }

        .post-footer .post-actions {
            display: flex;
            gap: 10px;
        }

        .post-footer .post-actions button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="post-container">
        <div class="post-header">
            <h1>{{ $baiViet->ten }}</h1>
            <div class="post-meta">
                <span>Đăng bởi: {{ $baiViet->user->name }}</span>
                <span> - </span>
                <span>Thời gian đăng: {{ $baiViet->created_at->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="post-content">
            <img src="{{ check_image_url($baiViet->anh_bia) }}" alt="Ảnh bài viết">
            <div>{!! $baiViet->noi_dung !!}</div>
        </div>
        <div class="post-footer">
            <div class="post-stats">
                <span>Lượt xem: {{ $baiViet->luot_xem }}</span>
                <span>Lượt thích: {{ $baiViet->luot_thich }}</span>
            </div>
            <div class="post-actions">
                <button>Thích</button>
            </div>
        </div>
    </div>
@endsection
