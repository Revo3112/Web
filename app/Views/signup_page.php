<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom {
            border-radius: 10px;
        }

        /* Add Poppins font family */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-6">
                <div class="card border-0 shadow card-custom">
                    <div class="card-body">
                        <div class="text-left">
                            <p class="fs-1">Unleash Your </p>
                            <p class="fs-1">Creativity with Us! </p>
                            <p>Access to Thousands of Articles, Resources, and News</p>
                        </div>

                        <form action="<?= site_url('auth/signup') ?>" method="POST">
                            <input type="hidden" name="SIGNUP" value="SIGNUP">
                            <div class="mb-3" style="margin-bottom: 10px;">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                <?php if (isset($validation) && $validation->hasError('username')) : ?>
                                    <div class="alert alert-danger mt-2">
                                        <?= $validation->getError('username'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3" style="margin-bottom: 10px;">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <?php if (isset($validation) && $validation->hasError('password')) : ?>
                                    <div class="alert alert-danger mt-2">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" name="signup" class="btn btn-primary w-100">Sign up</button>
                            <?php if (isset($validation) && $validation->hasError('login')) : ?>
                                <div class="alert alert-danger mt-2">
                                    <?= $validation->getError('signup'); ?>
                                </div>
                            <?php endif; ?>
                        </form>


                        <div class="text-center mt-3">
                            <p>
                                By signing up, you agree to the
                                <a href="#">Terms of use</a>
                                and
                                <a href="#">Privacy Policy</a>.
                            </p>
                            <a href="<?= site_url('login') ?>" class="btn btn-outline-primary">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/signup/10586 1.png') ?>" alt="rectangle" class="img-fluid">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>