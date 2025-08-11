<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-warning fw-bold" href="#"><img src="../assets/ncst-logo.png" width="50" height="50">Registrar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex justify-content-end">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <button type="button" class="nav-link" id="logout">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#logout').on('click', function() {
                $.ajax({
                    method: "POST",
                    url: "../Actions/UserController.php",
                    data: {
                        actionType: "Logout"
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
                            window.location.href = `Login.php`;
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    });
</script>