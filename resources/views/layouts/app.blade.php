<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title','Zaylee\'s Bistro by D\' Lake')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f6f8f9;
min-height:100vh;
display:flex;
flex-direction:column;
font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto;
}

main{
flex:1;
}

/* NAVBAR */

.navbar{
background:white;
border-bottom:1px solid #e9ecef;
}

.navbar-brand{
color:#2c3e50 !important;
font-weight:700;
font-size:20px;
}

.navbar-brand img{
height:60px;
width:auto;
}

.nav-link{
color:#2c3e50 !important;
font-weight:500;
}

.nav-link:hover{
color:#0a7f8a !important;
}

/* BUTTON THEME */

.btn-primary{
background:#0a7f8a;
border:none;
}

.btn-primary:hover{
background:#086a73;
}

/* FOOTER */

.footer{
background:white;
border-top:1px solid #e9ecef;
padding:18px;
text-align:center;
font-size:14px;
color:#6c757d;
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

<h4 class="mt-3 text-success">Success</h4>
<p>{{ session('success') }}</p>

<button class="btn btn-primary mt-2" data-bs-dismiss="modal">
Continue
</button>

</div>
</div>
</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

var successModal = new bootstrap.Modal(document.getElementById('successModal'));
successModal.show();

});

</script>

@endif


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- SAFE IMAGE LOADER -->

<script>

function retryImage(img){

    if(!img.dataset.retry){
        img.dataset.retry = 0;
    }

    let retries = parseInt(img.dataset.retry);

    if(retries < 3){

        img.dataset.retry = retries + 1;

        setTimeout(function(){

            let src = img.src.split('?')[0];
            img.src = src + '?reload=' + new Date().getTime();

        },500);

    }else{

        img.src = "/images/food-placeholder.png";

    }

}

document.addEventListener("DOMContentLoaded",function(){

    const imgs = document.querySelectorAll("img[data-safe-img]");

    imgs.forEach(function(img){

        if(!img.complete || img.naturalHeight === 0){

            setTimeout(function(){
                retryImage(img);
            },1000);

        }

    });

});

</script>

</body>
</html>