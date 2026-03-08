@extends('layouts.app')

@section('title','Admin Login')

@section('content')

<style>

.login-card{
border:none;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.login-btn{
background:#038cfc;
border:none;
color:white;
}

.login-btn:hover{
background:#0277d9;
}

</style>


<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card login-card p-4">

<h4 class="text-center mb-4">Admin Login</h4>


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



<form method="POST" action="/admin/login">

@csrf


<div class="mb-3">

<input
type="text"
name="phone_number"
class="form-control"
placeholder="Phone Number"
required
>

</div>


<div class="mb-4">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required
>

</div>


<button class="btn login-btn w-100 mb-3">

Login as Admin

</button>


<div class="text-center">

<a href="/login">Client Login</a>

</div>

</form>

</div>

</div>

</div>

</div>

@endsection