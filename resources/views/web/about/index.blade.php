@extends('layouts.master_user')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('web.index') }}">Trang chủ</a></li>
                    <li class="active">Về chúng tôi</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    
    <!-- about wrapper start -->
    <div class="about-us-wrapper pt-60 pb-40">
        <div class="container">
            <div class="row align-items-center">
                <!-- About Text Start -->
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="about-text-wrap">
                        <h2><span>JinJin Pet Food</span>Cung cấp giải pháp dinh dưỡng & phụ kiện tốt nhất cho thú cưng</h2>
                        <p>Chào mừng bạn đến với <strong>JinJin Pet Food</strong> - Người bạn đồng hành đáng tin cậy trên hành trình chăm sóc sức khỏe và mang lại cuộc sống hạnh phúc trọn vẹn cho các bé cưng của bạn. Chúng tôi thấu hiểu sâu sắc rằng thú cưng không đơn thuần chỉ là những vật nuôi trong nhà, mà chúng chính là những thành viên vô cùng quý giá, những người bạn tri kỷ mang lại niềm vui ấm áp mỗi ngày cho gia đình bạn. Chính vì vậy, việc chăm lo từng bữa ăn, giấc ngủ và sự phát triển khỏe mạnh của các bé luôn là sứ mệnh hàng đầu của chúng tôi.</p>
                        <p>Tại JinJin Pet Food, chúng tôi chuyên tuyển chọn và cung cấp các dòng sản phẩm thức ăn hạt khô giàu dinh dưỡng từ các thương hiệu danh tiếng, pate đóng lon thơm ngon kích thích vị giác, súp thưởng tiện lợi cùng nhiều loại thực phẩm bổ sung chăm sóc lông và xương khớp. Bên cạnh đó, cửa hàng còn mang đến thế giới phụ kiện vô cùng đa dạng, từ những chiếc chuồng ấm cúng, khay vệ sinh hiện đại, cát vệ sinh khử mùi vượt trội cho đến sữa tắm dịu nhẹ, đồ chơi thông minh giúp giải tỏa căng thẳng hiệu quả cho chó và mèo ở mọi lứa tuổi.</p>
                        <p>Chúng tôi tự hào xây dựng một hệ thống kiểm soát chất lượng cực kỳ nghiêm ngặt. Mỗi sản phẩm được đưa lên kệ tại JinJin Pet Food đều cam kết chính hãng 100%, có nguồn gốc xuất xứ rõ ràng và đáp ứng đầy đủ các tiêu chuẩn an toàn sinh học. Chúng tôi không ngừng nỗ lực đem lại sự an tâm tuyệt đối cũng như trải nghiệm mua sắm trực tuyến vô cùng thuận tiện, nhanh chóng, giúp các chủ nuôi dễ dàng tiếp cận những giải pháp chăm sóc thú cưng tối ưu nhất.</p>
                        <p>Đặc biệt, JinJin Pet Food sở hữu đội ngũ nhân sự giàu kinh nghiệm và am hiểu sâu sắc về hành vi cũng như nhu cầu dinh dưỡng của từng giống loài. Chúng tôi không chỉ bán hàng, mà còn luôn sẵn sàng lắng nghe và tư vấn miễn phí để giúp bạn lựa chọn được chế độ ăn uống khoa học nhất cho thú cưng của mình. Sự hài lòng của quý khách và sự năng động, khỏe mạnh của các bé cưng chính là nguồn động lực to lớn giúp JinJin ngày càng hoàn thiện và phát triển vững mạnh hơn.</p>
                    </div>
                </div>
                <!-- About Text End -->
                <!-- About Image Start -->
                <div class="col-lg-6 col-md-10">
                    <div class="about-image-wrap text-center">
                        <img class="img-full rounded" src="{{ asset('banner_images/banner1.webp') }}" alt="About JinJin Pet Food" style="box-shadow: 0 10px 30px rgba(0,0,0,0.1); max-height: 400px; object-fit: cover;" />
                    </div>
                </div>
                <!-- About Image End -->
            </div>
        </div>
    </div>
    <!-- about wrapper end -->
    
    <!-- core values area wrapper start -->
    <div class="team-area pt-60 pt-sm-44 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="li-section-title capitalize mb-25">
                        <h2><span>Giá trị cốt lõi của chúng tôi</span></h2>
                    </div>
                </div>
            </div> <!-- section title end -->
            <div class="row">
                <!-- Chất lượng -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-60 mb-sm-30 mb-xs-30 text-center p-4 border rounded" style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.02); transition: all 0.3s ease;">
                        <div style="font-size: 40px; color: #fedc19; margin-bottom: 15px;">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="team-content">
                            <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">Chất Lượng Hàng Đầu</h3>
                            <p style="font-size: 13px; color: #666; line-height: 1.6;">Tuyển chọn nghiêm ngặt thức ăn và phụ kiện, cam kết chính hãng 100%, an toàn tuyệt đối cho sức khỏe thú cưng.</p>
                        </div>
                    </div>
                </div> 
                <!-- Dịch vụ -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-60 mb-sm-30 mb-xs-30 text-center p-4 border rounded" style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.02); transition: all 0.3s ease;">
                        <div style="font-size: 40px; color: #fedc19; margin-bottom: 15px;">
                            <i class="fa fa-heart"></i>
                        </div>
                        <div class="team-content">
                            <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">Hỗ Trợ Tận Tâm</h3>
                            <p style="font-size: 13px; color: #666; line-height: 1.6;">Đội ngũ tư vấn am hiểu tâm lý và dinh dưỡng thú cưng luôn sẵn sàng lắng nghe, hỗ trợ khách hàng chu đáo 24/7.</p>
                        </div>
                    </div>
                </div> 
                <!-- Tiện lợi -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-30 mb-sm-60 text-center p-4 border rounded" style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.02); transition: all 0.3s ease;">
                        <div style="font-size: 40px; color: #fedc19; margin-bottom: 15px;">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="team-content">
                            <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">Mua Sắm Tiện Lợi</h3>
                            <p style="font-size: 13px; color: #666; line-height: 1.6;">Giao diện trực quan, đặt hàng nhanh chóng, hỗ trợ giao hàng tận nơi siêu tốc giúp tối ưu hóa thời gian cho các chủ nuôi.</p>
                        </div>
                    </div>
                </div> 
                <!-- Giá trị -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-member mb-30 mb-sm-60 mb-xs-60 text-center p-4 border rounded" style="background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.02); transition: all 0.3s ease;">
                        <div style="font-size: 40px; color: #fedc19; margin-bottom: 15px;">
                            <i class="fa fa-smile-o"></i>
                        </div>
                        <div class="team-content">
                            <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin-bottom: 10px;">Hài Lòng Tuyệt Đối</h3>
                            <p style="font-size: 13px; color: #666; line-height: 1.6;">Không ngừng đổi mới và nâng cao chất lượng dịch vụ để mang đến niềm vui trọn vẹn cho cả sen và hoàng thượng.</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- core values area wrapper end -->
@endsection
