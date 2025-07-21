<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>National College of Science and Technology</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .hidden-on-load {
      opacity: 0;
    }

    .animate__animated.visible {
      opacity: 1;
    }

    .navbar {
      transition: padding-top 0.3s ease, top 0.3s ease;
      padding-top: 20px;
      top: 40px;
    }

    .navbar.shrink {
      padding-top: 5px;
      top: 0;
    }

    .navbar-nav .nav-link {
      transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #ffc107 !important;
    }

    @media (max-width: 767.98px) {
      .navbar-brand span {
        font-size: 1.25rem !important;
      }

      .navbar-brand img {
        width: 50px !important;
        height: 50px !important;
      }

      .display-4 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body class="text-white" style="background-image: url('../assets/ncst_bg.webp'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

  <div class="bg-primary py-2">
    <div class="container text-center fw-bold">
      <marquee>Ang Estudyanteng Magaling sa NCST Galing! (Great students come from NCST!)</marquee>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 fixed-top w-100 z-3">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <img src="../assets/ncst-logo.png" alt="NCST Logo" class="img-fluid" width="70" height="70">
        <span class="text-warning fw-bold fs-2" style="-webkit-text-stroke: 0.5px white;">NCST Enrollment System</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav text-center text-lg-start">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="login.php">Portal</a></li>
          <li class="nav-item"><a class="nav-link active" href="admission.php">Admission</a></li>
          <li class="nav-item"><a class="nav-link active" href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="position-relative" style="height: 100vh; padding-top: 120px;">
    <div class="h-100 w-100 d-flex flex-column justify-content-center align-items-center text-center px-3">
      <h1 class="display-4 fw-bold opacity-75 animate__animated animate__fadeInDown">National College of Science and Technology</h1>
      <p class="lead text-white mb-4 animate__animated animate__fadeInUp animate__delay-1s">Empowering the Next Generation</p>
      <a href="#about" class="btn btn-outline-light px-4 animate__animated animate__zoomIn animate__delay-2s">Learn More</a>
    </div>
  </div>

  <section id="programs" class="py-5 bg-transparent">
    <div class="container text-center">
      <div class="mb-5 animate__animated animate__fadeInDown hidden-on-load">
        <h2 class="text-white fw-bold">Explore Our Technology Programs</h2>
        <p class="text-white">Prepare for a future in innovation and digital excellence</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card bg-dark bg-opacity-75 text-white h-100 animate__animated animate__zoomIn animate__delay-1s hidden-on-load">
            <div class="card-body">
              <img src="../assets/ITLOGO.jpg" class="img-fluid rounded mb-3" alt="Information Technology">
              <h5 class="card-title text-warning">Information Technology</h5>
              <p class="card-text">Master the world of software, systems, and modern computing infrastructure to lead the digital era.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-dark bg-opacity-75 text-white h-100 animate__animated animate__zoomIn animate__delay-2s hidden-on-load">
            <div class="card-body">
              <img src="../assets/CELOGO.webp" class="img-fluid rounded mb-3" alt="Computer Engineering">
              <h5 class="card-title text-warning">Computer Engineering</h5>
              <p class="card-text">Design and develop hardware systems, embedded technologies, and intelligent devices of the future.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-dark bg-opacity-75 text-white h-100 animate__animated animate__zoomIn animate__delay-3s hidden-on-load">
            <div class="card-body">
              <img src="../assets/CSLOGO.jpg" class="img-fluid rounded mb-3" alt="Computer Science">
              <h5 class="card-title text-warning">Computer Science</h5>
              <p class="card-text">Dive into programming, algorithms, and AI to build the next generation of smart technologies.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section id="about" class="bg-transparent" style="margin-top: 100px; margin-bottom: 100px;">
  <div class="container d-flex justify-content-center">
    <div class="p-4 animate__animated animate__fadeInUp text-center"
         style="background-color: rgba(0, 0, 0, 0.6); width: 700px; height: auto; min-height: 400px; border-radius: 50px; border: 2px solid white; display: flex; flex-direction: column; justify-content: center; align-items: center;">
      
      <h2 class="mb-4 text-white display-5 fw-bold">About Us</h2>
      <p class="text-white fs-5">
        National College of Science and Technology (NCST) is committed to delivering high-quality education
        and training to develop professionals equipped with the skills needed in today's competitive world.
        Our goal is to provide a student-centered learning environment that empowers future innovators and leaders.
      </p>
    </div>
  </div>
</section>


  <section id="contact" class="py-3 bg-dark bg-opacity-50 animate__animated animate__fadeInUp">
    <div class="p-3 text-center">
      <h2 class="mb-4 text-white">Contact Us</h2>
      <p><strong>NCST Main Campus</strong></p>
      <p><i class="bi bi-geo-alt-fill"></i> Governor's Drive, Dasmariñas, Cavite</p>
      <p><i class="bi bi-envelope-fill"></i> info@ncst.edu.ph</p>
      <p><i class="bi bi-telephone-fill"></i> (046) 416-0383</p>
    </div>
  </section>

  <footer class="bg-primary text-center py-4 border-top border-secondary">
    <p class="mb-0">&copy; 2025 National College of Science and Technology. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const elements = document.querySelectorAll('.hidden-on-load');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.remove('hidden-on-load');
          const animationClass = Array.from(entry.target.classList).find(cls => cls.startsWith('animate__'));
          if (animationClass) {
            entry.target.classList.remove(animationClass);
            void entry.target.offsetWidth;
            entry.target.classList.add(animationClass);
          }
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.2 });
    elements.forEach(el => observer.observe(el));

    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 10) {
        navbar.classList.add('shrink');
      } else {
        navbar.classList.remove('shrink');
      }
    });
  </script>
</body>
</html>