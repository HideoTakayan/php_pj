@extends('layouts.admin')

@section('content')
<div class="wg-table table-all-user">
    <table class="table table-striped table-bordered">
        {{-- @if (Session::has('success'))
            <h5 class="alert alert-success">{{ Session::get('success') }}</h5>
        @endif --}}
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Mô tả</th>
                {{-- <th>Parent Category</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listLienHe as $index => $lienHe)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $lienHe ->name}}</td>
                <td>{{ $lienHe ->phone}}</td>
                <td>{{ $lienHe ->email}}</td>
                <td>{{ $lienHe ->describe}}</td>
                <td>
                    <button type="submit">Ẩn</button>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection