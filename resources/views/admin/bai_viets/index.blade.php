@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>All Post</h3>
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
                        <div class="text-tiny">All Post</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('bai_viets.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="search"
                                    tabindex="2" value="{{ request()->input('search') }}" aria-required="true">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('bai_viets.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Thumbnail</th>
                                <th>Views</th>
                                <th>Likes</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($baiViets as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="">
                                        <div class="name text-truncate ">
                                            <a href="" class="body-title-2">{{ $item->ten }}</a>
                                            <div class="text-truncate text-tiny mt-3">{{ $item->slug }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            <img src="{{ check_image_url($item->anh_bia) }}"
                                                style="border-radius: 4px; width: 80px; object-fit:cover;">
                                        </div>
                                    </td>
                                    <td>{{ $item->luot_xem }}</td>
                                    <td>{{ $item->luot_thich }}</td>
                                    <td class="text-truncate">{{ $item->user->name }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('bai_viets.show', $item) }}">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </a>
                                            <a href="{{ route('bai_viets.edit', $item) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{ route('bai_viets.destroy', $item) }}" method="POST">
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
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                </div>
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
