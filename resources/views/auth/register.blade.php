@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <style>
        /* Remove layout spacing */
        main.container {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Page layout */

        .register-page {
            height: calc(100vh - 110px);
            display: flex;
        }

        /* LEFT HERO SECTION */

        .register-left {
            background: linear-gradient(135deg, #0a7f8a, #5bb6be);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
        }

        .logo-img {
            width: 260px;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: 38px;
            font-weight: 700;
        }

        .hero-text {
            margin-top: 20px;
            opacity: .9;
        }

        .hero-feature {
            margin-top: 12px;
            opacity: .9;
        }

        /* RIGHT REGISTER FORM */

        .register-right {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f6f8f9;
        }

        .register-form {
            width: 100%;
            max-width: 420px;
            padding: 10px;
        }

        /* Title */

        .register-title {
            font-weight: 700;
            color: #2c3e50;
        }

        /* Inputs */

        .form-control {
            border-radius: 10px;
            padding: 12px 14px;
            width: 100%;
        }

        /* Register button */

        .register-btn {
            background: #0a7f8a;
            border: none;
            color: white;
            padding: 12px;
            font-weight: 500;
            border-radius: 10px;
            width: 100%;
        }

        .register-btn:hover {
            background: #086a73;
        }

        /* MOBILE */

        @media(max-width:992px) {

            .register-left {
                display: none;
            }

            .register-page {
                height: auto;
                padding-top: 80px;
                padding-bottom: 60px;
            }

            .register-form {
                max-width: 95%;
                margin: auto;
            }

        }
    </style>


    <script>
        setTimeout(function () {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => alert.remove());
        }, 3000);
    </script>


    <div class="container-fluid p-0">

        <div class="row g-0 register-page">


            {{-- LEFT SIDE BRAND --}}

            <div class="col-lg-6 register-left">

                <img src="{{ asset('images/logo.png') }}" class="logo-img">

                <h1 class="hero-title">
                    Join Zaylee's Bistro
                </h1>

                <p class="hero-text">

                    Create an account to start planning events with
                    <strong>Zaylee's Bistro by D' Lake</strong>.
                    Book catering services, manage your orders, and experience seamless event planning.

                </p>

                <div class="hero-feature mt-4">
                    ✔ Premium catering services
                </div>

                <div class="hero-feature">
                    ✔ Elegant dining experiences
                </div>

                <div class="hero-feature">
                    ✔ Seamless event booking
                </div>

                <div class="hero-feature">
                    ✔ Real-time order tracking
                </div>

            </div>



            {{-- RIGHT SIDE REGISTER --}}

            <div class="col-lg-6 register-right">

                <div class="register-form">

                    <h3 class="register-title mb-4 text-center">
                        Create Your Account
                    </h3>


                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <strong>Registration Error:</strong><br>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="POST" action="/register" autocomplete="off">

                        @csrf

                        <!-- Hidden autofill blockers -->
                        <input type="text" style="display:none">
                        <input type="password" style="display:none">


                        <div class="mb-3">

                            <input type="text" name="name" class="form-control w-100" placeholder="Full Name"
                                autocomplete="off" required>

                        </div>


                        <div class="mb-3">

                            <input type="text" name="phone_number" class="form-control w-100" placeholder="Phone Number"
                                autocomplete="off" required>

                        </div>


                        <div class="mb-3">

                            <input type="text" name="address" class="form-control w-100" placeholder="Address"
                                autocomplete="off">

                        </div>


                        <div class="mb-4">

                            <input type="password" name="password" class="form-control w-100" placeholder="Password"
                                autocomplete="new-password" required>

                        </div>


                        <button class="btn register-btn w-100 mb-3">
                            Create Account
                        </button>


                        <div class="text-center">

                            Already have an account?

                            <a href="/login">Login</a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection