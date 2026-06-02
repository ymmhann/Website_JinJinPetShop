@extends('layouts.master_admin')

@section('search')
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="{{ route('admin.cities.index') }}">
            <input type="text" name="search" placeholder="Tìm kiếm" value="{{ request()->get('search') ?? '' }}">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
@endsection

@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <div>
            <h1>Danh sách phí vận chuyển của các tỉnh/thành phố</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Danh sách</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Tổng quan</a></li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Thêm mới</a>
    </div><!-- End Page Title -->
    <table class="table table-bordered border border-primary" style="text-align: center">
        <tr>
            <th>ID</th>
            <th>Tên tỉnh/thành phố</th>
            <th>Phí vận chuyển</th>
            <th>Hành động</th>
        </tr>
        @foreach($listCity as $city)
            <tr>
                <td>{{ $city->id }}</td>
                <td>{{ $city->name }}</td>
                <td>{{ formatVnd($city->shipping_fee) }}</td>

                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-success btn-sm rounded-0"><i class="bi bi-pencil"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <form action="{{ route('admin.cities.destroy', $city->id ) }}" method="post" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0 btn-delete-index" data-id="{{ $city->id }}"><i class="bi bi-trash"></i></button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $listCity->appends(request()->input())->links() }}</div>
@endsection
