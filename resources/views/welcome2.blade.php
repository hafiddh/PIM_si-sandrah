<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login_res/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login_res/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login_res/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login_res/css/style.css') }}">
    <style>
        body,
        html {
            height: 100%;
        }

        * {
            box-sizing: border-box;
        }

        .bg-image {
            /* The image used */
            background-image: url("{{ asset('/img/brand/2.jpeg') }}");

            /* Add the blur effect */
            filter: blur(8px);
            -webkit-filter: blur(8px);

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-text {
            /* Black w/opacity/see-through */
            /* color: white; */
            font-weight: bold;
            /* border: 3px solid #f1f1f1; */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            padding: 20px;
            text-align: center;
        }
    </style>

    <title>APP GAJI</title>
    <link rel="icon" href="{{ asset('/img/brand/favicon.png') }}" type="image/png">


</head>

<body>
    <div class="bg-image"></div>

    <div class="bg-text">
        <div class="content">
            <div class="container px-5 py-5"
                style="background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('login_res/images/test1.png') }}" alt="Image" class="img-fluid">
                        <span class="d-block text-center text-white">&mdash; &copy; 2022 &mdash;<br>
                            <a href="http://bkpsdmd.morowalikab.go.id" class="ml-1 text-white" target="_blank">&mdash;
                                BKPSDMD
                                <b>@</b> Kabupaten Morowali &mdash;</a> </span>
                        <br><br><br>
                    </div>
                    <div class="col-md-6 contents" style="background-color: rgba(255, 255, 255, 0.746);">
                        <div class="row justify-content-center">
                            <div class="col-md-8 mb-4">
                                <div class="mt-4 ">
                                    <img src="{{ asset('login_res/images/si_rek.png') }}" alt="Image"
                                        class="img-fluid">

                                    <p class="mb-4 text-dark" style="text-align: justify"><br>APP_CUTI adalah sebuah
                                        aplikasi berbasis website untuk
                                        melakukan pengajuan cuti untuk pegawai negeri sipil di lingkungan Pemerintahan
                                        Kabupaten Morowali.</p>
                                </div>
                                <form role="form" action="{{ route('login') }}" method="POST">
                                    {{ csrf_field() }}
                                  <!-- Email input -->
                                  <div class="form-outline mb-4">
                                    <input type="text" class="form-control" name="username" id="username">
                                    <label class="form-label" for="form2Example1">Username</label>
                                  </div>
                                
                                  <!-- Password input -->
                                  <div class="form-outline mb-4">
                                    <input type="password" class="form-control" name="password" id="password">
                                    <label class="form-label" for="form2Example2">Password</label>
                                  </div>
                                
                                  <!-- 2 column grid layout for inline styling -->
                                  <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">
                                      <!-- Checkbox -->
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                                      </div>
                                    </div>
                                
                                    <div class="col">
                                      <!-- Simple link -->
                                      <a href="#!">Forgot password?</a>
                                    </div>
                                  </div>
                                
                                  <!-- Submit button -->
                                  <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>
                                
                                  <!-- Register buttons -->
                                  <div class="text-center">
                                    <p>Not a member? <a href="#!">Register</a></p>
                                    <p>or sign up with:</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                      <i class="fab fa-facebook-f"></i>
                                    </button>
                                
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                      <i class="fab fa-google"></i>
                                    </button>
                                
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                      <i class="fab fa-twitter"></i>
                                    </button>
                                
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                      <i class="fab fa-github"></i>
                                    </button>
                                  </div>
                                </form>
                                <form role="form" action="{{ route('login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group first">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="d-flex mb-5 align-items-center">
                                        <label class="control control--checkbox mb-0"><span class="caption">Ingat
                                                saya</span>
                                            <input type="checkbox" checked="checked" />
                                            <div class="control__indicator"></div>
                                        </label>
                                        <span class="ml-auto"><a href="#" class="forgot-pass">Lupa
                                                Password</a></span>
                                    </div>
                                    <input type="submit" value="Masuk" class="btn btn-block btn-primary">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('login_res/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('login_res/js/popper.min.js') }}"></script>
    <script src="{{ asset('login_res/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login_res/js/main.js') }}"></script>
</body>

</html>


{{-- <!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
 <!DOCTYPE html>
 <html>
 
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
   <meta name="author" content="Creative Tim">
   <title>Argon Dashboard PRO - Premium Bootstrap 4 Admin Template</title>
   <!-- Favicon -->
   <link rel="icon" href="/img/brand/favicon.png" type="image/png">
   <!-- Fonts -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
   <!-- Icons -->
   <link rel="stylesheet" href="/nucleo/css/nucleo.css" type="text/css">
   <link rel="stylesheet" href="/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
   <!-- Argon CSS -->
   <link rel="stylesheet" href="/css/argon.css?v=1.1.0" type="text/css">
 </head>
 
 <body class="bg-default">
   <!-- Main content -->
   <div class="main-content">
     <!-- Header -->
     <div class="header bg-gradient-primary py-4 py-lg-5 pt-lg-6">
       <div class="container">
         <div class="header-body text-center mb-7">
           <div class="row justify-content-center">
             <div class="col-xl-5 col-lg-6 col-md-8 px-5">
               <p class="text-lead text-white pt-7"></p>
             </div>
           </div>
         </div>
       </div>
       <div class="separator separator-bottom separator-skew zindex-100">
         <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
           <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
         </svg>
       </div>
     </div>
     <!-- Page content -->
     <div class="container mt--8 pb-5">
       <div class="row justify-content-center">
         <div class="col-lg-5 col-md-7">
           <div class="card bg-secondary border-0 mb-0">       
            <img src="/img/brand/favicon.png" style="scale: 50%; margin-top:-200px" alt="">
             <div class="card-body px-lg-5 py-lg-5" style="margin-top: -130px">
               <div class="text-center text-muted mb-5">
                 <h1>Masuk</h1>
               </div>
               <form role="form" action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                 <div class="form-group mb-3">
                   <div class="input-group input-group-merge input-group-alternative">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                     </div>
                     <input class="form-control" name="username" placeholder="Username" type="text">
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="input-group input-group-merge input-group-alternative">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                     </div>
                     <input class="form-control" name="password" placeholder="Password" type="password">
                   </div>
                 </div>
                 <div class="text-center">
                   <button type="submit" class="btn btn-primary my-4">Masuk</button>
                 </div>
               </form>
             </div>
           </div>
          </div>
       </div>
     </div>
   </div>
   <!-- Footer -->
   <footer class="py-5" id="footer-main">
     <div class="container">
       <div class="row align-items-center justify-content-xl-between">
         <div class="col-xl-6">
           <div class="copyright text-center text-xl-left text-muted pt-7">
             &copy; 2021 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
             <a class="btn btn-primary btn-sm ml-3" href="{{ url('/admin') }}">BKD</a>
             <a class="btn btn-warning btn-sm" href="{{ url('/opd') }}">OPD</a>
             <a class="btn btn-info btn-sm" href="{{ url('/keuangan') }}">Keuangan</a>
           </div>
         </div>
         <div class="col-xl-6">
           
         </div>
       </div>
     </div>
   </footer>
   <!-- Argon Scripts -->
   <!-- Core -->
   <script src="/jquery/dist/jquery.min.js"></script>
   <script src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="/js-cookie/js.cookie.js"></script>
   <script src="/jquery.scrollbar/jquery.scrollbar.min.js"></script>
   <script src="/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
   <!-- Argon JS -->
   <script src="/js/argon.js?v=1.1.0"></script>
   <!-- Demo JS - remove this in your project -->
   <script src="/js/demo.min.js"></script>
 </body> --}}
