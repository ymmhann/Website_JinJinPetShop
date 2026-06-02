@extends('layouts.master_user')
@section('content')
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>
   


    <section class="product-area li-laptop-product Special-product pt-60 pb-45">
        <h5 class="text-center">Tìm thấy {{ $listProduct->count() }} sản phẩm cho từ khóa '{{ $search }}'</h5>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('web.include.attr_search', ['listProductId' => $listProductId])
                </div>
                <div class="col-9">
                    <div class="row">
                        @forelse($listProduct as $product)
                            @include('web.include.item_product_search')
                        @empty
                            <div class="col-12 text-center py-4 w-100">
                                <p class="alert alert-warning" style="font-weight: 500; font-size: 15px; margin: 20px 0;">Không có sản phẩm phù hợp với điều kiện lọc.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $listProduct->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
