@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
        <div class="mw-930">
            <h2 class="page-title">VỀ CHÚNG TÔI</h2>
        </div>
        <div class="about-us__content pb-5 mb-5">
            <p class="mb-5">
                <img loading="lazy" class="w-100 h-auto d-block" src="{{ asset('assets/images/about/about-1.jpg') }}" alt="About Us" />
            </p>
            <p class="mb-4">
                Chào mừng bạn đến với <strong>Uomo</strong> – điểm đến thời trang hàng đầu dành cho những ai yêu thích phong cách hiện đại và sự tinh tế. Chúng tôi tin rằng thời trang không chỉ là trang phục bạn mặc, mà còn là cách bạn thể hiện cá tính, câu chuyện và phong cách sống của riêng mình.
            </p>
            <p class="mb-4">
                Được thành lập với sứ mệnh mang lại vẻ đẹp tự tin cho mọi người, Uomo cam kết cung cấp những sản phẩm chất lượng cao, từ chất liệu vải được tuyển chọn kỹ lưỡng đến từng đường kim mũi chỉ. Đội ngũ thiết kế của chúng tôi luôn cập nhật những xu hướng mới nhất trên thế giới để mang đến cho bạn những bộ sưu tập thời thượng và độc đáo nhất.
            </p>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="mb-3">Tầm nhìn của chúng tôi</h5>
                    <p class="mb-3">Trở thành thương hiệu thời trang được yêu thích nhất, nơi khách hàng không chỉ tìm thấy những bộ trang phục đẹp mà còn tìm thấy niềm vui và sự hài lòng trong từng trải nghiệm mua sắm.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Sứ mệnh của chúng tôi</h5>
                    <p class="mb-3">Mang đến những sản phẩm thời trang chất lượng, giá cả hợp lý và dịch vụ khách hàng tận tâm. Chúng tôi không ngừng nỗ lực để hoàn thiện và phát triển, vì sự hài lòng của bạn là thành công lớn nhất của chúng tôi.</p>
                </div>
            </div>
            <p class="mb-4">
               Cảm ơn bạn đã lựa chọn Uomo. Hãy cùng chúng tôi khám phá và định hình phong cách của riêng bạn!
            </p>
        </div>
    </section>
</main>
@endsection
