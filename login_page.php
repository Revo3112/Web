<?php
include "database.php";
if (isset($_POST['login'])) {
    if (loginUser($_POST['username'], $_POST['password']) == 1) {
        echo "<script>
        Swal.fire({
            title: 'Selamat datang!',
            text: 'Anda berhasil login.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loginstyle.css" rel="stylesheet">

</head>

<body class="font-poppins">
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h1 class=" text-center mb-4">Sign in</h1>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-lg text-center" style="width: 100%;">Login</button>
                        </form>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="forget_password_page.html" class="text-decoration-none">Forget your password</a>
                            <a href="other_issue_page.html" class="text-decoration-none">Other issue with sign in</a>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center custom-rounded-bottom">
                        <p class="mb-0">New to our community? <a href="signup_page.php" class="text-decoration-none">Create an account</a></p>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="link-ke-Help-Center" class="text-decoration-none me-3">Help Center</a>
                    <a href="link-ke-Terms-of-Service" class="text-decoration-none me-3">Terms of Service</a>
                    <a href="link-ke-Privacy-Policy" class="text-decoration-none">Privacy Policy</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-10">
                <img src="assets/login/undraw_remotely 1.png" alt="frame" class="img-fluid">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>