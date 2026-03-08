@extends('layouts.app')

@section('title','Register')

@section('content')

<style>

.register-card{
    border:none;
    border-radius:14px;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.register-title{
    font-weight:600;
    color:#444;
}

.form-control{
    border-radius:8px;
}

.register-btn{
    background:#038cfc;
    border:none;
    color:white;
    font-weight:500;
}

.register-btn:hover{
    background:#0277d9;
}

</style>


<script>
setTimeout(function(){
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => alert.remove());
},3000);
</script>


<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card register-card p-4">

<h4 class="register-title mb-4 text-center">Create Account</h4>


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

<!-- Hidden fields to block browser autofill -->
<input type="text" style="display:none">
<input type="password" style="display:none">


<div class="mb-3">

<input
type="text"
name="name"
class="form-control"
placeholder="Full Name"
autocomplete="off"
required
>

</div>


<div class="mb-3">

<input
type="text"
name="phone_number"
class="form-control"
placeholder="Phone Number"
autocomplete="off"
required
>

</div>


<div class="mb-3">

<input
type="text"
name="address"
class="form-control"
placeholder="Address"
autocomplete="off"
>

</div>


<div class="mb-4">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
autocomplete="new-password"
required
>

</div>


<button class="btn register-btn w-100 mb-3">
Register
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