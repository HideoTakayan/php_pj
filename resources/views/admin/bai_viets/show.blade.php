@extends('layouts.admin')

@section('content')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-10">
                <div class="cols gap10 d-flex">
                    <a href="{{ route('bai_viets.index') }}"><button class="tf-button style-1 w108">Back to lists</button></a>
                    <a href="{{ route('bai_viets.edit', $baiViet) }}"><button class="btn btn-warning tf-button-back w180">Edit
                            Post</button></a>
                </div>
                <h3>Detail Post</h3>
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
                        <a href="">
                            <div class="text-tiny">post</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Detail post</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-add-product">
                    <fieldset class="name">
                        <div class="body-title mb-10">Post Name</div>
                        <input class="mb-10 @error('ten') is-invalid @enderror form-control" type="text"
                            placeholder="Enter Post Name" name="ten" tabindex="0" aria-required="true"
                            value="{{ old('ten', $baiViet->ten) }}" readonly>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Post Slug</div>
                        <input class="mb-10 @error('slug') is-invalid @enderror form-control" type="text"
                            placeholder="Enter Post Slug" name="slug" tabindex="0" aria-required="true"
                            value="{{ old('slug', $baiViet->slug) }}" readonly>
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title mb-10">Post content</div>
                        <div class="">{!! $baiViet->noi_dung !!}</div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
@endsection
