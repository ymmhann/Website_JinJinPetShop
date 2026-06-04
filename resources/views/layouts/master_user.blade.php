<!doctype html>
<html class="no-js" lang="zxx">

<!-- index-231:32-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @hasSection('title')
        <title>@yield('title') - {{ env('APP_NAME') }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/user/images/favicon.png') }}">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/material-design-iconic-font.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/font-awesome.min.css') }}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{ asset('theme/user/css/fontawesome-stars.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/meanmenu.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/owl.carousel.min.css') }}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/slick.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/animate.css') }}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/jquery-ui.min.css') }}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/venobox.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/nice-select.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/magnific-popup.css') }}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/bootstrap.min.css') }}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/helper.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('theme/user/css/responsive.css') }}">
    <!-- Modernizr js -->
    <script src="{{ asset('theme/user/js/vendor/modernizr-2.8.3.min.js') }}"></script>

{{--    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/all.css') }}">--}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">

    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
        
        /* Khắc phục triệt để lỗi lag của dropdown tài khoản và các dropdown mini do xung đột transition CSS với slideToggle của jQuery */
        .ht-setting, .ht-currency, .ht-language, .setting, .currency, .language, .minicart {
            transition: none !important;
            -webkit-transition: none !important;
        }
        
        /* Cải tiến dropdown tài khoản sang trọng hơn */
        .setting {
            border-top: 3px solid #fedc19 !important;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
            padding: 10px 0 !important;
            min-width: 180px !important;
        }
        .ht-setting-list > li {
            background: transparent !important;
            padding: 0 !important;
        }
        .ht-setting-list > li > a {
            font-size: 13px !important;
            padding: 10px 20px !important;
            color: #495057 !important;
            margin-bottom: 0 !important;
            display: block !important;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .ht-setting-list > li:hover > a {
            background-color: #f8f9fa !important;
            color: #fedc19 !important;
        }

        /* Định dạng dropdown danh mục sản phẩm trên Menu điều hướng */
        .dropdown-holder {
            position: relative;
        }
        .hb-dropdown {
            position: absolute;
            background: #fff;
            min-width: 240px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-radius: 0 0 12px 12px;
            top: 100%;
            left: 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 999;
            padding: 12px 0;
            margin: 0;
            list-style: none;
            border-top: 3px solid #fedc19;
            text-align: left;
        }
        .dropdown-holder:hover .hb-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .hb-dropdown li {
            padding: 0 !important;
            display: block !important;
        }
        .hb-dropdown li a {
            padding: 10px 24px !important;
            display: block !important;
            color: #495057 !important;
            font-size: 14px !important;
            text-transform: none !important;
            font-weight: 500 !important;
            line-height: 1.5 !important;
            transition: all 0.2s ease;
        }
        .hb-dropdown li a::after {
            content: none !important;
        }
        .hb-dropdown li a:hover {
            background: #f8f9fa !important;
            color: #fedc19 !important;
            padding-left: 28px !important;
        }

        /* --- SỬA LỖI BADGE GIỎ HÀNG (PHASE 6) --- */
        .hm-minicart-trigger {
            position: relative !important;
        }
        .cart-item-count {
            position: absolute !important;
            top: -3px !important;
            left: 28px !important;
            background: #e80f0f !important;
            color: #fff !important;
            font-weight: bold !important;
            border: 2px solid #fff !important;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2) !important;
            width: 20px !important;
            height: 20px !important;
            line-height: 16px !important;
            text-align: center !important;
            border-radius: 50% !important;
            font-size: 10px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            z-index: 10 !important;
        }

        /* --- ĐỒNG BỘ MÀU SẮC THƯƠNG HIỆU JINJIN USER (PHASE 6) --- */
        /* Nút bấm & Action */
        .li-btn, .hm-searchbox button, button.li-btn, .coupon2 input.button, .cart-page-total a, .dec-btn, .submit-btn, .btn-primary, .btn-warning, .cart-quantity .add-to-cart {
            background: #2c3e50 !important;
            border-color: #2c3e50 !important;
            color: #fff !important;
            transition: all 0.3s ease !important;
        }
        .li-btn:hover, .hm-searchbox button:hover, button.li-btn:hover, .coupon2 input.button:hover, .cart-page-total a:hover, .dec-btn:hover, .submit-btn:hover, .btn-primary:hover, .btn-warning:hover, .cart-quantity .add-to-cart:hover {
            background: #fedc19 !important;
            border-color: #fedc19 !important;
            color: #2c3e50 !important;
        }
        
        /* Link hover & accents */
        a:hover, .des a:hover, .footer-block ul li a:hover, .li-product-title a:hover {
            color: #fedc19 !important;
        }
        
        /* Pagination active */
        .li-pagination-box .pagination .active a, .li-pagination-box .pagination li a:hover {
            background: #2c3e50 !important;
            border-color: #2c3e50 !important;
            color: #fff !important;
        }

        /* Price text */
        .special-price, .product-price, .price-box .new-price, .price-box .new-price-2 {
            color: #d93838 !important;
        }

        /* Product cards & lists */
        .add-actions-link li.add-cart a {
            background: #2c3e50 !important;
            color: #fff !important;
            border: none !important;
        }
        .add-actions-link li.add-cart a:hover {
            background: #fedc19 !important;
            color: #2c3e50 !important;
        }
        .add-actions-link li a:hover {
            color: #fedc19 !important;
            border-color: #fedc19 !important;
        }

        /* Badge giảm giá */
        .li-product-menu li a.active::after, .li-trending-product-menu li a.active::after {
            background: #2c3e50 !important;
        }

        /* --- THIẾT KẾ FOOTER TỐI (DARK MODE NAVY & YELLOW) (PHASE 7) --- */
        .footer {
            background: #2c3e50 !important;
            color: #ffffff !important;
        }
        .footer-static-top {
            background: #1a252f !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .footer-static-middle {
            background: #2c3e50 !important;
        }
        .footer-static-bottom {
            background: #1a252f !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .footer-block-title, .footer-logo-wrap h4 {
            color: #fedc19 !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            font-size: 15px !important;
            margin-bottom: 20px !important;
        }
        .footer ul li a, .des li, .des li a, .des li span {
            color: #e0e0e0 !important;
            transition: all 0.3s ease;
        }
        .footer ul li a:hover, .des li a:hover {
            color: #fedc19 !important;
            padding-left: 5px !important;
            text-decoration: none !important;
        }
        .li-shipping-inner-box .shipping-text h2 {
            color: #fedc19 !important;
        }
        .li-shipping-inner-box .shipping-text p {
            color: #e0e0e0 !important;
        }
        .copyright {
            color: #ffffff !important;
        }
        .copyright strong span {
            color: #fedc19 !important;
        }
        
        /* Ẩn mũi tên dư CSS ở menu chính để chỉ giữ mũi tên thẻ i thủ công */
        .hb-menu nav > ul > li > a::after {
            content: none !important;
        }
        
        /* Nút Messenger lơ lửng (Phase 1) */
        .floating-messenger {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #006AFF, #00E4FF);
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 106, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .floating-messenger:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 106, 255, 0.6);
        }
        .floating-messenger::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(0, 106, 255, 0.3);
            z-index: -1;
            animation: messenger-ping 2s infinite;
        }
        @keyframes messenger-ping {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.4);
                opacity: 0;
            }
        }
    </style>

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
    <header>
        <!-- Begin Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Top Left Area -->
                    <div class="col-lg-6 col-md-6">
                        <div class="header-top-left" style="padding: 10px 0;">
                            <span style="margin-right: 15px; font-weight: 500; font-size: 13px;"><i class="fa fa-phone" style="color: #fedc19; margin-right: 6px;"></i>Hotline: <strong>0584 246 834</strong></span>
                            <span style="font-weight: 500; font-size: 13px;"><i class="fa fa-envelope-o" style="color: #fedc19; margin-right: 6px;"></i>Email: <strong>support@jinjin.vn</strong></span>
                        </div>
                    </div>
                    <!-- Header Top Left Area End Here -->
                    <!-- Begin Header Top Right Area -->
                    <div class="col-lg-6 col-md-6">
                        <div class="header-top-right">
                            <ul class="ht-menu">
                                <!-- Begin Setting Area -->
                                <li>
                                    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                                        <div class="ht-setting-trigger" style="font-weight: 600; color: #2c3e50;"><i class="fa fa-user-circle-o" style="font-size: 14px; margin-right: 5px;"></i><span>{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="{{ route('web.profile') }}"><i class="fa fa-cog" style="margin-right: 8px;"></i>Tài khoản</a></li>
                                                <li><a href="{{ route('web.list_order_of_user') }}"><i class="fa fa-list-alt" style="margin-right: 8px;"></i>Đơn đặt hàng</a></li>
                                                <li><a href="{{ route('web.logout') }}" style="color: #d93838;"><i class="fa fa-sign-out" style="margin-right: 8px;"></i>Đăng xuất</a></li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="ht-setting-trigger" style="font-weight: 600;"><i class="fa fa-user-o" style="font-size: 14px; margin-right: 5px;"></i><span>Tài khoản</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="{{ route('web.register') }}"><i class="fa fa-user-plus" style="margin-right: 8px;"></i>Đăng ký</a></li>
                                                <li><a href="{{ route('web.login') }}"><i class="fa fa-sign-in" style="margin-right: 8px;"></i>Đăng nhập</a></li>
                                            </ul>
                                        </div>
                                    @endif

                                </li>
                                <!-- Setting Area End Here -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Top Area End Here -->
        <!-- Begin Header Middle Area -->
        <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30" style="padding-top: 5px;">
                            <a href="{{ route('web.index') }}" style="font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 800; text-decoration: none; letter-spacing: 0.5px;">
                                <span style="color: #fedc19;">Jin</span><span style="color: #2c3e50;">Jin</span>
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form action="{{ route('web.search') }}" class="hm-searchbox">
                            <input type="text" placeholder="Tìm kiếm thức ăn, phụ kiện thú cưng..." name="search" value="{{ request()->get('search') ?? '' }}">
                            <button class="li-btn"><i class="fa fa-search"></i></button>
                        </form>
                        <!-- Header Middle Searchbox Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="header-middle-right">
                            <ul class="hm-menu" id="cart-icon">
                                <!-- Begin Header Mini Cart Area -->
                                <li class="hm-minicart">
                                    <a href="{{ route('web.list.product.cart') }}" class="hm-minicart-trigger" style="background: #2c3e50; border-radius: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: relative !important; display: block; text-decoration: none;">
                                        <span class="item-icon" style="color: #fedc19;"></span>
                                        <span class="item-text" style="font-weight: 600; color: #fff;">Giỏ hàng</span>
                                        <span class="cart-item-count" style="background: #e80f0f; color: #fff; top: -3px; left: 28px; font-weight: bold; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2); position: absolute !important; width: 20px; height: 20px; line-height: 16px; border-radius: 50%; font-size: 10px; display: flex; align-items: center; justify-content: center; padding: 0;">
                                            @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                                                {{ \Illuminate\Support\Facades\Auth::guard('web')->user()->countListProductInCart() }}
                                            @else
                                                {{ collect(session('cart', []))->sum() }}
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <!-- Header Mini Cart Area End Here -->
                            </ul>
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom header-sticky d-none d-lg-block" style="background: #2c3e50; border-bottom: 3px solid #fedc19; margin-bottom: 20px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu hb-menu-2 d-xl-block">
                            <nav>
                                <ul class="d-flex align-items-center">
                                    <li><a href="{{ route('web.index') }}" style="color: #fff;">Trang chủ</a></li>
                                    <li class="dropdown-holder">
                                        <a style="color: #fff; cursor: pointer;">Danh mục <i class="fa fa-angle-down" style="margin-left: 5px; font-size: 14px;"></i></a>
                                        <ul class="hb-dropdown">
                                            @if(!empty($listCategory))
                                                @foreach($listCategory as $cat)
                                                    <li><a href="{{ route('web.detail.category', $cat->id) }}">{{ $cat->name }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('web.about') }}" style="color: #fff;">Giới thiệu</a></li>
                                    <li><a href="{{ route('web.pet_calculator') }}" style="color: #fff;">Tính lượng thức ăn</a></li>
                                    <li><a href="{{ route('web.contact') }}" style="color: #fff;">Liên hệ</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area d-lg-none d-xl-none col-12">
            <div class="container">
                <div class="row">
                    <div class="mobile-menu">
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->

    <div class="mb-5">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Begin Footer Area -->
    <div class="footer">
        <!-- Begin Footer Static Top Area -->
        <div class="footer-static-top">
            <div class="container">
                <!-- Begin Footer Shipping Area -->
                <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                    <div class="row">
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/1.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Giao Hàng Miễn Phí</h2>
                                    <p>Giao hàng miễn phí toàn quốc cho đơn hàng từ 250k. Đổi trả dễ dàng.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/2.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Thanh Toán An Toàn</h2>
                                    <p>Hỗ trợ thanh toán bảo mật 100% qua thẻ ngân hàng, ví MoMo, COD.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/3.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Sản Phẩm Chính Hãng</h2>
                                    <p>Cam kết sản phẩm chất lượng, chính hãng 100% cho sức khỏe thú cưng.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{ asset('theme/user/images/shipping-icon/4.png') }}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Tư Vấn Tận Tâm 24/7</h2>
                                    <p>Luôn sẵn sàng giải đáp thắc mắc của quý khách về sản phẩm và đơn hàng.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                    </div>
                </div>
                <!-- Footer Shipping Area End Here -->
            </div>
        </div>
        <!-- Footer Static Top Area End Here -->
        <!-- Begin Footer Static Middle Area -->
        <div class="footer-static-middle">
            <div class="container">
                <div class="footer-logo-wrap pt-50 pb-35">
                    <div class="row">
                        <!-- Begin Footer Logo Area -->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-logo" style="margin-bottom: 20px;">
                                <a href="{{ route('web.index') }}" style="font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 800; text-decoration: none; letter-spacing: 0.5px;">
                                    <span style="color: #fedc19;">Jin</span><span style="color: #fff;">Jin</span>
                                </a>
                            </div>
                            <p style="color: #e0e0e0; font-size: 13px; line-height: 1.6; margin-bottom: 20px;">
                                JinJin - Hệ thống cửa hàng thức ăn thú cưng uy tín hàng đầu Việt Nam. Chúng tôi cam kết cung cấp sản phẩm chính hãng, chất lượng cao và đem lại trải nghiệm chăm sóc thú cưng tốt nhất cho khách hàng.
                            </p>
                            <ul class="des">
                                <li>
                                    <span>Địa chỉ: </span>
                                    Số 4 Lô D8 Khu đô thị Geleximco, Đường Lê Trọng Tấn, Hà Đông, Hà Nội
                                </li>
                                <li>
                                    <span>Số điện thoại: </span>
                                    <a href="tel:+84584246834">(+84) 584 246 834</a>
                                </li>
                                <li>
                                    <span>Email: </span>
                                    <a href="mailto:support@jinjin.vn">support@jinjin.vn</a>
                                </li>
                                <li>
                                    <span>Facebook: </span>
                                    <a href="https://www.facebook.com/jinjinpetshop.vn" target="_blank">jinjinpetshop.vn</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Logo Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h4 class="footer-block-title">Danh mục nổi bật</h4>
                                <ul>
                                    @if(!empty($listCategory))
                                        @foreach($listCategory->take(5) as $cat)
                                            <li><a href="{{ route('web.detail.category', $cat->id) }}">{{ $cat->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h4 class="footer-block-title">Hỗ trợ khách hàng</h4>
                                <ul>
                                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                                    <li><a href="{{ route('web.about') }}">Giới thiệu</a></li>
                                    <li><a href="{{ route('web.contact') }}">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-block">
                                <h4 class="footer-block-title">Tài khoản của bạn</h4>
                                <ul>
                                    <li><a href="{{ route('web.profile') }}">Thông tin tài khoản</a></li>
                                    <li><a href="{{ route('web.list_order_of_user') }}">Đơn đặt hàng</a></li>
                                    <li><a href="{{ route('web.list.product.cart') }}">Giỏ hàng của bạn</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Middle Area End Here -->
        <!-- Begin Footer Static Bottom Area -->
        <div class="footer-static-bottom pt-55 pb-55">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Copyright Area -->
                        <div class="copyright text-center pt-25">
                            &copy; Copyright <strong><span>JinJin Pet Food</span></strong>. All Rights Reserved
                        </div>
                        <!-- Copyright Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Bottom Area End Here -->
    </div>
    <!-- Footer Area End Here -->
</div>
<!-- Body Wrapper End Here -->

<!-- Floating Messenger Button (Phase 1) -->
<a href="https://www.facebook.com/messages/t/419320931442384" target="_blank" class="floating-messenger" title="Trò chuyện với JinJin Pet Food">
    <svg width="30" height="30" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14 2C7.373 2 2 6.944 2 13.04c0 3.197 1.467 6.046 3.847 7.973V25.5l4.316-2.368c1.218.337 2.502.518 3.837.518 6.627 0 12-4.944 12-11.04C26 6.944 20.627 2 14 2zm1.26 14.838l-3.06-3.266-5.966 3.266 6.55-6.953 3.11 3.266 5.916-3.266-6.55 6.953z" fill="white"/>
    </svg>
</a>
<!-- jQuery-V1.12.4 -->
<script src="{{ asset('theme/user/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('theme/user/js/vendor/popper.min.js') }}"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="{{ asset('theme/user/js/bootstrap.min.js') }}"></script>
<!-- Ajax Mail js -->
<script src="{{ asset('theme/user/js/ajax-mail.js') }}"></script>
<!-- Meanmenu js -->
<script src="{{ asset('theme/user/js/jquery.meanmenu.min.js') }}"></script>
<!-- Wow.min js -->
<script src="{{ asset('theme/user/js/wow.min.js') }}"></script>
<!-- Slick Carousel js -->
<script src="{{ asset('theme/user/js/slick.min.js') }}"></script>
<!-- Owl Carousel-2 js -->
<script src="{{ asset('theme/user/js/owl.carousel.min.js') }}"></script>
<!-- Magnific popup js -->
<script src="{{ asset('theme/user/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Isotope js -->
<script src="{{ asset('theme/user/js/isotope.pkgd.min.js') }}"></script>
<!-- Imagesloaded js -->
<script src="{{ asset('theme/user/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- Mixitup js -->
<script src="{{ asset('theme/user/js/jquery.mixitup.min.js') }}"></script>
<!-- Countdown -->
<script src="{{ asset('theme/user/js/jquery.countdown.min.js') }}"></script>
<!-- Counterup -->
<script src="{{ asset('theme/user/js/jquery.counterup.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('theme/user/js/waypoints.min.js') }}"></script>
<!-- Barrating -->
<script src="{{ asset('theme/user/js/jquery.barrating.min.js') }}"></script>
<!-- Jquery-ui -->
<script src="{{ asset('theme/user/js/jquery-ui.min.js') }}"></script>
<!-- Venobox -->
<script src="{{ asset('theme/user/js/venobox.min.js') }}"></script>
<!-- Nice Select js -->
<script src="{{ asset('theme/user/js/jquery.nice-select.min.js') }}"></script>
<!-- ScrollUp js -->
<script src="{{ asset('theme/user/js/scrollUp.min.js') }}"></script>
<!-- Main/Activator js -->
<script src="{{ asset('theme/user/js/main.js') }}"></script>
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('lib/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#cart-icon').click(function () {
            window.location.replace(@json(route('web.list.product.cart')));
        });
    });

    function formatVnd(num) {
        return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 'đ';
    }
</script>

@yield('js')
@yield('js_attr_search')
</body>

<!-- index-231:38-->
</html>
