<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand d-flex align-items-center fw-bold text-white" href="/">

<img src="{{ asset('images/logo.png') }}" 
     alt="Logo"
     style="height:50px; margin-right:10px;">

</a>

<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navMenu">

<ul class="navbar-nav me-auto">

@if(Auth::check())

@if(Auth::user()->role == 'admin')

<li class="nav-item">
<a class="nav-link text-white" href="/admin/dashboard">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="/admin/orders">Orders</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="/admin/analytics">Analytics</a>
</li>

@endif

@if(Auth::user()->role == 'client')

<li class="nav-item">
<a class="nav-link text-white" href="/client/dashboard">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="/client/order/create">Create Order</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="/client/orders">My Orders</a>
</li>

@endif

@endif

</ul>

<ul class="navbar-nav align-items-lg-center">

@if(Auth::check())

<li class="nav-item text-white me-lg-3 mt-2 mt-lg-0">

Hello, {{ Auth::user()->name }}

</li>

<li class="nav-item">

<form method="POST" action="/logout">
@csrf
<button class="btn btn-light btn-sm">Logout</button>
</form>

</li>

@else

<li class="nav-item">
<a class="nav-link text-white" href="/login">Login</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="/register">Register</a>
</li>

@endif

</ul>

</div>

</div>

</nav>