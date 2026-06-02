@extends('layouts.master_user')
@section('content')
   

    <section class="product-area li-laptop-product Special-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-3">
                    @include('web.include.attr_search', ['listProductId' => $listProductId])
                </div>

                <div class="col-9">
                    <div class="li-section-title">
                        <h2>
                            <span>{{ $category->name }}</span>
                        </h2>
                    </div>
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
                <!-- Li's Section Area End Here -->
            </div>

            <div class="row">
                <div class="col-12">
                    {{ $listProduct->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
