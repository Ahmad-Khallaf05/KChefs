<footer id="footer" class="footer">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <span class="sitename">KChefs</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Aqaba / Jordan</p>
          <p class="mt-3"><strong>Phone:</strong> <span>+00962790325001</span></p>
          <p><strong>Email:</strong> <span>ahmadmajedkhallaf470@gmail.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href="https://x.com/AhmadKhallaf11" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
          <a href="https://www.facebook.com/profile.php?id=100074698261724&locale=ar_AR" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/ahm.kh_05/" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/in/ahmad-khallaf-15b66a2b7/" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>

        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><a href="{{ route('home') }}#hero">Home</a></li>
          <li><a href="{{ route('home') }}#about">About us</a></li>
          <li><a href="{{ route('chefs') }}#chefs">Chefs</a></li>
          <li><a href="{{ route('dishes.index') }}#our-dishes">Dishes</a></li>
          <li><a href="{{ route('contacts') }}#contact">Contact</a></li>
          <li><a href="{{ route('home') }}#testimonials">Testimonials</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-12 footer-newsletter">
        <p class="mt-3">
          KChefs is your ultimate culinary destination, where chefs and food enthusiasts come together to share their
          love for cooking. Discover new recipes, learn advanced techniques, and join a vibrant community of food
          lovers.
        </p>
      </div>
    </div>

  </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">KChefs</strong> <span>All Rights Reserved</span></p>
  </div>

</footer>