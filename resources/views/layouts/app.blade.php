<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Zaylee\'s Bistro by D\' Lake')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f8f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        main {
            flex: 1;
        }

        /* NAVBAR */

        .navbar {
            background: white;
            border-bottom: 1px solid #e9ecef;
        }

        .navbar-brand {
            color: #2c3e50 !important;
            font-weight: 700;
            font-size: 20px;
        }

        .navbar-brand img {
            height: 60px;
            width: auto;
        }

        .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #0a7f8a !important;
        }

        /* BUTTON THEME */

        .btn-primary {
            background: #0a7f8a;
            border: none;
        }

        .btn-primary:hover {
            background: #086a73;
        }

        /* FOOTER */

        .footer {
            background: white;
            border-top: 1px solid #e9ecef;
            padding: 18px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }

        /* SUCCESS MODAL */

        .checkmark-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .checkmark-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #d4edda;
            position: relative;
            animation: pop 0.4s ease;
        }

        .checkmark {
            position: absolute;
            left: 24px;
            top: 40px;
            width: 25px;
            height: 12px;
            border-left: 5px solid #28a745;
            border-bottom: 5px solid #28a745;
            transform: rotate(-45deg);
            animation: draw 0.4s ease forwards;
        }

        @keyframes pop {
            0% {
                transform: scale(0)
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes draw {
            0% {
                width: 0;
                height: 0
            }

            100% {
                width: 25px;
                height: 12px
            }
        }
    </style>

</head>

<body>

    @include('partials.header')

    <main class="container py-4">

        @yield('content')

    </main>

    @include('partials.footer')


    {{-- SUCCESS MODAL --}}

    @if(session('success'))

        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">

                    <div class="checkmark-container">

                        <div class="checkmark-circle">
                            <div class="checkmark"></div>
                        </div>

                    </div>

                    <h4 class="mt-3 text-success">Success</h4>

                    <p>{{ session('success') }}</p>

                    <button class="btn btn-primary mt-2" data-bs-dismiss="modal">
                        Continue
                    </button>

                </div>
            </div>
        </div>

        <script>

            document.addEventListener("DOMContentLoaded", function () {

                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

            });

        </script>

    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>