@extends('layouts.app')

@section('title', 'Create Order')

@section('content')

    <style>
        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .header-title {
            font-weight: 600;
            color: #0a7f8a;
        }

        .form-control {
            border-radius: 8px;
        }

        .create-btn {
            background: #0a7f8a;
            border: none;
            color: white;
            font-weight: 500;
        }

        .create-btn:hover {
            background: #086a73;
        }

        .cart-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        /* IMAGE WRAPPER */
        .cart-img-wrapper {
            position: relative;
        }

        /* IMAGE */
        .cart-img {
            height: 70px;
            width: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 6px;
            background: #f5f5f5;
        }

        /* SERVING BADGE */
        .serving-badge {
            position: absolute;
            bottom: 5px;
            left: 5px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 5px;
        }

        /* REMOVE BTN */
        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 4px 6px;
            z-index: 1;
        }
    </style>


    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="card p-4">

                    <h4 class="header-title mb-4">
                        Create Catering Order
                    </h4>


                    @if ($errors->any())

                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif


                    {{-- CART ACTIONS --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="header-title">
                            Selected Menu Items
                        </h5>

                        <div class="d-flex gap-2">

                            @if($cartItems->count())

                                <a href="/client/cart" class="m-0, p-0">
                                    <button class="btn btn-primary btn-sm">
                                    Add More Items
                                    </button>
                                </a>

                                <form method="POST" action="/client/cart/clear">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        Clear All
                                    </button>
                                </form>

                            @endif

                        </div>

                    </div>



                    @if($cartItems->count())

                        <div class="row">

                            @foreach($cartItems as $cart)

                                <div class="col-md-3 mb-3">

                                    <div class="card cart-card p-2 position-relative">


                                        <form method="POST" action="/client/cart/remove/{{$cart->id}}">
                                            @csrf
                                            <button class="btn btn-danger btn-sm remove-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>


                                        <div class="cart-img-wrapper">

                                            <img src="{{$cart->item->photo_url}}" class="cart-img" loading="lazy"
                                                onerror="retryImage(this)">

                                            <div class="serving-badge">
                                                👥 Good for {{$cart->item->serving}}
                                            </div>

                                        </div>


                                        <div class="mt-2 small">

                                            <strong>{{$cart->item->name}}</strong>

                                            <br>

                                            Qty: {{$cart->quantity}}

                                            <br>

                                            ₱{{$cart->item->price * $cart->quantity}}

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        <hr>

                        <h4 class="text-end">
                            Total: ₱{{$total}}
                        </h4>

                    @else

                        <p class="text-muted">
                            No items in cart
                        </p>

                        <a href="/client/cart" class="btn btn-primary">
                            Add to Cart
                        </a>

                    @endif



                    {{-- ORDER FORM --}}
                    @if($cartItems->count())

                        <form method="POST" action="/client/order/store">

                            @csrf

                            <div class="row mt-4">

                                <div class="col-md-6">
                                    <label class="form-label">Event Name</label>
                                    <input type="text" name="event_name" class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Event Date</label>
                                    <input type="date" name="event_date" class="form-control" required>
                                </div>

                                <div class="col-md-3">

                                    <label class="form-label d-flex align-items-center gap-2">

                                        Guests

                                        <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                                            title="Automatically calculated based on selected menu items"></i>

                                    </label>

                                    <input type="number" name="guest_count" class="form-control" value="{{$totalServing}}"
                                        readonly>

                                </div>

                            </div>


                            <div class="mt-3">
                                <label class="form-label">Event Location</label>
                                <input type="text" name="event_location" class="form-control" required>
                            </div>


                            <div class="mt-4 text-end">
                                <button class="btn create-btn px-4 py-2">
                                    Submit Order
                                </button>
                            </div>

                        </form>

                    @endif


                </div>

            </div>

        </div>

    </div>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>