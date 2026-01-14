@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Sửa Slider</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề (Title)</label>
                        <input type="text" name="title" class="form-control border px-2" value="{{ old('title', $slider->title) }}" required>
                        @error('title') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phụ đề (Subtitle) - Tùy chọn</label>
                        <input type="text" name="subtitle" class="form-control border px-2" value="{{ old('subtitle', $slider->subtitle) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tagline - Tùy chọn</label>
                        <input type="text" name="tagline" class="form-control border px-2" value="{{ old('tagline', $slider->tagline) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Đường dẫn (Link)</label>
                        <input type="text" name="link" class="form-control border px-2" value="{{ old('link', $slider->link) }}" required>
                        @error('link') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh (Chỉ chọn nếu muốn thay đổi)</label>
                        <input type="file" name="image" class="form-control border px-2">
                        @if ($slider->image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($slider->image) }}" width="150" alt="Current Image">
                            </div>
                        @endif
                        @error('image') <div class="text-danger text-xs">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-control border px-2">
                            <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
