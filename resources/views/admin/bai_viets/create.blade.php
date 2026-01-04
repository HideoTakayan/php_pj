@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <a href="{{ route('bai_viets.store') }}"><button class="btn btn-warning tf-button-back w180">Back to
                        lists</button></a>
                <h3>Add Post</h3>
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
                            <div class="text-tiny">Posts</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add post</div>
                    </li>
                </ul>
            </div>

            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('bai_viets.store') }}">
                @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Post name <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('ten') is-invalid @enderror form-control" type="text"
                            placeholder="Enter post name" name="ten" tabindex="0" aria-required="true"
                            value="{{ old('ten') }}">
                        @error('ten')
                            <div class="text-tiny text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10 @error('slug') is-invalid @enderror form-control" type="text"
                            placeholder="Enter post slug" name="slug" tabindex="0" aria-required="true"
                            value="{{ old('slug') }}">
                        @error('slug')
                            <div class="text-tiny text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow mb-10">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="" class="effect8" alt="">
                            </div>
                            <div id="upload-file" class="item up-load @error('anh_bia') error @enderror">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="anh_bia" accept="image/*">
                                </label>
                            </div>
                        </div>
                        @error('anh_bia')
                            <div class="text-tiny text-danger mt-4">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Published</div>
                            <div class="select mb-10">
                                <select class="" name="is_publish">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Comment</div>
                            <div class="select mb-10">
                                <select class="" name="is_comment">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="wg-box">
                    <fieldset class="noi_dung">
                        <div class="body-title mb-10">Content <span class="tf-color-1">*</span></div>
                        <textarea id="noi_dung" class="mb-10 @error('noi_dung') error-border @enderror " name="noi_dung"
                            placeholder="Description" tabindex="0" aria-required="true">{{ old('noi_dung') }}</textarea>
                    </fieldset>
                    @error('noi_dung')
                        <div class="text-tiny text-danger">{{ $message }}</div>
                    @enderror

                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Add Post</button>
                    </div>
                </div>
            </form>
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
            return 'post-' + Text.toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
        }
    </script>
@endpush
