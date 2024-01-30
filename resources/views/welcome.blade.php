<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>SI-SANDRAH - Sistem Informasi Pengawasan Aset Daerah</title>
    <!-- MDB icon -->
    <link rel="icon" href="{{ asset('/img/brand/favicon.png') }}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('') }}login_res/css/mdb.min.css" />

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
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

        .bg {
            /* The image used */
            background-image: url("{{ asset('/login_res/img/1.jpg') }}");

            /* Full height */
            height: 100%;
            /*  */
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="bg">
        <!-- Start your project here-->
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5"
                        style="background : rgba(255, 255, 255, 0.8);  padding: 30px;border-radius: 25px;">
                        <img src="{{ asset('login_res/img/blue.png') }}" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1"
                        style="background: rgba(255, 255, 255, 0.95); padding: 100px;border-radius: 25px;">
                        <form role="form" action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="text-center">
                                <h4>Masuk</h4>
                            </div>

                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0"></p>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example3"name="username" id="username"
                                    class="form-control form-control-lg" placeholder="" />
                                <label class="form-label" for="form3Example3">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" id="form3Example4" name="password" id="password"
                                    class="form-control form-control-lg" placeholder="" />
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>


                            <div class="text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Masuk</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div
                class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <!-- Copyright -->
                <div class="text-white mb-3 mb-md-0">
                    Copyright © 2022. Satuan Polisi Pamong Praja Kabupaten Morowali.
                </div>
                <!-- Copyright -->

                <!-- Right -->
                <div>
                    {{-- <a href="#!" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a> --}}
                </div>
                <!-- Right -->
            </div>
        </section>
    </div>
    <!-- End your project here-->
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('') }}login_res/js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>
