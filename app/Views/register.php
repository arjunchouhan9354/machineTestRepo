<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Register</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  <?= link_tag("public/assets/css/sb-admin-2.css") ?>
  <?= link_tag("public/assets/vendor/fontawesome-free/css/all.min.css") ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <div id="messages"></div>
                            <form class="user" id="register-form" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                         <input type="hidden" id="csrf2" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>" />
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                        name="user_name" 
                                            placeholder="User Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    name="email" 
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="mobile number" name="mobile_number">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                        name="password" 
                                            id="exampleRepeatPassword" placeholder="Password">
                                    </div>
                                </div>
                                <input type="submit" id="register" class="btn btn-primary btn-user btn-block" value=" Register Account">

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=base_url('login')?>">Already have an account? Login!</a>
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
    <script type="text/javascript">
    $('#register').click((function(e){
      e.preventDefault();
         var messages = '';
         $.ajax({
             url: "<?= base_url('register/user') ?>",
            type: "POST",
            data: $("#register-form").serialize(),
            dataType: "JSON",
            success: function(res)
            {
            if (res.status == 200) {
                messages = `  <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success! </strong><br> ${res.message} </div>`;
                setTimeout(function() {
                  window.open('<?= base_url() ?>/login', '_SELF');
                }, 3000);
              } else if (res.message.email || res.message.user_name || res.message.mobile_number || res.message.password) {
                errorMsg = "<div class='errors'><ul class='m-0'>";
                for (var key in res.message) {
                  errorMsg += `<li style="padding-bottom:4px;">${res.message[key]}</li>`;
                }
                errorMsg += "<ul></div>";
                 messages = `  <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Errror! </strong><br> ${errorMsg} </div>`;
              } else {
                messages = `  <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Errror! </strong> ${res.message} </div>`;
              }
              $("#messages").html(messages);
          }    
         });
         setTimeout(() =>{
            $("#messages").html("");
              messages = "";
         },8000);
    }))
    </script>
</body>

</html>