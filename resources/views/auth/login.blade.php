@extends('layouts.app')

@section('title','Login')

@section('content')

<style>

.login-card{
    border:none;
    border-radius:14px;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.login-title{
    font-weight:600;
    color:#444;
}

.form-control{
    border-radius:8px;
}

.login-btn{
    background:#038cfc;
    border:none;
    color:white;
    font-weight:500;
}

.login-btn:hover{
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

<div class="card login-card p-4">

<h4 class="login-title mb-4 text-center">Login</h4>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
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


<form method="POST" action="/login">

@csrf

<div class="mb-3">

<input
type="text"
name="phone_number"
class="form-control"
placeholder="Phone Number"
value="{{ old('phone_number') }}"
>

</div>


<div class="mb-4">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
>

</div>


<button class="btn login-btn w-100 mb-3">
Login
</button>

<div class="text-center">

Don't have an account?

<a href="/register">Register</a>

</div>

</form>

</div>

</div>

</div>

</div>

@endsection