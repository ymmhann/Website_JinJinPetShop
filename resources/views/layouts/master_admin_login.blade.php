<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Đăng nhập Admin - JinJin Pet Food</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('theme/admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('theme/admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('theme/admin/assets/font/font.css') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('theme/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('theme/admin/assets/css/style.css') }}" rel="stylesheet">

    <style>
        /* Đồng bộ màu sắc Admin với thương hiệu JinJin (Navy & Yellow) */
        :root {
            --primary-navy: #2c3e50;
            --accent-yellow: #fedc19;
        }
        .btn-primary {
            background-color: var(--primary-navy) !important;
            border-color: var(--primary-navy) !important;
            color: #ffffff !important;
            transition: all 0.3s ease !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--accent-yellow) !important;
            border-color: var(--accent-yellow) !important;
            color: var(--primary-navy) !important;
        }
        .logo span {
            color: var(--primary-navy) !important;
            font-weight: 700 !important;
        }
        a {
            color: var(--primary-navy) !important;
            transition: all 0.3s ease;
        }
        a:hover {
            color: var(--accent-yellow) !important;
        }
        .card {
            border-top: 3px solid var(--accent-yellow) !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
        }
    </style>
</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ route('admin.login') }}" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('theme/admin/assets/img/pet_logo.png') }}" alt="">
                                <span class="d-none d-lg-block">Quản Trị Viên</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">
                                <div class="mt-3">
                                    @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                    @endif
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                </div>
                                @yield('content')
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('theme/admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('theme/admin/assets/js/main.js') }}"></script>

</body>

</html>
