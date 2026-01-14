@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Thêm Slider mới</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề (Title)</label>
                        <input type="text" name="title" class="form-control border px-2" value="{{ old('title') }}" required>
                        @error('title') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phụ đề (Subtitle) - Tùy chọn</label>
                        <input type="text" name="subtitle" class="form-control border px-2" value="{{ old('subtitle') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tagline - Tùy chọn</label>
                        <input type="text" name="tagline" class="form-control border px-2" value="{{ old('tagline') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Đường dẫn (Link)</label>
                        <input type="text" name="link" class="form-control border px-2" value="{{ old('link') }}" required>
                        @error('link') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="image" class="form-control border px-2" required>
                        @error('image') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-control border px-2">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
