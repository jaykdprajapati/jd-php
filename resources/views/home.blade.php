@extends('includes.app')

@section('content')
<div class="container">
    <h1> Welcome, {{ Auth::user()->name }}</h1>
</div>
@endsection