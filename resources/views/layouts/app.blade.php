<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title','Catering System')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:linear-gradient(135deg,#8cd3f5,#deedfc);
    min-height:100vh;
    display:flex;
    flex-direction:column;

}

main{
    flex:1;
}

.navbar{
    background:#FFFFFF;
}

.navbar-brand{
    color:black !important;
    font-weight:600;
}

.navbar-brand img {
    height: 500px;
    width: auto;
}

.nav-link{
    color:black !important;
}

.nav-link:hover{
    color:#e6f2ff !important;
}
.footer{
    background:#f8f9fa;
    padding:15px;
    text-align:center;
    font-size:14px;
    color:#777;
}

</style>

</head>

<body>

@include('partials.header')

<main class="container py-4">

@yield('content')

</main>

@include('partials.footer')

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

<style>

.checkmark-container{
display:flex;
justify-content:center;
align-items:center;
margin-top:10px;
}

.checkmark-circle{
width:80px;
height:80px;
border-radius:50%;
background:#d4edda;
position:relative;
animation:pop 0.4s ease;
}

.checkmark{
position:absolute;
left:24px;
top:40px;
width:25px;
height:12px;
border-left:5px solid #28a745;
border-bottom:5px solid #28a745;
transform:rotate(-45deg);
animation:draw 0.4s ease forwards;
}

@keyframes pop{
0%{transform:scale(0)}
100%{transform:scale(1)}
}

@keyframes draw{
0%{width:0;height:0}
100%{width:25px;height:12px}
}

</style>

<script>

document.addEventListener("DOMContentLoaded", function(){

var successModal = new bootstrap.Modal(document.getElementById('successModal'));
successModal.show();

});

</script>

@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>