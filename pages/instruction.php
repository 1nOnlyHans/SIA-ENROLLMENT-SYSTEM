<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enrollment Instruction - NCST</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      overflow-x: hidden;
    }

    body {
      background-image: url('../assets/bg.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      transition: padding 0.3s ease;
      padding-top: 8px;
      padding-bottom: 8px;
      top: 0;
      z-index: 1030;
    }

    .navbar.shrink {
      padding-top: 4px;
      padding-bottom: 4px;
    }

    .navbar-brand img {
      width: 55px;
      height: 55px;
    }

    .navbar-brand span {
      font-size: 1.75rem;
    }

    .navbar-nav .nav-link:hover {
      color: #ffc107 !important;
    }

    .instruction-box {
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 15px;
      padding: 2rem;
      margin-top: 110px;
      margin-bottom: 40px;
      max-width: 500px;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .instruction-box li {
      opacity: 0;
    }

    footer {
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .navbar-brand span {
        font-size: 1.25rem !important;
      }

      .navbar-brand img {
        width: 45px !important;
        height: 45px !important;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 fixed-top w-100">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <img src="../assets/ncst-logo.png" alt="NCST Logo" class="img-fluid">
        <span class="text-warning fw-bold" style="-webkit-text-stroke: 0.5px white;">Enrollment Instruction</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav text-center text-lg-start">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">
              <i class="bi bi-house-door-fill fs-5"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- INSTRUCTION SECTION -->
  <section class="container py-5 flex-grow-1">
    <div class="instruction-box">
      <h2 class="text-center text-warning mb-4">Enroll as a New Student or Transferee</h2>
      <ol class="fs-5">
        <li id="step1">Visit the NCST Admission Portal.</li>
        <li id="step2">Fill out the online admission form completely.</li>
        <li id="step3">View the requirements for transferees and new students.</li>
        <li id="step4">Upload the necessary requirements.</li>
        <li id="step5">Submit your application and wait for confirmation.</li>
        <li id="step6">Once accepted, proceed to NCST to process your enrollment.</li>
      </ol>

      <div class="text-center mt-5">
        <a href="admission.php" class="btn btn-warning btn-lg px-4 animate__animated animate__pulse animate__infinite">Fill Admission</a>
      </div>
    </div>
  </section>


  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('shrink', window.scrollY > 10);
    });

    // Animate steps one by one
    window.addEventListener("DOMContentLoaded", () => {
      const steps = [
        document.getElementById("step1"),
        document.getElementById("step2"),
        document.getElementById("step3"),
        document.getElementById("step4"),
        document.getElementById("step5"),
        document.getElementById("step6")
      ];

      steps.forEach((step, index) => {
        setTimeout(() => {
          step.classList.add("animate__animated", index % 2 === 0 ? "animate__fadeInLeft" : "animate__fadeInRight");
          step.style.opacity = 1;
        }, index * 500); // 0.5s delay between each
      });
    });
  </script>
</body>
</html>
