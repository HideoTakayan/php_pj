@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <a href="{{ route('danh_mucs.index') }}"><button class="btn btn-warning tf-button-back w180">Danh sách danh mục</button></a>
                <h3>Thông tin danh mục</h3>

                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Danh mục</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm danh mục</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1 needs-validation" action="{{ route('danh_mucs.store') }}"
                    method="POST" enctype="multipart/form-data" novalidate="">
                    @csrf
                    <fieldset class="ten">
                        <div class="body-title">Tên danh mục <span class="tf-color-1">*</span></div>
                        <input class="@error('ten') is-invalid @enderror form-control" type="text"
                            placeholder="Tên danh mục" name="ten" value="{{ old('ten') }}" required>
                    </fieldset>
                    @error('ten')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror
                    <fieldset class="slug">
                        <div class="body-title">Mã nhận diện (Slug) <span class="tf-color-1">*</span></div>
                        <input class="form-control @error('slug') is-invalid @enderror" type="text"
                            placeholder="Mã nhận diện" name="slug" value="{{ old('slug') }}">
                    </fieldset>
                    @error('slug')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror
                    <fieldset>
                        <div class="body-title">Tải ảnh lên <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="upload-1.html" class="effect8" alt="">
                            </div>
                            <div id="upload-file" class="item up-load @error('hinh_anh') error @enderror">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Kéo thả ảnh vào đây hoặc <span class="tf-color">chọn ảnh</span></span>
                                    <input type="file" id="myFile" name="hinh_anh" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('hinh_anh')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror
                    {{-- <fieldset>
                        <div class="body-title">Parent Category</div>
                        <select id="danh_muc_cha_id" name="danh_muc_cha_id"
                            class="flex-grow @error('danh_muc_cha_id') is-invalid @enderror">
                            <option value="">None</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option class="flex-grow" value="{{ $parentCategory->id }}"
                                    {{ old('danh_muc_cha_id') == $parentCategory->id ? 'selected' : '' }}>
                                    {{ $parentCategory->ten }}
                                </option>
                            @endforeach
                        </select>
                        @error('danh_muc_cha_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </fieldset> --}}
                    <div class="bot">
                        <div></div>
                        <button type="reset" class="tf-button style-1 w208">Đặt lại</button>
                        <button class="tf-button w208" type="submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#myFile").on("change", function(e) {
                const photoInp = $("#myFile");
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("input[name='ten']").on("change", function() {
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });

        });

        function StringToSlug(Text) {
            return Text.toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
        }
    </script>
@endpush
