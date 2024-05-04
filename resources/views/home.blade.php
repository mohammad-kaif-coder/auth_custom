@php
$data = Auth::User()->name ?? '';
@endphp

@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
<h1>DASHBOARD</h1>
<h2>{{($data)? $data : ''}}</h2>
<a href="{{route('logout')}}">Logout</a>