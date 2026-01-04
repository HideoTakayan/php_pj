@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">LIÊN HỆ CHÚNG TÔI</h2>
      </div>
    </section>

    <hr class="mt-2 text-secondary " />
    <div class="mb-4 pb-4"></div>

    <section class="contact-us container">
      <div class="mw-930">
        <div class="contact-us__form">
          <form name="contact-us-form" class="needs-validation" novalidate="" method="POST" action="{{ route('client.postContact') }}">
            @csrf
            <h3 class="mb-5">Liên lạc</h3>
            <div class="form-floating my-4">
              <input type="text" class="form-control" name="name" placeholder="Name *" required="" >
              <label for="contact_us_name">Tên *</label>
              <span class="text-danger"></span>
            </div>
            <div class="form-floating my-4">
              <input type="text" class="form-control" name="phone" placeholder="Phone *" required="">
              <label for="contact_us_name">Số điện thoại *</label>
              <span class="text-danger"></span>
            </div>
            <div class="form-floating my-4">
              <input type="email" class="form-control" name="email" placeholder="Email address *" required="">
              <label for="contact_us_name">Địa chỉ email *</label>
              <span class="text-danger"></span>
            </div>
            <div class="my-4">
              <textarea class="form-control form-control_gray" name="describe" placeholder="Tin nhắn của bạn" cols="30"
                rows="8" required=""></textarea>
              <span class="text-danger"></span>
            </div>
            <div class="my-4">
              <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
@endsection
