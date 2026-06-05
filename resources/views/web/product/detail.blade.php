@extends('layouts.master_user')

@section('content')
    <!-- Google Fonts for Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- CSS Custom Style cho trang Chi Tiết Sản Phẩm -->
    <style>
        .bookstore-detail-wrapper {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfd;
            color: #2c3e50;
            padding-bottom: 80px;
        }

        /* Breadcrumb Custom */
        .bookstore-breadcrumb {
            background: transparent;
            padding: 20px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #f1f3f5;
        }
        .bookstore-breadcrumb ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 13px;
        }
        .bookstore-breadcrumb ul li {
            color: #868e96;
        }
        .bookstore-breadcrumb ul li a {
            color: #495057;
            text-decoration: none;
            transition: 0.2s;
        }
        .bookstore-breadcrumb ul li a:hover {
            color: #fedc19;
        }
        .bookstore-breadcrumb ul li::after {
            content: "/";
            margin: 0 10px;
            color: #dee2e6;
        }
        .bookstore-breadcrumb ul li:last-child::after {
            content: "";
        }
        .bookstore-breadcrumb ul li.active {
            color: #2b2b2b;
            font-weight: 600;
        }

        /* Cột bên trái - Ảnh đại diện sản phẩm */
        .book-gallery-container {
            position: sticky;
            top: 100px;
            background: #fff;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #eaecef;
            box-shadow: 0 8px 30px rgba(0,0,0,0.02);
        }
        .book-main-image {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            margin-bottom: 16px;
            border: 1px solid #f1f3f5;
            transition: transform 0.3s ease;
            aspect-ratio: 3/4;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .book-main-image:hover {
            transform: scale(1.02);
        }
        .book-main-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .book-thumbs-slider {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 8px;
        }
        .book-thumbs-slider::-webkit-scrollbar {
            height: 4px;
        }
        .book-thumbs-slider::-webkit-scrollbar-thumb {
            background-color: #ced4da;
            border-radius: 4px;
        }
        .book-thumb-item {
            width: 70px;
            height: 90px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: 0.2s;
            flex-shrink: 0;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .book-thumb-item img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .book-thumb-item.active, .book-thumb-item:hover {
            border-color: #fedc19;
            box-shadow: 0 4px 10px rgba(254, 220, 25, 0.15);
        }

        /* Cột bên phải - Thông tin chi tiết */
        .book-info-panel {
            padding-left: 15px;
        }
        .book-category-tag {
            display: inline-block;
            background: #f1f3f5;
            color: #495057;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }
        .book-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.3;
            color: #1a252c;
            margin-bottom: 10px;
        }
        
        /* Metadata tác giả, nhà xuất bản */
        .book-meta-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 24px;
        }
        .book-meta-inline span strong {
            color: #343a40;
        }

        /* Khung giá sản phẩm */
        .book-price-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 24px;
            border: 1px solid #eaecef;
        }
        .book-price-row {
            display: flex;
            align-items: baseline;
            gap: 12px;
            flex-wrap: wrap;
        }
        .book-price-actual {
            font-size: 30px;
            font-weight: 800;
            color: #d93838;
        }
        .book-price-original {
            font-size: 16px;
            color: #adb5bd;
            text-decoration: line-through;
        }
        .book-discount-badge {
            background: #ffe3e3;
            color: #e03131;
            font-size: 12px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
        }

        /* Thanh trạng thái tồn kho trực quan */
        .stock-status-bar-container {
            margin-top: 15px;
        }
        .stock-progress-bar {
            height: 6px;
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 6px;
        }
        .stock-progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }
        .stock-fill-green {
            background: #2b8a3e;
            width: 100%;
        }
        .stock-fill-orange {
            background: #e67e22;
            width: 25%;
        }
        .stock-fill-red {
            background: #c92a2a;
            width: 0%;
        }

        /* Mô tả tóm tắt */
        .book-short-desc {
            font-size: 15px;
            line-height: 1.6;
            color: #495057;
            margin-bottom: 24px;
        }

        /* Variant selector custom */
        .book-variant-section {
            margin-bottom: 24px;
        }
        .book-variant-section label {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #343a40;
        }
        .variant-select-custom {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0 15px;
            width: 100%;
            max-width: 350px;
            font-size: 14px;
            font-weight: 500;
            color: #495057;
            background: #fff;
            outline: none;
            cursor: pointer;
            transition: 0.2s;
        }
        .variant-select-custom:focus {
            border-color: #fedc19;
            box-shadow: 0 0 0 3px rgba(254, 220, 25, 0.25);
        }

        /* Số lượng và Nút bấm */
        .book-action-section {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
            border-top: 1px solid #f1f3f5;
            padding-top: 30px;
        }
        
        /* Quantity selector modern */
        .modern-qty-selector {
            display: flex;
            align-items: center;
            border: 1px solid #ced4da;
            border-radius: 30px;
            height: 48px;
            padding: 0 8px;
            background: #fff;
            width: 130px;
            justify-content: space-between;
        }
        .modern-qty-btn {
            background: none;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #495057;
            transition: 0.2s;
        }
        .modern-qty-btn:hover {
            background: #f1f3f5;
            color: #1a252c;
        }
        .modern-qty-input {
            width: 45px;
            text-align: center;
            border: none;
            font-weight: 700;
            font-size: 16px;
            color: #2c3e50;
            outline: none;
            background: transparent;
        }

        /* Nút Action */
        .btn-book-action {
            height: 48px;
            padding: 0 28px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-book-cart {
            background: #fff;
            color: #2c3e50;
            border: 2px solid #2c3e50;
        }
        .btn-book-cart:hover:not(:disabled) {
            background: #2c3e50;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(44, 62, 80, 0.15);
        }
        .btn-book-buy {
            background: linear-gradient(135deg, #fedc19 0%, #feca07 100%);
            color: #1a252c;
            box-shadow: 0 4px 15px rgba(254, 220, 25, 0.3);
        }
        .btn-book-buy:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(254, 220, 25, 0.5);
        }
        .btn-book-action:disabled {
            background: #e9ecef !important;
            color: #adb5bd !important;
            border-color: #dee2e6 !important;
            box-shadow: none !important;
            cursor: not-allowed !important;
        }

        /* Khung Tabs Mô tả & Thông tin sản phẩm */
        .book-tabs-section {
            margin-top: 60px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid #eaecef;
            box-shadow: 0 8px 30px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .book-tabs-header {
            display: flex;
            background: #f8f9fa;
            border-bottom: 1px solid #eaecef;
        }
        .book-tab-btn {
            padding: 16px 28px;
            font-weight: 700;
            font-size: 15px;
            color: #868e96;
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: 0.2s;
        }
        .book-tab-btn.active {
            color: #2c3e50;
            border-bottom-color: #fedc19;
            background: #fff;
        }
        .book-tab-content {
            padding: 35px;
        }
        .book-tab-pane {
            display: none;
            line-height: 1.8;
            font-size: 15px;
            color: #495057;
        }
        .book-tab-pane.active {
            display: block;
        }

        /* Bảng thông số thuộc tính sản phẩm */
        .book-spec-table {
            width: 100%;
            border-collapse: collapse;
        }
        .book-spec-table tr {
            border-bottom: 1px solid #f1f3f5;
        }
        .book-spec-table tr:last-child {
            border-bottom: none;
        }
        .book-spec-table th {
            width: 25%;
            font-weight: 700;
            color: #495057;
            padding: 14px 20px;
            text-align: left;
            background: #fcfcfd;
        }
        .book-spec-table td {
            color: #6c757d;
            padding: 14px 20px;
        }

        /* Section Sản phẩm tương tự */
        .related-products-section {
            margin-top: 80px;
        }
        .related-products-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: #1a252c;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }
        .related-products-title::after {
            content: "";
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 60px;
            height: 3px;
            background: #fedc19;
            border-radius: 10px;
        }
    </style>

    <div class="bookstore-detail-wrapper">
        <!-- Begin Bookstore Breadcrumb Area -->
        <div class="bookstore-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Chi tiết sản phẩm</li>
                </ul>
            </div>
        </div>
        <!-- Bookstore Breadcrumb Area End Here -->

        <!-- content-wraper start -->
        <div class="container">
            <div class="row">
                <!-- Cột trái: Ảnh sản phẩm -->
                <div class="col-lg-5 col-md-6 mb-4">
                    <div class="book-gallery-container">
                        <div class="book-main-image">
                            <a class="popup-img venobox vbox-item" href="{{ $product->getImage() }}" data-gall="myGallery" id="main-image-link">
                                <img src="{{ $product->getImage() }}" alt="{{ $product->name }}" id="main-image-img">
                            </a>
                        </div>
                        
                        <div class="book-thumbs-slider">
                            <div class="book-thumb-item active" onclick="changeMainImage('{{ $product->getImage() }}', this)">
                                <img src="{{ $product->getImage() }}">
                            </div>
                            @if(!empty($listImage))
                                @foreach($listImage as $image)
                                    <div class="book-thumb-item" onclick="changeMainImage('{{ $image->getImage() }}', this)">
                                        <img src="{{ $image->getImage() }}">
                                    </div>
                                @endforeach
                            @endif

                            @if(!empty($product->listProductChild))
                                @foreach($product->listProductChild as $productChild)
                                    @if($productChild->getImage() != asset('images/not_found.jpg'))
                                        <div class="book-thumb-item" data-id="{{ $productChild->id }}" onclick="changeMainImage('{{ $productChild->getImage() }}', this)">
                                            <img src="{{ $productChild->getImage() }}">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Thông tin & Mua hàng -->
                <div class="col-lg-7 col-md-6">
                    <div class="book-info-panel">
                        <div class="book-category-tag">
                            {{ $product->Category->name ?? 'Sản phẩm mới' }}
                        </div>
                        
                        <h1 class="book-title">{{ $product->name }}</h1>
                        


                        <!-- Card hiển thị giá và trạng thái tồn kho -->
                        <div class="book-price-card">
                            <div class="book-price-row">
                                <span class="book-price-actual" id="product-price">{{ formatVnd($product->price) }}</span>
                                <span class="book-price-original">{{ formatVnd($product->price * 1.25) }}</span>
                                <span class="book-discount-badge">Tiết kiệm 20%</span>
                            </div>
                            
                            <!-- Tiến trình tồn kho trực quan -->
                            <div class="stock-status-bar-container">
                                <div class="d-flex justify-content-between align-items-center font-weight-bold" style="font-size: 13px;">
                                    <span style="color: #495057;">Tình trạng kho hàng:</span>
                                    <span id="product-stock-display">Đang tính toán...</span>
                                </div>
                                <div class="stock-progress-bar">
                                    <div class="stock-progress-fill" id="stock-progress-fill-bar"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Mô tả tóm tắt sản phẩm -->
                        <div class="book-short-desc">
                            {{ Str::limit($product->description, 200, '...') }}
                        </div>

                        <!-- Chọn phiên bản (nếu có configurable/variants) -->
                        @if(!empty($product->listProductChild) && $product->listProductChild->count() > 0)
                            <div class="book-variant-section">
                                <label for="product-child-select">Chọn phiên bản sản phẩm:</label>
                                <select class="variant-select-custom" id="product-child-select">
                                    @foreach($product->listProductChild as $productChild)
                                        <option value="{{ $productChild->id }}"
                                                data-quantity="{{ $productChild->getQuantityActive() }}"
                                                data-price="{{ formatVnd($productChild->price) }}">
                                            {{ $productChild->attributeTitle() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Modern Action Section -->
                        <div class="book-action-section">
                            <!-- Modern Quantity Selector -->
                            <div class="modern-qty-selector">
                                <button type="button" class="modern-qty-btn" id="qty-dec-btn">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input class="modern-qty-input" value="1" type="text" id="quantity">
                                <button type="button" class="modern-qty-btn" id="qty-inc-btn">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            <!-- Buttons -->
                            <button @if($product->getQuantityActive() <= 0) disabled @endif class="btn-book-action btn-book-cart btn-add-cart" type="button">
                                <i class="fa fa-shopping-basket"></i> Thêm vào giỏ
                            </button>
                            <button @if($product->getQuantityActive() <= 0) disabled @endif class="btn-book-action btn-book-buy btn-buy-now" type="button">
                                <i class="fa fa-bolt"></i> Mua ngay
                            </button>
                        </div>
                        
                        <!-- Inline Validation Error Message -->
                        <div id="quantity-error" class="text-danger mt-2 font-weight-bold" style="display: none; font-size: 14px; padding-left: 10px;"></div>
                    </div>
                </div>
            </div>

            <!-- Tabs: Giới thiệu & Chi tiết sản phẩm -->
            <div class="book-tabs-section">
                <div class="book-tabs-header">
                    <button type="button" class="book-tab-btn active" onclick="switchTab('desc-tab-pane', this)">Mô tả nội dung</button>
                    <button type="button" class="book-tab-btn" onclick="switchTab('spec-tab-pane', this)">Thông số chi tiết</button>
                </div>
                <div class="book-tab-content">
                    <!-- Tab Pane 1: Mô tả -->
                    <div class="book-tab-pane active" id="desc-tab-pane">
                        <div style="white-space: pre-line;">{{ $product->description }}</div>
                    </div>
                    
                    <!-- Tab Pane 2: Thông số chi tiết -->
                    <div class="book-tab-pane" id="spec-tab-pane">
                        <table class="book-spec-table">
                            <tr>
                                <th>Danh mục sản phẩm</th>
                                <td>{{ $product->Category->name ?? 'Chưa phân loại' }}</td>
                            </tr>
                                @foreach($product->listAttribute as $attr)
                                    @if(!empty($attr->pivot->text_value) && !in_array(mb_strtolower($attr->name), ['tác giả', 'tac gia', 'nhà xuất bản', 'nha xuat ban']))
                                        <tr>
                                            <th>{{ $attr->name }}</th>
                                            <td>{{ $attr->pivot->text_value }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <!-- Section Sản phẩm tương tự -->
            <section class="related-products-section product-area">
                <div class="related-products-title">Sản phẩm tương tự</div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($product->getListProductSameCategory() as $productItem)
                            @include('web.include.item_product', ['product' => $productItem])
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Section Bạn có thể cần thêm (Phase 4) -->
            <section class="related-products-section product-area mt-5 pb-5">
                <div class="related-products-title">Bạn có thể cần thêm</div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($product->getListProductRelatedCategory() as $productItem)
                            @include('web.include.item_product', ['product' => $productItem])
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Hàm thay đổi ảnh chính từ ảnh nhỏ thumb
        function changeMainImage(imgUrl, thumbEl) {
            $('#main-image-link').attr('href', imgUrl);
            $('#main-image-img').attr('src', imgUrl);
            $('.book-thumb-item').removeClass('active');
            $(thumbEl).addClass('active');
        }

        // Hàm chuyển đổi Tab
        function switchTab(paneId, btnEl) {
            $('.book-tab-pane').removeClass('active');
            $('.book-tab-btn').removeClass('active');
            $('#' + paneId).addClass('active');
            $(btnEl).addClass('active');
        }

        $(document).ready(function () {
            // Hàm định dạng tiền tệ VND dùng trong JS
            function formatVnd(num) {
                return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 'đ';
            }

            // Cập nhật trạng thái và thanh tiến trình tồn kho
            function updateStockDisplay(activeStock) {
                const stockDisplay = $('#product-stock-display');
                const progressFill = $('#stock-progress-fill-bar');
                
                if (activeStock <= 0) {
                    stockDisplay.html('<span class="text-danger font-weight-bold"><i class="fa fa-times-circle"></i> Hết hàng</span>');
                    progressFill.removeClass('stock-fill-green stock-fill-orange').addClass('stock-fill-red').css('width', '0%');
                } else if (activeStock <= 5) {
                    stockDisplay.html('<span class="text-warning font-weight-bold"><i class="fa fa-exclamation-triangle"></i> Còn ' + activeStock + ' sản phẩm (Sắp hết hàng)</span>');
                    progressFill.removeClass('stock-fill-green stock-fill-red').addClass('stock-fill-orange').css('width', '25%');
                } else {
                    stockDisplay.html('<span class="text-success font-weight-bold"><i class="fa fa-check-circle"></i> Còn ' + activeStock + ' sản phẩm (Sẵn sàng giao)</span>');
                    progressFill.removeClass('stock-fill-orange stock-fill-red').addClass('stock-fill-green').css('width', '100%');
                }
            }

            // Hàm validate số lượng nhập thời gian thực
            function validateQuantityRealtime() {
                let productId = @json($product->id);
                let isVariant = $('#product-child-select').val() !== undefined;

                if (isVariant) {
                    productId = $('#product-child-select').val();
                }

                const quantity = parseFloat($('#quantity').val());

                let activeStock = 0;
                if (isVariant) {
                    activeStock = parseFloat($('#product-child-select').find('option:selected').attr('data-quantity'));
                } else {
                    activeStock = @json($product->getQuantityActive());
                }

                updateStockDisplay(activeStock);

                let errorMsg = '';

                if (isNaN(quantity) || quantity < 1) {
                    errorMsg = 'Số lượng không hợp lệ';
                } else if (quantity > activeStock) {
                    errorMsg = 'Số lượng sản phẩm trong kho không đủ';
                }

                if (errorMsg !== '') {
                    $('#quantity-error').text(errorMsg).show();
                    $('.btn-add-cart').prop('disabled', true);
                    $('.btn-buy-now').prop('disabled', true);
                    return false;
                } else {
                    $('#quantity-error').hide().text('');
                    if (activeStock > 0) {
                        $('.btn-add-cart').prop('disabled', false);
                        $('.btn-buy-now').prop('disabled', false);
                    } else {
                        $('.btn-add-cart').prop('disabled', true);
                        $('.btn-buy-now').prop('disabled', true);
                    }
                    return true;
                }
            }

            // Gắn hành động cho nút cộng trừ số lượng modern
            $('#qty-dec-btn').click(function () {
                let currentQty = parseFloat($('#quantity').val());
                if (!isNaN(currentQty) && currentQty > 1) {
                    $('#quantity').val(currentQty - 1).trigger('change');
                }
            });

            $('#qty-inc-btn').click(function () {
                let currentQty = parseFloat($('#quantity').val());
                if (!isNaN(currentQty)) {
                    $('#quantity').val(currentQty + 1).trigger('change');
                }
            });

            // Lắng nghe thay đổi trực tiếp trên input số lượng
            $('#quantity').on('change input keyup', function () {
                validateQuantityRealtime();
            });

            // Xử lý sự kiện chuyển đổi phiên bản (variants)
            $('#product-child-select').change(function () {
                const price = $(this).find('option:selected').attr('data-price');
                const value = $(this).val();

                $('#product-price').text(price);
                
                // Đồng bộ ảnh chính nếu variant có ảnh riêng
                let matchedThumb = $(`.book-thumb-item[data-id='${value}']`);
                if (matchedThumb.length > 0) {
                    matchedThumb.click();
                }

                validateQuantityRealtime();
            });

            // Trigger ban đầu
            $('#product-child-select').trigger('change');
            validateQuantityRealtime();

            // Xử lý Thêm vào giỏ hàng qua AJAX
            $('.btn-add-cart').click(function (){
                if (!validateQuantityRealtime()) {
                    return;
                }

                let productId = @json($product->id);
                if($('#product-child-select').val() !== undefined) {
                    productId = $('#product-child-select').val();
                }

                $.LoadingOverlay('show');

                $.ajax({
                    data: {
                        product_id: productId,
                        quantity: $('#quantity').val(),
                    },
                    method: 'get',
                    url: @json(route('web.cart.add')),
                    success: function(data){
                        $.LoadingOverlay('hide');

                        if (data.hasOwnProperty('success') && data.success) {
                            $('.cart-item-count').text(data.data.qty);
                            Swal.fire({
                                icon: 'success',
                                title: 'Thêm thành công!',
                                text: 'Sản phẩm đã được thêm vào giỏ hàng của bạn.',
                                showConfirmButton: true,
                                confirmButtonText: 'Xem giỏ hàng',
                                showCancelButton: true,
                                cancelButtonText: 'Tiếp tục mua sắm'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = @json(route('web.list.product.cart'));
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Không thể thêm sản phẩm',
                                text: data.data.message ?? data.message ?? 'Đã có lỗi xảy ra.'
                            });
                        }
                    },
                    error: function() {
                        $.LoadingOverlay('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi hệ thống',
                            text: 'Không thể kết nối đến máy chủ.'
                        });
                    }
                });
            });

            // Xử lý Mua ngay (Phase 2 Guest Checkout)
            $('.btn-buy-now').click(function () {
                if (!validateQuantityRealtime()) {
                    return;
                }

                let productId = @json($product->id);
                if($('#product-child-select').val() !== undefined) {
                    productId = $('#product-child-select').val();
                }

                const quantity = parseFloat($('#quantity').val());

                window.location.href = @json(route('web.checkout.order')) + `?list_product[${productId}][id]=${productId}&list_product[${productId}][quantity]=${quantity}`;
            });
        });
    </script>
@endsection
