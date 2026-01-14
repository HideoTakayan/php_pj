@extends('layouts.admin')

@section('content')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <a href="{{ route('san_phams.index') }}"><button class="btn btn-warning tf-button-back w180">Danh sách sản phẩm</button></a>
                <h3>Thêm sản phẩm</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="all-product.html">
                            <div class="text-tiny">Sản phẩm</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm sản phẩm</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('san_phams.store') }}">
                @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Tên sản phẩm <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('ten') is-invalid @enderror form-control" type="text"
                            placeholder="Nhập tên sản phẩm" name="ten" tabindex="0" aria-required="true"
                            value="{{ old('ten') }}">
                        @error('ten')
                            <div class="text-tiny text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    {{-- @error('ten')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror --}}

                    <fieldset class="name">
                        <div class="body-title mb-10">Mã nhận diện (Slug) <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('slug') is-invalid @enderror form-control" type="text"
                            placeholder="Nhập mã nhận diện" name="slug" tabindex="0" aria-required="true"
                            value="{{ old('slug') }}">
                        @error('slug')
                            <div class="text-tiny text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </fieldset>
                    {{-- @error('slug')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror --}}

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span></div>
                            <div class="select mb-10 ">
                                <select class="@error('danh_muc_id') error-border @enderror" name="danh_muc_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($danhMucs as $danhMuc)
                                        <option value="{{ $danhMuc->id }}"
                                            {{ old('danh_muc_id') == $danhMuc->id ? 'selected' : '' }}>
                                            {{ $danhMuc->ten }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('danh_muc_id')
                                <div class="text-tiny text-danger mt-4">
                                    {{ $message }}
                                </div>
                            @enderror
                        </fieldset>
                        {{-- @error('danh_muc_id')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}

                        {{-- <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror --}}
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Mô tả ngắn <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150 @error('mo_ta_ngan') error-border @enderror" name="mo_ta_ngan"
                            placeholder="Mô tả ngắn" tabindex="0" aria-required="true">{{ old('mo_ta_ngan') }}</textarea>
                        @error('mo_ta_ngan')
                            <div class="text-tiny text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    {{-- @error('mo_ta_ngan')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror --}}

                    <fieldset class="description">
                        <div class="body-title mb-10">Mô tả chi tiết <span class="tf-color-1">*</span></div>
                        <textarea id="mo_ta" class="mb-10 @error('mo_ta') error-border @enderror " name="mo_ta"
                            placeholder="Mô tả chi tiết" tabindex="0" aria-required="true">{{ old('mo_ta') }}</textarea>
                    </fieldset>
                    @error('mo_ta')
                        <div class="text-tiny text-danger">{{ $message }}</div>
                    @enderror
                    {{-- @error('mo_ta')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror --}}
                </div>

                <div class="wg-box">
                    <fieldset>
                        <div class="body-title mb-10">Tải ảnh sản phẩm <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow mb-10">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="" class="effect8" alt="">
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
                        @error('hinh_anh')
                            <div class="text-tiny text-danger mt-4">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    {{-- @error('hinh_anh')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror --}}

                    <fieldset>
                        <div class="body-title mb-10">Tải thư viện ảnh</div>
                        <div class="upload-image mb-16">
                            <div id ="galUpload" class="item up-load @error('hinh_anh_chi_tiet') error @enderror">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Kéo thả ảnh vào đây hoặc <span class="tf-color">chọn ảnh</span></span>
                                            
                                    <input type="file" id="gFile" name="hinh_anh_chi_tiet[]" accept="image/*"
                                        multiple>
                                </label>
                            </div>
                        </div>
                        @error('hinh_anh_chi_tiet')
                            <div class="text-tiny text-danger mt-4">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    {{-- @error('hinh_anh_chi_tiet')
                        <fieldset class="">
                            <div class=""></div>
                            <span class="text-danger grow fs-4 mx-3">
                                {{ $message }}
                            </span>
                        </fieldset>
                    @enderror --}}
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Giá niêm yết <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('gia') is-invalid @enderror form-control" type="text"
                                placeholder="Nhập giá niêm yết" name="gia" tabindex="0"  value="{{ old('gia') }}"
                                aria-required="true">
                            @error('gia')
                                <div class="text-tiny text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        {{-- @error('gia')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}

                        <fieldset class="name">
                            <div class="body-title mb-10">Giá bán (khuyến mãi) <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('gia_giam') is-invalid @enderror form-control" type="text"
                                placeholder="Không có" name="gia_giam" tabindex="0" value="{{ old('gia_giam') }}" aria-required="true">
                            @error('gia_giam')
                                <div class="text-tiny text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        {{-- @error('gia_giam')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}
                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Mã kho hàng (SKU) <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('ma_sp') is-invalid @enderror form-control" type="text"
                                placeholder="Nhập mã SKU" name="ma_sp" tabindex="0" value="{{ old('ma_sp') }}"
                                aria-required="true">
                            @error('ma_sp')
                                <div class="text-tiny text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        {{-- @error('ma_sp')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}
                        <fieldset class="name">
                            <div class="body-title mb-10">Số lượng <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('so_luong') is-invalid @enderror form-control" type="text"
                                placeholder="Nhập số lượng" name="so_luong" tabindex="0" value="{{ old('so_luong') }}"
                                aria-required="true">
                            @error('so_luong')
                                <div class="text-tiny text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        {{-- @error('so_luong')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Tình trạng kho</div>
                            <div class="select mb-10">
                                <select class="" name="tinh_trang">
                                    <option value="con hang">Còn hàng</option>
                                    <option value="het hang">Hết hàng</option>
                                </select>
                            </div>
                        </fieldset>
                        {{-- @error('tinh_trang')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}

                        <fieldset class="name">
                            <div class="body-title mb-10">Sản phẩm nổi bật</div>
                            <div class="select mb-10">
                                <select class="" name="hot">
                                    <option value="0">Không</option>
                                    <option value="1">Có</option>
                                </select>
                            </div>
                        </fieldset>
                        {{-- @error('hot')
                            <fieldset class="">
                                <div class=""></div>
                                <span class="text-danger grow fs-4 mx-3">
                                    {{ $message }}
                                </span>
                            </fieldset>
                        @enderror --}}

                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Thêm sản phẩm</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
@endsection

@push('scripts')
    <script>
        $(function() {
            // CKEDITOR.replace('mo_ta');
            // if (typeof CKEDITOR !== 'undefined') {
            //     for (var instance in CKEDITOR.instances) {
            //         if (CKEDITOR.instances.hasOwnProperty(instance)) {
            //             CKEDITOR.instances[instance].config.versionCheck = false;
            //         }
            //     }
            // }
            // ClassicEditor
            //     .create(document.querySelector('#mo_ta'))
            //     .catch(error => {
            //         console.error(error);
            //     });

            $("#myFile").on("change", function(e) {
                const photoInp = $("#myFile");
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });


            $("#gFile").on("change", function(e) {
                // $(".gitems").remove();
                const photoInp = $("gFile");
                const gphotos = this.files;
                $.each(gphotos, function(key, val) {
                    $("#galUpload").prepend(
                        `<div class="item gitems"><img src="${URL.createObjectURL(val)}" alt=""></div>`
                    );
                });
            });


            $("input[name='ten']").on("change", function() {
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });

        });

        function StringToSlug(Text) {
            return 'san-pham-' + Text.toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
        }
    </script>
@endpush
