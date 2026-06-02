<div class="col-12 order-2 order-lg-1">
    <!--sidebar-categores-box start  -->
    <div class="sidebar-categores-box mb-30" style="border: 1px solid #e1e1e1; padding: 20px; border-radius: 5px; background: #fff;">
        <div class="sidebar-title mb-20" style="border-bottom: 2px solid #fedc19; padding-bottom: 8px;">
            <h2 style="font-size: 18px; font-weight: bold; margin: 0; color: #333; text-transform: uppercase;">Bộ lọc sản phẩm</h2>
        </div>
        
        <form action="" method="get" id="form-filter">
            <!-- Giữ nguyên các tham số query URL khác (như từ khóa tìm kiếm 'search' hoặc các tham số khác) -->
            @foreach(request()->except(['list_attr_search', 'min_price', 'max_price', 'page']) as $keyRq => $valueRq)
                @if(is_array($valueRq))
                    @foreach($valueRq as $subKey => $subVal)
                        <input type="hidden" name="{{ $keyRq }}[{{ $subKey }}]" value="{{ $subVal }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $keyRq }}" value="{{ $valueRq }}">
                @endif
            @endforeach

            <!-- Bộ lọc giá -->
            <div class="filter-sub-area" style="margin-bottom: 25px;">
                <h5 class="filter-sub-titel" style="font-size: 15px; font-weight: bold; color: #333; margin-bottom: 12px; border-bottom: 1px solid #f1f1f1; padding-bottom: 6px;">Khoảng giá (đ)</h5>
                <div class="price-filter-inputs">
                    <div class="form-group mb-2">
                        <label for="min_price" style="font-size: 12px; color: #666; margin-bottom: 4px;">Giá từ:</label>
                        <div class="input-group">
                            <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Tối thiểu" value="{{ request()->min_price }}" min="0" style="height: 36px; font-size: 14px;">
                            <div class="input-group-append">
                                <span class="input-group-text" style="font-size: 12px; background: #f8f9fa;">đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="max_price" style="font-size: 12px; color: #666; margin-bottom: 4px;">Đến:</label>
                        <div class="input-group">
                            <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Tối đa" value="{{ request()->max_price }}" min="0" style="height: 36px; font-size: 14px;">
                            <div class="input-group-append">
                                <span class="input-group-text" style="font-size: 12px; background: #f8f9fa;">đ</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm w-100" style="background: #fedc19; color: #333; font-weight: bold; border: none; height: 36px; border-radius: 4px; transition: 0.2s;">
                        Áp dụng khoảng giá
                    </button>
                </div>
            </div>

            <!-- Bộ lọc thuộc tính -->
            @foreach(getListAttrSearch($listProductId ?? []) as $attrId => $item)
                <div class="filter-sub-area" style="margin-bottom: 25px;">
                    <h5 class="filter-sub-titel" style="font-size: 15px; font-weight: bold; color: #333; margin-bottom: 12px; border-bottom: 1px solid #f1f1f1; padding-bottom: 6px;">{{ $item['title'] }}</h5>
                    <div class="categori-checkbox">
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            @foreach(array_unique($item['list_search']) as $search)
                                <li style="margin-bottom: 8px; display: flex; align-items: center;">
                                    <input class="list_attr_search" 
                                           name="list_attr_search[{{ $attrId }}][]" 
                                           type="checkbox" 
                                           value="{{ $search }}"
                                           style="width: 16px; height: 16px; margin-right: 8px; cursor: pointer;"
                                           @if(!empty(request()->list_attr_search[$attrId]) && in_array($search, request()->list_attr_search[$attrId])) checked @endif>
                                    <a href="#" class="filter-attr-link" style="color: #666; font-size: 14px; text-decoration: none; transition: 0.2s;">{{ $search }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            <!-- Nút Xóa bộ lọc nếu đang áp dụng lọc -->
            @if(!empty(request()->list_attr_search) || request()->has('min_price') || request()->has('max_price'))
                <div class="mt-20">
                    <a href="{{ url()->current() . (!empty(request()->except(['list_attr_search', 'min_price', 'max_price', 'page'])) ? '?' . http_build_query(request()->except(['list_attr_search', 'min_price', 'max_price', 'page'])) : '') }}" 
                       class="btn btn-sm btn-danger w-100 text-white" 
                       style="border-radius: 4px; font-weight: bold; height: 36px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                       Xóa tất cả bộ lọc
                    </a>
                </div>
            @endif
        </form>
    </div>
    <!--sidebar-categores-box end  -->
</div>

@section('js_attr_search')
    <script>
        $(document).ready(function () {
            // Khi check hoặc uncheck checkbox thuộc tính, tự động submit form
            $('.list_attr_search').change(function () {
                $('#form-filter').submit();
            });

            // Click vào nhãn chữ bên cạnh checkbox cũng sẽ trigger checkbox
            $('.filter-attr-link').click(function (e) {
                e.preventDefault();
                let checkbox = $(this).siblings('.list_attr_search');
                checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
            });

            // Thêm hover effect cho nút Áp dụng và link thuộc tính
            $('.filter-attr-link').hover(
                function() { $(this).css('color', '#fedc19'); },
                function() { $(this).css('color', '#666'); }
            );
        });
    </script>
@endsection
