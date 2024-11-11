@extends('layouts.home')

@section('content')
<br><br><br><br><br>

<main class="main">
  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Contact</h2>
      <p>Contact Us</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">

        <div class="col-lg-4">
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h3>Location</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Open Hours</h3>
              <p>Monday-Saturday:<br>11:00 AM - 2300 PM</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Call Us</h3>
              <p>+00962790325001</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h3>Email Us</h3>
              <p>ahmadmajedkhallaf470@gmail.com</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="col-lg-8">
     
        <form action="{{ route('contacts.create') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
        @csrf
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="user_name" class="form-control" placeholder="Your Name" required>
              </div>

              <div class="col-md-6">
                <input type="email" class="form-control" name="user_email" placeholder="Your Email" required>
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>

        @if(session('success'))
      <div class="alert alert-success mt-4">
        {{ session('success') }}
      </div>
    @endif


        <!-- End Contact Form -->

      </div>

    </div>

  </section><!-- /Contact Section -->
  </main>
  @endsection