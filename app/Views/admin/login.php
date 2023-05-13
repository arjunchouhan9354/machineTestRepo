<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  <?= link_tag("public/assets/css/sb-admin-2.min.css") ?>
  <?= link_tag("public/assets/vendor/fontawesome-free/css/all.min.css") ?>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="p-5">
                                <h6 class="text-center">Admin Login</h6><hr>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div class="text-danger">
                            <?php
                            if (isset($data['message'])) { ?>

                            <?php if (is_array($data['message'])) {

                                    foreach ($data['message'] as $key => $value) {
                                        echo $value . " ";
                                    }
                                } else {
                                    echo $data['message'];
                                }
                            }
                            ?>
                        </div>
                                    <form class="user" action="<?= base_url('login/auth') ?>" method="POST" id="admin_form">
                                        <div class="form-group">
                                             <input type="hidden" id="csrf1" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>" />
                                            <input type="email" class="form-control form-control-user"
                                            name="email"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>  
                                        <button type="submit" name="submit" id="admin_login" class="btn btn-primary btn-user " value="submit">Log In</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <?= script_tag("public/assets/vendor/jquery/jquery.min.js") ?>
    <?= script_tag("public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>


    <!-- Core plugin JavaScript-->
    <?= script_tag("public/assets/vendor/jquery-easing/jquery.easing.min.js") ?>

    <!-- Custom scripts for all pages-->
    <?= script_tag("public/assets/js/sb-admin-2.min.js") ?>
</body>

</html>