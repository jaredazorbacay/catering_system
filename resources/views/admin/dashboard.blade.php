@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')

<style>

.dashboard-card{
border:none;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.section-title{
font-weight:600;
margin-bottom:15px;
}

.quick-btn{
background:#038cfc;
border:none;
color:white;
}

.quick-btn:hover{
background:#0277d9;
}

</style>


<div class="container py-4">

<h3 class="mb-4">Admin Dashboard</h3>


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


{{-- QUICK ACTIONS --}}

<div class="card dashboard-card p-4 mb-4">

<h5 class="section-title">Quick Actions</h5>

<div class="d-flex flex-wrap gap-2">

<a href="/admin/orders" class="btn quick-btn">
View Orders
</a>

<a href="/admin/analytics" class="btn btn-outline-primary">
View Analytics
</a>

</div>

</div>



{{-- UPCOMING EVENTS --}}

<div class="card dashboard-card p-4 mb-4">

<h5 class="section-title">Upcoming Events</h5>

<div class="table-responsive">

<table class="table table-hover">

<tr>
<th>Client</th>
<th>Event</th>
<th>Date</th>
<th>Guests</th>
</tr>

@if($upcomingEvents->count())

@foreach($upcomingEvents as $event)

<tr>

<td>{{ $event->user->name }}</td>

<td>{{ $event->event_name }}</td>

<td>{{ $event->event_date }}</td>

<td>{{ $event->guest_count }}</td>

</tr>

@endforeach

@else

<tr>
<td colspan="4" class="text-center text-muted">
No upcoming events
</td>
</tr>

@endif

</table>

</div>

</div>



{{-- EVENT HISTORY --}}

<div class="card dashboard-card p-4">

<h5 class="section-title">Event History</h5>

<div class="table-responsive">

<table class="table table-hover">

<tr>
<th>Client</th>
<th>Event</th>
<th>Date</th>
<th>Status</th>
</tr>

@if($pastEvents->count())

@foreach($pastEvents as $event)

<tr>

<td>{{ $event->user->name }}</td>

<td>{{ $event->event_name }}</td>

<td>{{ $event->event_date }}</td>

<td>

<span class="badge bg-success">
Finished
</span>

</td>

</tr>

@endforeach

@else

<tr>
<td colspan="4" class="text-center text-muted">
No past events
</td>
</tr>

@endif

</table>

</div>

</div>


</div>

@endsection