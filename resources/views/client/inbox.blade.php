@extends('layouts.app')

@section('title','Inbox')

@section('content')

<div class="container py-4">

<h4 class="mb-4">Inbox</h4>

@if($messages->count())

@foreach($messages as $msg)

<div class="card mb-3 p-3">

<strong>Order: {{ $msg->order->event_name }}</strong>

<p class="mb-1 text-muted">
{{ $msg->created_at->format('M d, Y h:i A') }}
</p>

<hr>

<p>{{ $msg->message }}</p>

</div>

@endforeach

@else

<p class="text-muted">No messages</p>

@endif

</div>

@endsection