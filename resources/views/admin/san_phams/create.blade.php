@extends('layouts.admin')

@section('content')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <a href="{{ route('san_phams.index') }}"><button class="btn btn-warning tf-button-back w180">Back to lists</button></a>
                <h3>Add Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="all-product.html">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('san_phams.store') }}">
                @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('ten') is-invalid @enderror form-control" type="text"
                            placeholder="Enter product name" name="ten" tabindex="0" aria-required="true"
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
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('slug') is-invalid @enderror form-control" type="text"
                            placeholder="Enter product slug" name="slug" tabindex="0" aria-required="true"
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
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                            <div class="select mb-10 ">
                                <select class="@error('danh_muc_id') error-border @enderror" name="danh_muc_id">
                                    <option value="">Choose category</option>
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
                        <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150 @error('mo_ta_ngan') error-border @enderror" name="mo_ta_ngan"
                            placeholder="Short Description" tabindex="0" aria-required="true">{{ old('mo_ta_ngan') }}</textarea>
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
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                        <textarea id="mo_ta" class="mb-10 @error('mo_ta') error-border @enderror " name="mo_ta"
                            placeholder="Description" tabindex="0" aria-required="true">{{ old('mo_ta') }}</textarea>
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
                        <div class="body-title mb-10">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow mb-10">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="" class="effect8" alt="">
                            </div>
                            <div id="upload-file" class="item up-load @error('hinh_anh') error @enderror">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
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
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="upload-image mb-16">
                            <div id ="galUpload" class="item up-load @error('hinh_anh_chi_tiet') error @enderror">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
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
                            <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('gia') is-invalid @enderror form-control" type="text"
                                placeholder="Enter regular price" name="gia" tabindex="0"  value="{{ old('gia') }}"
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
                            <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('gia_giam') is-invalid @enderror form-control" type="text"
                                placeholder="None" name="gia_giam" tabindex="0" value="{{ old('gia_giam') }}" aria-required="true">
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
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('ma_sp') is-invalid @enderror form-control" type="text"
                                placeholder="Enter SKU" name="ma_sp" tabindex="0" value="{{ old('ma_sp') }}"
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
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span></div>
                            <input class="mb-10 @error('so_luong') is-invalid @enderror form-control" type="text"
                                placeholder="Enter quantity" name="so_luong" tabindex="0" value="{{ old('so_luong') }}"
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
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select class="" name="tinh_trang">
                                    <option value="con hang">InStock</option>
                                    <option value="het hang">Out of Stock</option>
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
                            <div class="body-title mb-10">Hot</div>
                            <div class="select mb-10">
                                <select class="" name="hot">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
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
                        <button class="tf-button w-full" type="submit">Add product</button>
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
