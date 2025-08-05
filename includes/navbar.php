<!-- navbar.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <?php
    include "lib.php";
  ?>
  <style>
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

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 fixed-top w-100">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <img src="../assets/ncst-logo.png" alt="NCST Logo" class="img-fluid">
        <span class="text-warning fw-bold" style="-webkit-text-stroke: 0.5px white;">NCST Portal</span>
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

</body>
</html>
