@extends('app')
@section('content')
    <!-- content -->
    <title>{{ $title }}</title>
    <h2>{{ $title }}</h2>
    <hr />
    <h3>Last Activity: <span id="last_activity">{{ session('last_activity') }}</span></h3>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

