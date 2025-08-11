<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- Bootstrap, Animate.css, Bootstrap Icons -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" /> -->
</head>

<body>

    <!-- NAVBAR (same as instruction.php) -->
    <?php
    include "../includes/navbar.php";
    ?>

    <!-- LOGIN FORM -->
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card mx-auto shadow-lg" style="max-width: 450px; width: 100%;">
                <div class="card-body pt-5 px-5">
                    <h1 class="text-center fw-bold">LOGIN YOUR ACCOUNT</h1>
                    <form method="post" id="login-form">
                        <div class="mb-3">
                            <input type="text" placeholder="ID-Number" name="username" id="username" class="form-control form-control-lg form" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" placeholder="Password" name="password" id="password" class="form-control form-control-lg" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <div class="text-center mb-3">
                            <p class="text-decoration-none text-muted pt-3 pb-0">New student? <a href="instruction.php" class="text-warning">Admit now!</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            const redirect = (role) => {
                let page = "";
                if (role === "Admin") {
                    page = "Admin";
                } else if (role === "Student") {
                    page = "Student";
                } else if (role === "Registrar") {
                    page = "Registrar";
                } else if (role === "Staff") {
                    page = "Staff";
                }
                setTimeout(() => {
                    window.location.href = `${page}Dashboard.php?page=${page}Dashboard`;
                }, 3000);
            }

            $('#login-form').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    method: "POST",
                    url: "../Actions/UserController.php?actionType=Login",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
                            $('#login-form')[0].reset();
                            redirect(response.role);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <style>
        body {
            position: relative;
            min-height: 100vh;
        }


        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../assets/campus.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(2px);
            z-index: -1;

        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: var(--bs-body-bg);
            background-clip: padding-box;
            border: 3px solid rgba(67, 67, 67, 1);
            border-radius: 0px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
</body>

</html>