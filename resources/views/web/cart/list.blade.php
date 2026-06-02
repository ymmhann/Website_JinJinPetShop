@extends('layouts.master_user')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="li-product-thumbnail"></th>
                                    <th class="li-product-thumbnail">Hình ảnh</th>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th class="li-product-price">Đơn giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Tổng tiền</th>
                                    <th class="li-product-remove">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listProduct as $product)
                                    <tr>
                                        <td>
                                            <input type="checkbox" checked data-product-id="{{ $product->id }}" class="ckb-product" name="list_product[{{ $product->id }}][id]" value="{{ $product->id }}" form="form-main">
                                        </td>
                                        <td class="li-product-thumbnail"><a href="#"><img src="{{ $product->getImage() }}" width="100px" alt="Li's Product Image"></a></td>
                                        <td class="li-product-name" width="30%"><a href="{{ route('web.detail', $product->id) }}" target="_blank">{{ $product->getName() }}</a></td>
                                        <td class="li-product-price"><span class="amount">{{ formatVnd($product->price) }}</span></td>
                                        <td class="quantity">
                                            <label>Số lượng</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box quantity-product-row" data-product-id="{{ $product->id }}"
                                                       data-price="{{ $product->price }}"
                                                       name="list_product[{{ $product->id }}][quantity]"
                                                       data-quantity-base="{{ $product->pivot->quantity }}"
                                                       form="form-main"
                                                       value="{{ $product->pivot->quantity }}" type="text">
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount" data-total="{{ $product->price * $product->pivot->quantity }}" data-product-id="{{ $product->id }}">{{ formatVnd($product->price * $product->pivot->quantity) }}</span></td>
                                        <td class="li-product-remove remove-product-cart" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-trash" style="cursor: pointer;"></i>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Tổng tiền thanh toán</h2>
                                    <ul>
                                        <li>Tổng <span id="total-cart">0</span></li>
                                    </ul>
                                    <button type="submit" class="btn btn-dark mt-2" form="form-main">Mua ngay</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('web.checkout.order') }}" method="get" id="form-main">
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // Hàm định dạng tiền tệ VND
            function formatVnd(num) {
                return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 'đ';
            }

            // Tính tổng tiền các sản phẩm được tích chọn và cập nhật UI
            function rfTotal() {
                let total = 0;

                $('.ckb-product:checked').each(function () {
                    const productId = $(this).attr('data-product-id');
                    const itemTotal = parseFloat($(`.amount[data-product-id='${productId}']`).attr('data-total'));
                    if (!isNaN(itemTotal)) {
                        total += itemTotal;
                    }
                });

                $('#total-cart').text(formatVnd(total));
            }

            // Gọi tính tổng tiền ngay khi tải trang
            rfTotal();

            // Lắng nghe sự kiện tích chọn sản phẩm
            $('.ckb-product').change(function () {
                rfTotal();
            });

            // Kiểm tra trước khi submit form thanh toán
            $('#form-main').submit(function (event) {
                if ($('.ckb-product:checked').length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi...',
                        text: 'Bạn chưa chọn sản phẩm để thanh toán'
                    });
                    event.preventDefault();
                }
            });

            // Xử lý xóa sản phẩm khỏi giỏ hàng qua AJAX
            $('.remove-product-cart').click(function () {
                const thisElement = $(this);
                let productId = thisElement.attr('data-product-id');
                
                Swal.fire({
                    title: 'Xác nhận xóa?',
                    text: "Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.LoadingOverlay('show');
                        $.ajax({
                            url: @json(route('web.delete.product.cart')),
                            method: 'get',
                            data: {
                                product_id: productId
                            },
                            success: function (data){
                                $.LoadingOverlay('hide');

                                if (data.hasOwnProperty('success') && data.success) {
                                    $('.cart-item-count').text(data.data.qty);
                                    thisElement.parents('tr').fadeOut(400, function() {
                                        $(this).remove();
                                        rfTotal();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi...',
                                        text: data.data.message ?? 'Không thể xóa sản phẩm.'
                                    });
                                }
                            },
                            error: function() {
                                $.LoadingOverlay('hide');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi...',
                                    text: 'Không thể kết nối tới hệ thống.'
                                });
                            }
                        });
                    }
                });
            });

            // Hàm xử lý cập nhật số lượng thông qua AJAX (Debounced + Instant Client UI Update)
            function updateCartQuantity(inputElement) {
                const productId = inputElement.attr('data-product-id');
                const productPrice = parseFloat(inputElement.attr('data-price'));
                let quantityNew = parseInt(inputElement.val());
                const quantityBase = parseInt(inputElement.attr('data-quantity-base'));

                // Kiểm tra tính hợp lệ của số lượng nhập vào
                if (isNaN(quantityNew) || quantityNew < 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Số lượng không hợp lệ',
                        text: 'Số lượng tối thiểu là 1.'
                    });
                    inputElement.val(quantityBase);
                    return;
                }

                // Kiểm tra xem số lượng có thực sự thay đổi so với lần gửi AJAX trước đó không
                const lastVal = inputElement.data('last-val') !== undefined ? parseInt(inputElement.data('last-val')) : quantityBase;
                if (quantityNew === lastVal) {
                    return;
                }
                inputElement.data('last-val', quantityNew);

                // 1. CẬP NHẬT GIAO DIỆN CLIENT-SIDE NGAY LẬP TỨC (Instant Feedback)
                const tempSubtotal = productPrice * quantityNew;
                $(`.amount[data-product-id='${productId}']`).text(formatVnd(tempSubtotal));
                $(`.amount[data-product-id='${productId}']`).attr('data-total', tempSubtotal);
                rfTotal();

                // 2. GỬI AJAX DEBOUNCED LÊN SERVER
                clearTimeout(inputElement.data('timeout'));
                
                // Hiển thị hiệu ứng mờ dòng sản phẩm để biểu thị đang đồng bộ
                const parentRow = inputElement.closest('tr');
                parentRow.css('opacity', '0.6');

                const timeout = setTimeout(function () {
                    $.ajax({
                        data: {
                            product_id: productId,
                            quantity_new: quantityNew,
                        },
                        method: 'get',
                        url: @json(route('web.cart.add')),
                        success: function (data){
                            parentRow.css('opacity', '1');

                            if (data.hasOwnProperty('success') && data.success) {
                                // Cập nhật số lượng giỏ hàng trên header
                                $('.cart-item-count').text(data.data.qty);

                                // Đồng bộ lại giá trị chính xác từ server phản hồi
                                $(`.amount[data-product-id='${productId}']`).text(formatVnd(data.data.total_row));
                                $(`.amount[data-product-id='${productId}']`).attr('data-total', data.data.total_row);
                                inputElement.attr('data-quantity-base', quantityNew);
                                rfTotal();
                            } else {
                                // Lỗi hết hàng hoặc server chặn
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi cập nhật',
                                    text: data.data.message ?? 'Số lượng trong kho không đủ.'
                                });
                                // Khôi phục về giá trị cũ trước khi thay đổi
                                inputElement.val(quantityBase);
                                inputElement.data('last-val', quantityBase);
                                const restoreSubtotal = productPrice * quantityBase;
                                $(`.amount[data-product-id='${productId}']`).text(formatVnd(restoreSubtotal));
                                $(`.amount[data-product-id='${productId}']`).attr('data-total', restoreSubtotal);
                                rfTotal();
                            }
                        },
                        error: function() {
                            parentRow.css('opacity', '1');
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi kết nối',
                                text: 'Có lỗi xảy ra khi đồng bộ với máy chủ.'
                            });
                            // Khôi phục về giá trị cũ
                            inputElement.val(quantityBase);
                            inputElement.data('last-val', quantityBase);
                            const restoreSubtotal = productPrice * quantityBase;
                            $(`.amount[data-product-id='${productId}']`).text(formatVnd(restoreSubtotal));
                            $(`.amount[data-product-id='${productId}']`).attr('data-total', restoreSubtotal);
                            rfTotal();
                        }
                    });
                }, 400); // Trì hoãn 400ms

                inputElement.data('timeout', timeout);
            }

            // Gắn sự kiện lắng nghe thay đổi số lượng
            // Lắng nghe sự kiện change (do bàn phím nhập hoặc do nút tăng giảm của template thay đổi và kích hoạt .change())
            $(document).on('change', '.quantity-product-row', function () {
                updateCartQuantity($(this));
            });

            // Lắng nghe thêm sự kiện input để cập nhật tức thì khi người dùng đang gõ phím
            $(document).on('input', '.quantity-product-row', function () {
                updateCartQuantity($(this));
            });
        });
    </script>
@endsection
