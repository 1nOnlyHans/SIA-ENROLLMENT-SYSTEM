<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
    include "../includes/lib.php";
    ?>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <header>
        <?php include '../includes/navbar.php'; ?>
    </header>
    <div class="enclose" id="enclose">
        <div class="wrapper">
            <form method="post" id="login-form">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="hidden" name="actionType" id="actionType" value="Login">
                    <input type="text" placeholder="ID-Number" name="username" id="username"
                        required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" id="password"
                        required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="new-student">
                    <a href="instruction.php">New student? Admit now!</a>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <script src="../js//login.js"></script>

    <script>
        const redirect = (role) => {
            let page = "";
            if (role === "Admin") {
                page = "Admin"
            } else if (role === "Student") {
                page = "Student"
            }
            setTimeout(() => {
                window.location.href = `${page}Dashboard.php?page=${page}Dashboard`;
            }, 3000);
        }

        $(document).ready(function() {
            $('#login-form').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    method: "POST",
                    url: "../Actions/UserController.php",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
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

</body>

</html>