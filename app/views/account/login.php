<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://clipart-library.com/images/8iEb5a8bT.png" class="img-fluid" alt="Sample image" />
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="/chieu2-main/account/checklogin" method="post">
                        <h1>The Fishing Shop Q3H</h1>
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        </div>

                        <?php
                        if (isset($errors)) {
                            echo "<ul>";
                            foreach ($errors as $err) {
                                echo "<li class='text-danger'>$err</li>";
                            }
                            echo "</ul>";
                        }

                        ?>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0"></p>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="username" name="username" required class="form-control form-control-lg" placeholder="Enter username" />
                            <!-- <label class="form-label" for="username">Username</label> -->
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="password" name="password" required class="form-control form-control-lg" placeholder="Enter password" />
                            <!-- <label class="form-label" for="password">Password</label> -->
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem">
                                Login
                            </button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                Don't have an account?
                                <a href="/chieu2-main/account/register" class="link-danger">Register</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>