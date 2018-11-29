@extends('layouts.template')
@section('content')
    @if(session()->has('message'))
        <script>
            alert("{{ session('message') }}");
        </script>
    @endif
    <button onclick="{{ route('sessions.destroy') }}">로그아웃</button>
@endsection