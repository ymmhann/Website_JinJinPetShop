@extends('layouts.master_admin')
@section('content')
    <div class="pagetitle">
        <h1>Thêm mới phí vận chuyển</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm mới</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">Danh sách</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cities.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group pt-3">
            <label for="name">Tên tỉnh/thành phố:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập tên tỉnh/thành phố">
        </div>

        <div class="form-group pt-3">
            <label for="shipping_fee">Phí vận chuyển:</label>
            <input type="text" name="shipping_fee" class="form-control" value="{{ old('shipping_fee') }}" placeholder="Ví dụ: 45,000 hoặc 45000">
        </div>

        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection
