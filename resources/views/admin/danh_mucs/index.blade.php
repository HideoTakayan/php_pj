@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Categories</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Categories</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('danh_mucs.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="search"
                                    tabindex="2" value="{{ request()->input('search') }}" aria-required="true">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('danh_mucs.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <table class="table table-striped table-bordered">
                        {{-- @if (Session::has('success'))
                            <h5 class="alert alert-success">{{ Session::get('success') }}</h5>
                        @endif --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                {{-- <th>Parent Category</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danhMucs as $danhMuc)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ check_image_url($danhMuc->hinh_anh) }}" alt="" class="image">
                                        </div>
                                        <div class="name text-truncate ">
                                            <a href="#" class="body-title-2">{{ $danhMuc->ten }}</a>
                                        </div>
                                    </td>
                                    <td class="text-truncate">{{ $danhMuc->slug }}</td>
                                    {{-- <td>{{ $danhMuc->danh_muc_cha_id != NULL ? $danhMuc->cha->ten : '' }}</td> --}}
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('danh_mucs.edit', $danhMuc) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{ route('danh_mucs.destroy', $danhMuc) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $danhMucs->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".delete").on('click', function(e) {
                e.preventDefault();
                var selectedForm = $(this).closest('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        selectedForm.submit();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            timer: 10000,
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>
@endpush
