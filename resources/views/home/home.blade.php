@extends('layouts.home')

@section('content')
<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">

    <img src="{{ asset('./assets/home/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

    <div class="container">
      <div class="row">
        <div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
          <h2 data-aos="fade-up" data-aos-delay="100">Welcome to <span>KChefs</span></h2>
          <p data-aos="fade-up" data-aos-delay="200">Delivering great food !</p>
          <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('chefs') }}" class="cta-btn">Our Chefs</a>
            <a href="{{ route('dishes.index') }}" class="cta-btn">Our dishes</a>
          </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-center mt-5 mt-lg-0">
          <a href="https://www.youtube.com/watch?v=OqVROy0EXCI&ab_channel=julian.travel"
            class="glightbox pulsating-play-btn"></a>
        </div>
      </div>
    </div>

  </section><!-- /Hero Section -->

  <!-- About Section -->
<section id="about" class="about section">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4">
    <div class="col-lg-6 order-1 order-lg-2">
      <img src="{{ asset('./assets/home/img/about.jpg') }}" class="img-fluid about-img" alt="KChefs">
    </div>
    <div class="col-lg-6 order-2 order-lg-1 content">
      <h3>Welcome to KChefs</h3>
      <p class="fst-italic">
        At KChefs, we bring together culinary experts to share their passion for food, recipes, and the art of cooking. Whether you're a seasoned chef or a home cook, we provide a platform for learning and exploring new dishes.
      </p>
      <ul>
        <li><i class="bi bi-check2-all"></i> <span>Discover a wide variety of recipes and cooking tips from experienced chefs.</span></li>
        <li><i class="bi bi-check2-all"></i> <span>Learn new skills and techniques to elevate your culinary creations.</span></li>
        <li><i class="bi bi-check2-all"></i> <span>Join a community of food lovers and share your own cooking experiences.</span></li>
      </ul>
      <p>
        Whether you’re looking to perfect your favorite dish or try something completely new, KChefs is here to inspire your culinary journey. From easy weeknight meals to intricate gourmet creations, we have something for every cook.
      </p>
    </div>
  </div>

</div>
</section>

  </section><!-- /About Section -->


  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Testimonials</h2>
      <p>What they're saying about us</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="swiper init-swiper" data-speed="600" data-delay="5000"
        data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
        <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class=" bi bi-quote quote-icon-left"></i>
                <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                  Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <h3>Saul Goodman</h3>
              <h4>Ceo &amp; Founder</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid malis quorum
                  velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <h3>Sara Wilsson</h3>
              <h4>Designer</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim
                  tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <h3>Jena Karlis</h3>
              <h4>Store Owner</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat dolor enim
                  duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <h3>Matt Brandon</h3>
              <h4>Freelancer</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam sunt
                  culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <h3>John Larson</h3>
              <h4>Entrepreneur</h4>
            </div>
          </div><!-- End testimonial item -->

        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonial</h2>
        <p>Submit Your Testimonial</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Phone Number</h3>
                <p>Provide us with your contact number (optional).</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>Your email will remain confidential.</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">

            <form action="{{ route('testimonials.create') }}" method="post" class="php-email-form" data-aos="fade-up"
              data-aos-delay="200">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="user_name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6">
                  <input type="email" class="form-control" name="user_email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="Testimonial_Title" placeholder="Testimonial Title"
                    required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="testimonial" rows="6" placeholder="Your Testimonial"
                    required></textarea>
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

         <!-- Success or error message -->
         @if(session('success'))
        <div class="alert alert-success mt-4">
          {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger mt-4">
          {{ session('error') }}
        </div>
        @endif


          <!-- End Contact Form -->

        </div>

      </div>

    </section>

  </section><!-- /Testimonials Section -->
</main>
@endsection