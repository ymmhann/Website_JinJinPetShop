@extends('layouts.master_user')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Tính toán lượng thức ăn</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <div class="pet-calculator-area pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg rounded-20 overflow-hidden" style="border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.08) !important;">
                        <div class="row no-gutters">
                            <!-- Left: Form Input -->
                            <div class="col-md-6 p-5" style="background: #fff;">
                                <h3 class="font-weight-bold mb-4" style="color: #2c3e50; font-family: 'Playfair Display', serif; font-size: 28px;">
                                    Tính Lượng Thức Ăn
                                </h3>
                                <p class="text-muted mb-4" style="font-size: 14px; line-height: 1.6;">
                                    Cung cấp chế độ dinh dưỡng chuẩn khoa học giúp bé cưng phát triển khỏe mạnh và năng động mỗi ngày.
                                </p>

                                <form id="calculator-form">
                                    <!-- Thú cưng: Chó hay Mèo -->
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-uppercase d-block mb-3" style="font-size: 12px; color: #868e96; letter-spacing: 0.5px;">Loại thú cưng</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="pet-type-card text-center p-3 border rounded active" data-type="dog" style="cursor: pointer; border-radius: 12px; transition: all 0.3s ease;">
                                                    <span style="font-size: 32px; display: block; margin-bottom: 5px;">🐶</span>
                                                    <span class="font-weight-bold" style="font-size: 14px;">Chó cưng</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="pet-type-card text-center p-3 border rounded" data-type="cat" style="cursor: pointer; border-radius: 12px; transition: all 0.3s ease;">
                                                    <span style="font-size: 32px; display: block; margin-bottom: 5px;">🐱</span>
                                                    <span class="font-weight-bold" style="font-size: 14px;">Mèo cưng</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cân nặng -->
                                    <div class="form-group mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="font-weight-bold text-uppercase" style="font-size: 12px; color: #868e96; letter-spacing: 0.5px;">Cân nặng</label>
                                            <span class="font-weight-bold text-primary" style="font-size: 16px;"><span id="weight-val">5.0</span> kg</span>
                                        </div>
                                        <input type="range" class="form-control-range custom-slider" id="weight" min="0.5" max="50" step="0.5" value="5.0" style="cursor: pointer;">
                                        <div class="d-flex justify-content-between text-muted mt-1" style="font-size: 11px;">
                                            <span>0.5 kg</span>
                                            <span>50 kg</span>
                                        </div>
                                    </div>

                                    <!-- Độ tuổi -->
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-uppercase d-block mb-3" style="font-size: 12px; color: #868e96; letter-spacing: 0.5px;">Giai đoạn tuổi</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="age-stage-card text-center p-2 border rounded active" data-stage="puppy" style="cursor: pointer; border-radius: 10px; transition: all 0.3s ease; font-size: 12px;">
                                                    <span class="font-weight-bold d-block" id="age-lbl-young">Puppy</span>
                                                    <span class="text-muted" style="font-size: 10px;">Dưới 1 tuổi</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="age-stage-card text-center p-2 border rounded" data-stage="adult" style="cursor: pointer; border-radius: 10px; transition: all 0.3s ease; font-size: 12px;">
                                                    <span class="font-weight-bold d-block">Adult</span>
                                                    <span class="text-muted" style="font-size: 10px;">Từ 1 - 7 tuổi</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="age-stage-card text-center p-2 border rounded" data-stage="senior" style="cursor: pointer; border-radius: 10px; transition: all 0.3s ease; font-size: 12px;">
                                                    <span class="font-weight-bold d-block">Senior</span>
                                                    <span class="text-muted" style="font-size: 10px;">Trên 7 tuổi</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-block btn-lg font-weight-bold" id="btn-calculate" style="background: #2c3e50; color: #fff; border-radius: 30px; height: 50px; font-size: 16px; transition: all 0.3s;">
                                        <i class="fa fa-calculator mr-2"></i> Tính toán ngay
                                    </button>
                                </form>
                            </div>

                            <!-- Right: Result Output -->
                            <div class="col-md-6 p-5 d-flex flex-column justify-content-center text-center" id="result-side" style="background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%); color: #fff;">
                                <!-- State 1: Awaiting Input -->
                                <div id="awaiting-input">
                                    <div style="font-size: 70px; margin-bottom: 20px; animation: float-pet 3s ease-in-out infinite;">🥣</div>
                                    <h4 class="font-weight-bold mb-3" style="color: #fedc19; font-family: 'Playfair Display', serif;">Chế độ dinh dưỡng hoàn hảo</h4>
                                    <p class="px-3" style="font-size: 13px; color: #b2bec3; line-height: 1.6;">
                                        Chọn các thông số bên trái và nhấn nút tính toán để xem lượng thức ăn khuyến nghị tối ưu nhất cho bé cưng của bạn.
                                    </p>
                                </div>

                                <!-- State 2: Loading Animation -->
                                <div id="loading-results" style="display: none;">
                                    <div class="spinner-border text-warning" role="status" style="width: 4rem; height: 4rem; border-width: 5px;"></div>
                                    <h5 class="mt-4 font-weight-bold" style="color: #fedc19;">Đang phân tích chỉ số dinh dưỡng...</h5>
                                    <p class="text-muted" style="color: #b2bec3 !important;">Quy trình tính toán theo tiêu chuẩn quốc tế</p>
                                </div>

                                <!-- State 3: Result Display -->
                                <div id="results-display" style="display: none; text-align: left;">
                                    <h4 class="font-weight-bold text-center mb-4" style="color: #fedc19; font-family: 'Playfair Display', serif; font-size: 24px;">Kết quả gợi ý</h4>
                                    
                                    <!-- Lượng thức ăn -->
                                    <div class="result-box p-3 mb-3 rounded" style="background: rgba(255, 255, 255, 0.05); border-left: 4px solid #fedc19;">
                                        <div class="text-uppercase" style="font-size: 11px; color: #bdc5cd; font-weight: bold; letter-spacing: 0.5px;">Khẩu phần thức ăn (Hạt khô)</div>
                                        <div class="d-flex align-items-baseline mt-1">
                                            <span class="font-weight-bold text-warning" style="font-size: 32px;" id="res-food-amount">150 - 200</span>
                                            <span class="ml-2 font-weight-bold" style="font-size: 18px;">gam / ngày</span>
                                        </div>
                                        <div style="font-size: 12px; color: #a4b0be; margin-top: 5px;" id="res-cup-equivalent">
                                            Tương đương khoảng 1.5 cốc thức ăn tiêu chuẩn
                                        </div>
                                    </div>

                                    <!-- Số bữa ăn -->
                                    <div class="result-box p-3 mb-4 rounded" style="background: rgba(255, 255, 255, 0.05); border-left: 4px solid #fedc19;">
                                        <div class="text-uppercase" style="font-size: 11px; color: #bdc5cd; font-weight: bold; letter-spacing: 0.5px;">Tần suất ăn hợp lý</div>
                                        <div class="d-flex align-items-baseline mt-1">
                                            <span class="font-weight-bold text-warning" style="font-size: 32px;" id="res-meals-count">3</span>
                                            <span class="ml-2 font-weight-bold" style="font-size: 18px;">bữa / ngày</span>
                                        </div>
                                    </div>

                                    <!-- Lời khuyên chuyên gia -->
                                    <div class="mb-4">
                                        <h6 class="font-weight-bold" style="color: #fedc19; font-size: 13px;"><i class="fa fa-info-circle mr-1"></i> Lưu ý dinh dưỡng:</h6>
                                        <p id="res-advice" style="font-size: 12px; color: #dfe6e9; line-height: 1.6; margin-bottom: 0;"></p>
                                    </div>

                                    <!-- CTA button -->
                                    <a href="{{ route('web.search') }}?search=chó" id="btn-buy-matching" class="btn btn-warning btn-block font-weight-bold mt-2" style="border-radius: 30px; height: 45px; display: flex; align-items: center; justify-content: center; color: #2c3e50; transition: all 0.3s;">
                                        <span>Mua thức ăn cho Chó cưng tại JinJin</span> <i class="fa fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Style internal -->
    <style>
        .rounded-20 {
            border-radius: 20px !important;
        }
        .pet-type-card.active, .age-stage-card.active {
            border-color: #2c3e50 !important;
            background-color: rgba(44, 62, 80, 0.05) !important;
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.1) !important;
        }
        .pet-type-card:hover, .age-stage-card:hover {
            border-color: #2c3e50 !important;
            background-color: rgba(44, 62, 80, 0.02);
        }
        /* Style range input */
        .custom-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 5px;
            background: #e9ecef;
            outline: none;
            transition: background 0.2s;
        }
        .custom-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: background 0.2s, transform 0.2s;
        }
        .custom-slider::-webkit-slider-thumb:hover {
            background: #fedc19;
            transform: scale(1.1);
        }
        #btn-calculate:hover {
            background: #fedc19 !important;
            color: #2c3e50 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(254, 220, 25, 0.3) !important;
        }
        @keyframes float-pet {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            let selectedType = 'dog';
            let selectedStage = 'puppy';

            // Sự kiện chọn loại thú cưng
            $('.pet-type-card').click(function () {
                $('.pet-type-card').removeClass('active');
                $(this).addClass('active');
                selectedType = $(this).attr('data-type');

                // Thay đổi nhãn độ tuổi
                if (selectedType === 'dog') {
                    $('#age-lbl-young').text('Puppy');
                    // Cập nhật lại cân nặng mặc định
                    if ($('#weight').val() < 1) {
                        $('#weight').val(5.0).trigger('input');
                    }
                } else {
                    $('#age-lbl-young').text('Kitten');
                    // Mèo cân nặng thường nhỏ, chỉnh slide về 3.0 nếu quá lớn
                    if ($('#weight').val() > 15) {
                        $('#weight').val(3.0).trigger('input');
                    }
                }
            });

            // Sự kiện chọn độ tuổi
            $('.age-stage-card').click(function () {
                $('.age-stage-card').removeClass('active');
                $(this).addClass('active');
                selectedStage = $(this).attr('data-stage');
            });

            // Cập nhật giá trị cân nặng thời gian thực khi trượt
            $('#weight').on('input', function () {
                $('#weight-val').text(parseFloat($(this).val()).toFixed(1));
            });

            // Nút Tính toán
            $('#btn-calculate').click(function () {
                const weight = parseFloat($('#weight').val());
                
                // 1. Chạy hiệu ứng Loading
                $('#awaiting-input').hide();
                $('#results-display').hide();
                $('#loading-results').show();

                setTimeout(function () {
                    $('#loading-results').hide();
                    
                    // 2. Chạy thuật toán gợi ý lượng ăn & số bữa
                    let foodAmount = "";
                    let mealsCount = 2;
                    let advice = "";
                    let cupEquivalent = "";

                    if (selectedType === 'dog') {
                        // CHÓ
                        if (selectedStage === 'puppy') {
                            mealsCount = 3;
                            if (weight < 5) {
                                foodAmount = "60g - 140g";
                            } else if (weight <= 10) {
                                foodAmount = "140g - 230g";
                            } else if (weight <= 20) {
                                foodAmount = "230g - 380g";
                            } else {
                                foodAmount = "380g - 550g";
                            }
                            advice = "Chó con dưới 1 tuổi đang trong giai đoạn phát triển xương khớp và cơ bắp. Cần lựa chọn hạt có hàm lượng protein cao (28-32%), bổ sung nhiều canxi và chia nhỏ khẩu phần ăn làm 3-4 bữa để tránh đầy hơi.";
                        } else if (selectedStage === 'adult') {
                            mealsCount = 2;
                            if (weight < 5) {
                                foodAmount = "50g - 90g";
                            } else if (weight <= 10) {
                                foodAmount = "90g - 160g";
                            } else if (weight <= 20) {
                                foodAmount = "160g - 280g";
                            } else {
                                foodAmount = "280g - 480g";
                            }
                            advice = "Chó trưởng thành có hệ tiêu hóa và nhu cầu năng lượng ổn định. Cho ăn điều độ 2 bữa mỗi ngày vào các khung giờ cố định. Đảm bảo cung cấp nước sạch liên tục bên cạnh bát ăn.";
                        } else { // senior
                            mealsCount = 2;
                            if (weight < 5) {
                                foodAmount = "40g - 80g";
                            } else if (weight <= 10) {
                                foodAmount = "80g - 130g";
                            } else if (weight <= 20) {
                                foodAmount = "130g - 220g";
                            } else {
                                foodAmount = "220g - 380g";
                            }
                            advice = "Chó lớn tuổi (trên 7 tuổi) nhu cầu vận động giảm, hệ tiêu hóa và răng yếu hơn. Nên giảm bớt lượng đạm béo để phòng béo phì, chọn các loại thức ăn mềm hoặc ngâm hạt vào nước ấm cho mềm trước khi ăn.";
                        }
                    } else {
                        // MÈO
                        if (selectedStage === 'puppy') { // Kitten
                            mealsCount = 4;
                            if (weight < 1) {
                                foodAmount = "25g - 40g";
                            } else if (weight <= 3) {
                                foodAmount = "40g - 75g";
                            } else {
                                foodAmount = "75g - 110g";
                            }
                            advice = "Mèo con có dạ dày rất nhỏ nhưng nhu cầu năng lượng lại cao. Cần cho ăn chia thành 3-4 bữa/ngày, thức ăn phải dễ tiêu hóa, giàu đạm và taurine để phát triển thị lực và tim mạch toàn diện.";
                        } else if (selectedStage === 'adult') {
                            mealsCount = 2;
                            if (weight < 3) {
                                foodAmount = "35g - 55g";
                            } else if (weight <= 5) {
                                foodAmount = "55g - 80g";
                            } else {
                                foodAmount = "80g - 105g";
                            }
                            advice = "Mèo trưởng thành rất ít uống nước nên dễ mắc các bệnh về đường tiết niệu (sỏi thận). Khuyên khích bạn bổ sung thêm Pate ướt hoặc súp thưởng bên cạnh hạt khô JinJin để bổ sung nước tối ưu.";
                        } else { // senior
                            mealsCount = 2;
                            if (weight < 3) {
                                foodAmount = "30g - 45g";
                            } else if (weight <= 5) {
                                foodAmount = "45g - 65g";
                            } else {
                                foodAmount = "65g - 85g";
                            }
                            advice = "Mèo lớn tuổi có nguy cơ cao về các bệnh thận mãn tính. Cần ưu tiên các dòng hạt xơ cao, lượng muối và phốt pho thấp, kết hợp thức ăn mềm để dễ hấp thụ dinh dưỡng tốt nhất.";
                        }
                    }

                    // Ước tính chén/cốc (khoảng 80-100g = 1 cốc tiêu chuẩn)
                    let minAmount = parseInt(foodAmount);
                    let avgAmount = minAmount ? minAmount + 25 : 50;
                    let cups = (avgAmount / 90).toFixed(1);
                    cupEquivalent = `Tương đương khoảng ${cups} chén thức ăn tiêu chuẩn (1 chén ~ 90g)`;

                    // 3. Đưa dữ liệu lên giao diện kết quả
                    $('#res-food-amount').text(foodAmount);
                    $('#res-meals-count').text(mealsCount);
                    $('#res-cup-equivalent').text(cupEquivalent);
                    $('#res-advice').text(advice);
 
                    // Cập nhật liên kết mua hàng động dựa trên thú cưng (Phase 3)
                    if (selectedType === 'dog') {
                        $('#btn-buy-matching').attr('href', '{{ route("web.search") }}?search=chó');
                        $('#btn-buy-matching span').text('Mua thức ăn cho Chó cưng tại JinJin');
                    } else {
                        $('#btn-buy-matching').attr('href', '{{ route("web.search") }}?search=mèo');
                        $('#btn-buy-matching span').text('Mua thức ăn cho Mèo cưng tại JinJin');
                    }
 
                    // 4. Hiển thị khối kết quả
                    $('#results-display').fadeIn(500);
                }, 800); // Trì hoãn 800ms tạo hiệu ứng tính toán
            });
        });
    </script>
@endsection
