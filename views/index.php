 <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        include_once __DIR__ . '/../controllers/page-controller.php';
    ?>
     <!DOCTYPE html>
     <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <base href="<?= base_url(); ?>" />
         <!-- Google Fonts -->
         <link href="https://fonts.gstatic.com" rel="preconnect">
         <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
         <!-- CSS Files -->
         <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
         <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
         <link rel="stylesheet" href="assets/css/login.css">

         <title><?= $page_title[$page_name]; ?></title>
     </head>

     <body>
         <div class="login-container">
             <div class="card card-style">
                 <div class="card-header">
                     <h2>Login</h2>
                 </div>
                 <div class="card-body">
                     <div class="alert alert-danger hide" role="alert" id="alert-text">

                     </div>
                     <form id="login-form" name="login-form">
                         <div class="mb-3">
                             <label for="username" class="form-label">Username</label>
                             <input type="text" name="username" class="form-control" id="username" placeholder="johndoe" required />
                         </div>
                         <div class="mb-3">
                             <label for="password" class="form-label">Password</label>
                             <input type="password" name="password" class="form-control" id="password" placeholder="password" required />
                         </div>
                         <div class="col-12">
                             <button class="btn btn-primary" id="submit-btn" type="submit"> Login <i id="btn-icon" class="fa-solid fa-right-to-bracket"></i></button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>

         <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
         <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
         <script src="https://kit.fontawesome.com/a8ba15086e.js" crossorigin="anonymous"></script>
         <script type="text/javascript" src="assets/js/login.js"></script>
     </body>

     </html>
 <?php
    } else {
        header('Location: dashboard');
    }
    ?>