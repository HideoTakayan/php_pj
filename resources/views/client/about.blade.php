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
                <img loading="lazy" class="h-auto d-block mx-auto" style="width: 60%;"
                     src="{{ asset('assets/images/about/about-1.jpg') }}"
                     alt="About Us" />
            </p>

            <p class="mb-4">
                Chào mừng bạn đến với <strong>Uniqlo</strong> – nơi thời trang hiện đại hòa quyện cùng tinh thần tối giản,
                tinh tế và bền vững theo thời gian.
            </p>

            <p class="mb-4">
                Chúng tôi tin rằng thời trang không chỉ là những trang phục bạn khoác lên người,
                mà còn là cách bạn thể hiện cá tính, phong cách sống và những giá trị riêng trong cuộc sống hằng ngày.
                Mỗi sản phẩm của Uniqlo đều được tạo ra với mong muốn mang lại sự thoải mái, tự tin
                và phù hợp với mọi khoảnh khắc của bạn.
            </p>

            <p class="mb-4">
                Được thành lập với sứ mệnh mang lại vẻ đẹp tự tin cho mọi người,
                Uniqlo cam kết cung cấp những sản phẩm chất lượng cao – từ chất liệu vải được tuyển chọn kỹ lưỡng,
                công nghệ sản xuất hiện đại cho đến từng đường kim mũi chỉ tỉ mỉ.
                Đội ngũ thiết kế của chúng tôi không ngừng cập nhật xu hướng thời trang toàn cầu
                để mang đến những bộ sưu tập vừa hiện đại, vừa ứng dụng cao trong cuộc sống.
            </p>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="mb-3">Tầm nhìn của chúng tôi</h5>
                    <p class="mb-3">
                        Trở thành thương hiệu thời trang được yêu thích hàng đầu,
                        nơi khách hàng không chỉ tìm thấy những bộ trang phục đẹp và chất lượng,
                        mà còn cảm nhận được niềm vui, sự thoải mái và sự hài lòng
                        trong từng trải nghiệm mua sắm cùng Uniqlo.
                    </p>
                </div>

                <div class="col-md-6">
                    <h5 class="mb-3">Sứ mệnh của chúng tôi</h5>
                    <p class="mb-3">
                        Mang đến những sản phẩm thời trang chất lượng cao với mức giá hợp lý,
                        đi kèm dịch vụ khách hàng tận tâm và chuyên nghiệp.
                        Chúng tôi không ngừng cải tiến, đổi mới và phát triển mỗi ngày,
                        bởi sự hài lòng và tin tưởng của bạn chính là thước đo cho thành công của Uniqlo.
                    </p>
                </div>
            </div>

            <p class="mb-4">
                Cảm ơn bạn đã lựa chọn Uniqlo.
                Hãy cùng chúng tôi khám phá, trải nghiệm và định hình phong cách sống hiện đại,
                đơn giản nhưng đầy cảm hứng cho chính bạn.
            </p>
        </div>
    </section>
</main>
@endsection
